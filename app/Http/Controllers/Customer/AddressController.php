<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\CustomerAddress;
use App\Models\District;
use App\Models\Province;
use App\Models\Regency;
use App\Models\Village;
use App\Services\AddressService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class AddressController extends Controller
{
    public function edit(Request $request, AddressService $addressService)
    {
        $regencyId = $request->regency_id;
        $districtId = $request->district_id;
        $address = $addressService->find();

        if ($address) {
            $regencyId = $regencyId ?? $address->village->district->regency_id;
            $districtId = $districtId ?? $address->village->district_id;
            $address = $address->toArray();
        }

        return Inertia::render('Address/Edit', [
            'provinces' => Province::where('id', 63)->orderBy('name')->get(),
            'regencies' => Regency::whereIn('id', [6303, 6372])->orderBy('name')->get(),
            'districts' => District::where('regency_id', $regencyId)
                ->when($regencyId === '6303', function($q) {
                    $q->whereIn('id', [6303050]);
                })
                ->when($regencyId === '6372', function($q) {
                    $q->whereIn('id', [6372010, 6372031, 6372032]);
                })
                ->orderBy('name')
                ->get(),
            'villages' => Village::where('district_id', $districtId)->orderBy('name')->get(),
            'address' => $address
        ]);
    }

    public function showMap()
    {
        return Inertia::render('Address/ShowMap');
    }

    public function update(Request $request, AddressService $addressService)
    {
        $request->validate([
            'regency_id' => 'required',
            'district_id' => 'required',
            'village_id' => 'required',
            'address' => 'required',
            'phone_number' => 'required',
            'location_point' => 'required'
        ]);

        $addressService->createOrUpdate($request->all());

        return redirect()->back();
    }
}

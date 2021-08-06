<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\CustomerAddress;
use App\Models\District;
use App\Models\Province;
use App\Models\Regency;
use App\Models\Village;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AddressController extends Controller
{
    public function edit(Request $request)
    {
        $regencyId = $request->regency_id;
        $districtId = $request->district_id;

        $userId = Auth::guard('customer')->id();
        $address = CustomerAddress::with('village.district.regency')
            ->where('customer_id', $userId)
            ->first();

        if ($address) {
            $districtId = $address->village->district_id;
            $regencyId = $address->village->district->regency_id;
        }

        return Inertia::render('Address/Edit', [
            'provinces' => Province::where('id', 63)->get(),
            'regencies' => Regency::whereIn('id', [6303, 6372])->get(),
            'districts' => District::where('regency_id', $regencyId)
                                    ->when($regencyId === '6303', function($q) {
                                        $q->whereIn('id', [6303050]);
                                    })
                                    ->when($regencyId === '6372', function($q) {
                                        $q->whereIn('id', [6372010, 6372031, 6372032]);
                                    })
                                    ->get(),
            'villages' => Village::where('district_id', $districtId)->get(),
            'address' => $address->toArray()
        ]);
    }

    public function showMap()
    {
        return Inertia::render('Address/ShowMap');
    }

    public function update(Request $request)
    {
        $request->validate([
            'regency_id' => 'required',
            'district_id' => 'required',
            'village_id' => 'required',
            'address' => 'required',
            'phone_number' => 'required',
        ]);

        CustomerAddress::updateOrInsert(
            ['customer_id' => Auth::guard('customer')->id()],
            [
                'village_id' => $request->village_id,
                'address' => $request->address,
                'phone_number' => $request->phone_number
            ]
        );

        return redirect()->to('/checkout');
    }
}

<?php

namespace App\Http\Livewire;

use App\Models\CustomerAddress;
use App\Models\District;
use App\Models\Province;
use App\Models\Regency;
use App\Models\Village;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AddressUpdate extends Component
{
    public $address;
    public $regency_id;
    public $district_id;

    protected $rules = [
        'regency_id' => 'required|integer',
        'district_id' => 'required|integer',
        'address.village_id' => 'required|integer',
        'address.address' => 'required|string',
        'address.phone_number' => 'required|numeric'
    ];

    public function mount(CustomerAddress $address)
    {
        $oldAddress = CustomerAddress::where('user_id', Auth::guard('customer')->id())->first();
        $this->address = $oldAddress ?? $address;
        $this->regency_id = $oldAddress->village->district->regency_id;
        $this->district_id = $oldAddress->village->district_id;


    }

    public function render()
    {
        $regencyId = $this->regency_id ?? null;
        $districtId = $this->district_id ?? null;
        
        $provinces = Province::where('id', 63)->get();
        $regencies = Regency::whereIn('id', [6303, 6372])->get();
        $districts = District::where('regency_id', $regencyId)
            ->when($regencyId === '6303', function($q) {
                $q->whereIn('id', [6303050]);
            })
            ->when($regencyId === '6372', function($q) {
                $q->whereIn('id', [6372010, 6372031, 6372032]);
            })
            ->get();

        $villages = Village::where('district_id', $districtId)->get();

        return view('livewire.address-update', compact('provinces', 'regencies', 'districts', 'villages'))
            ->layout('layouts.customer');
    }

    public function save()
    {
        $this->validate();

        $this->address['user_id'] = Auth::guard('customer')->id();

        $this->address->save();

        $this->emit('toast-save', 'Alamat');
    }
}

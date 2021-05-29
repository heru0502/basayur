<?php

namespace App\Http\Livewire;

use App\Models\District;
use App\Models\Province;
use App\Models\Regency;
use App\Models\Village;
use Livewire\Component;

class AddressUpdate extends Component
{
    public $address;

    protected $rules = [
        'address.regency_id' => 'required|integer',
        'address.district_id' => 'required|integer',
        'address.village_id' => 'required|integer',
        'address.address' => 'required|string'
    ];

    public function render()
    {
        $regencyId = $this->address['regency_id'] ?? null;
        $districtId = $this->address['district_id'] ?? null;
        $villageId = $this->address['village_id'] ?? null;
        
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


    }
}

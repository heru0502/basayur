<?php


namespace App\Services;


use App\Models\CustomerAddress;
use App\Models\District;
use App\Models\Province;
use App\Models\Regency;
use App\Models\Village;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AddressService
{
    public function find()
    {
        $userId = Auth::guard('customer')->id();
        $address = CustomerAddress::with('village.district.regency')
            ->where('customer_id', $userId)
            ->select(
                '*',
                DB::raw("CONCAT(ST_Latitude(location_point), ',', ST_Longitude(location_point)) AS location_point")
            )
            ->first();

        return $address;
    }

    public function createOrUpdate(array $data)
    {
        $latLong = explode(',', $data['location_point']);
        $lat = $latLong[0];
        $long = $latLong[1];

        CustomerAddress::updateOrInsert(
            ['customer_id' => Auth::guard('customer')->id()],
            [
                'village_id' => $data['village_id'],
                'address' => $data['address'],
                'phone_number' => $data['phone_number'],
                'location_point' => DB::raw("ST_GeomFromText('POINT($lat $long)', 4326)")
            ]
        );
    }
}
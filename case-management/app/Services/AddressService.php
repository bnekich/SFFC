<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Address;
use App\Http\Requests\AddressFormRequest;
use Illuminate\Support\Facades\DB;

class AddressService
{
    public function getAllAddresses()
    {
        return Address::all();
    }

    public function createAddress(array $data): Address
    {
        return DB::transaction(function () use ($data) {
            return Address::create([
                'address_line_1' => $data['address_line_1'] ?? null,
                'address_line_2' => $data['address_line_2'] ?? null,
                'city' => $data['city'] ?? null,
                'state' => $data['state'] ?? null,
                'zip' => $data['zip'] ?? null,
                'created_by' => auth()->id(),
                'updated_by' => auth()->id(),
            ]);
        });
    }

    public function updateAddress(Address $address, array $data): Address
    {
        return DB::transaction(function () use ($address, $data) {
            $address->update([
                'address_line_1' => $data['address_line_1'] ?? null,
                'address_line_2' => $data['address_line_2'] ?? null,
                'city' => $data['city'] ?? null,
                'state' => $data['state'] ?? null,
                'zip' => $data['zip'] ?? null,
                'updated_by' => auth()->id(),
            ]);

            return $address;
        });
    }

    public function deleteAddress(Address $address): void
    {
        DB::transaction(function () use ($address) {
            $address->delete();
        });
    }
}

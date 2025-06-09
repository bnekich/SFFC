<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddressFormRequest;
use App\Models\Address;
use App\Services\AddressService;

class AddressController extends Controller
{
    protected AddressService $addressService;

    public function __construct(AddressService $addressService)
    {
        $this->addressService = $addressService;
    }

    public function index()
    {
        $this->logAction("Viewed all addresses", "index", "Address");
        return $this->addressService->getAllAddresses();
    }

    public function store(AddressFormRequest $request)
    {
        $this->logAction("Created a new address", "store", "Address");
        $validatedData = $request->validated();
        return $this->addressService->createAddress($validatedData);
    }

    public function show(Address $address)
    {
        return $address;
    }

    public function update(AddressFormRequest $request, Address $address)
    {
        $validatedData = $request->validated();
        return $this->addressService->updateAddress($address, $validatedData);
    }

    public function destroy(Address $address)
    {
        $this->addressService->deleteAddress($address);
        return response()->json(null, 204);
    }
}

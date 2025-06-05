<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddressFormRequest;
use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function index()
    {
        $this->logAction("Viewed all addresses", "index", "Address");
        return Address::all();
    }

    public function store(AddressFormRequest $request)
    {
        $this->logAction("Created a new address", "store", "Address");
        $validatedData = $request->validated();
        return Address::create($validatedData->all());
    }

    public function show(Address $address)
    {
        return $address;
    }

    public function update(Request $request, Address $address)
    {
        $request->validate([
            'address_line_1' => 'string|nullable',
            'address_line_2' => 'string|nullable',
            'city' => 'string|nullable',
            'state' => 'string|size:2|nullable',
            'zip' => 'string|max:10|nullable',
            'created_by' => 'nullable|exists:persons,id',
            'updated_by' => 'nullable|exists:persons,id',
        ]);

        $address->update($request->all());
        return $address;
    }

    public function destroy(Address $address)
    {
        $address->delete();
        return response()->json(null, 204);
    }
}

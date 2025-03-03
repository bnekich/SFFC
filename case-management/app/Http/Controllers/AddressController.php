<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function index()
    {
        return Address::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'address_line_1' => 'string|nullable',
            'address_line_2' => 'string|nullable',
            'city' => 'string|nullable',
            'state' => 'string|size:2|nullable',
            'zip' => 'string|max:10|nullable',
            'created_by' => 'required|string|max:255',
            'updated_by' => 'required|string|max:255',
        ]);

        return Address::create($request->all());
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
            'updated_by' => 'required|string|max:255',
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
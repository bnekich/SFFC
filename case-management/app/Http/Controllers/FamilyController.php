<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Family;
use App\Http\Requests\FamilyFormRequest;
use Illuminate\Http\Request;
use App\Enums\USState;
use App\Models\Address;

class FamilyController extends Controller
{
    //for family search
    public function search(Request $request)
    {
        $query = $request->input('q');
        $page = $request->input('page', 1);
        $perPage = 10;

        $families = Family::where('family_name', 'like', "%{$query}%")
            ->paginate($perPage);

        return response()->json([
            'items' => $families->items(),
            'current_page' => $families->currentPage(),
            'last_page' => $families->lastPage()
        ]);
    }

    public function index(Request $request)
    {
        $this->logAction("Viewed Families", "index", "Family");

        $query = Family::query();

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('family_name', 'like', "%$search%");
            });
        }

        $sort = $request->get('sort', 'family_name');
        $direction = $request->get('direction', 'asc');
        $query->orderBy($sort, $direction);

        $families = $query->paginate(10);

        return view('family.index', compact('families'));
    }

    public function create()
    {
        $this->logAction("Create Family", "create", "Family");
        $states = USState::cases();
        //$family = new Family();
        $address = new Address();
        return view('family.create', compact('states', 'address'));
    }

    public function store(FamilyFormRequest $request)
    {
        $this->logAction("Store Family", "store", "Family");
        $validatedData = $request->validated();
        $createdBy = auth()->user()->firstName . ' ' . auth()->user()->lastName;

        // Create the address if any address fields are provided
        $address = null;
        if (!empty(array_filter([
            $validatedData['address_line_1'] ?? null,
            $validatedData['address_line_2'] ?? null,
            $validatedData['city'] ?? null,
            $validatedData['state'] ?? null,
            $validatedData['zip'] ?? null,
        ]))) {
            $address = Address::create([
                'address_line_1' => $validatedData['address_line_1'] ?? null,
                'address_line_2' => $validatedData['address_line_2'] ?? null,
                'city' => $validatedData['city'] ?? null,
                'state' => $validatedData['state'] ?? null,
                'zip' => $validatedData['zip'] ?? null,
                'created_by' => $createdBy,
                'updated_by' => $createdBy,
            ]);
        }
        $family = Family::create([
            'family_name' => $validatedData['family_name'],
            'address_id' => $address ? $address->id : null,
            'created_by' => $createdBy,
            'updated_by' => $createdBy,
        ]);

        if (array_key_exists('person_ids', $validatedData)) {
            $family->persons()->attach($validatedData['person_ids']);
        }

        return redirect()->route('family.index')->with('success', 'Family created successfully.');
    }

    public function show(Family $family)
    {
        $this->logAction("Show Family", "show", "Family");
        return view('family.show', compact('family'));
    }

    public function edit(Family $family)
    {
        $states = USState::cases();

        return view('family.edit', compact('family', 'states'));
    }

    public function update(FamilyFormRequest $request, Family $family)
    {
        //
    }

    public function destroy(Family $family)
    {
        //
    }
}

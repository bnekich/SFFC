<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Family;
use App\Http\Requests\FamilyFormRequest;
use Illuminate\Http\Request;
use App\Enums\USState;
use App\Models\Address;
use App\Services\FamilyService;

class FamilyController extends Controller
{
    protected FamilyService $familyService;

    public function __construct(FamilyService $familyService)
    {
        $this->familyService = $familyService;
    }

    //for family search
    public function search(Request $request)
    {
        $query = $request->input('q');
        $page = (int) $request->input('page', 1);
        $perPage = (int) $request->input('per_page', 10);

        $families = $this->familyService->searchFamilies($query, $page, $perPage);

        return response()->json([
            'items' => $families->items(),
            'current_page' => $families->currentPage(),
            'last_page' => $families->lastPage()
        ]);
    }

    public function index(Request $request)
    {
        $this->logAction("Viewed Families", "index", "Family");

        $filters = ['search' => $request->search];
        $sort = [
            'field' => $request->get('sort', 'family_name'),
            'direction' => $request->get('direction', 'asc')
        ];

        $families = $this->familyService->getFamilies($filters, $sort);
        return view('family.index', compact('families'));
    }

    public function create()
    {
        $this->logAction("Create Family", "create", "Family");
        $states = USState::cases();
        $address = new Address();
        return view('family.create', compact('states', 'address'));
    }

    public function store(FamilyFormRequest $request)
    {
        $this->logAction("Store Family", "store", "Family");
        $validatedData = $request->validated();

        try {
            $family = $this->familyService->createFamily($validatedData);
            return redirect()->route('family.index')->with('success', 'Family created successfully.');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Failed to create family: ' . $e->getMessage());
        }
    }

    public function show(Family $family)
    {
        $this->logAction("Show Family", "show", "Family");
        return view('family.show', compact('family'));
    }

    public function edit(Family $family)
    {
        $this->logAction("Edit Family", "edit", "Family");
        $states = USState::cases();
        return view('family.edit', compact('family', 'states'));
    }

    public function update(FamilyFormRequest $request, Family $family)
    {
        $this->logAction("Update Family", "update", "Family");
        $validatedData = $request->validated();

        try {
            $family = $this->familyService->updateFamily($family, $validatedData);
            return redirect()->route('family.show', $family)->with('success', 'Family updated successfully.');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Failed to update family: ' . $e->getMessage());
        }
    }

    public function destroy(Family $family)
    {
        $this->logAction("Delete Family", "destroy", "Family");
        try {
            $this->familyService->deleteFamily($family);
            return redirect()->route('family.index')->with('success', 'Family deleted successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to delete family: ' . $e->getMessage());
        }
    }
}

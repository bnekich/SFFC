<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\IntakeFormRequest;
use App\Models\Intake;
use App\Services\IntakeService;
use App\Models\IntakeStatus;
use Illuminate\Support\Facades\Auth;
use App\Enums\Ethnicity;
use App\Enums\Gender;
use App\Enums\USState;
use App\Models\Address;
use App\Models\OrganizationType;
use App\Models\Organization;

class IntakeController extends Controller
{
    protected IntakeService $intakeService;

    public function __construct(IntakeService $intakeService)
    {
        $this->intakeService = $intakeService;
    }

    public function index(IntakeFormRequest $request)
    {
        $this->logAction("Viewed Intakes", "index", "Intake");

        $filters = [
            'search' => $request->search,
            'status' => $request->status,
        ];

        $sort = [
            'field' => $request->get('sort', 'id'),
            'direction' => $request->get('direction', 'asc')
        ];

        $intakes = $this->intakeService->getIntakes($filters, $sort);
        $statuses = IntakeStatus::all();

        return view('intake.index', compact('intakes', 'statuses'));
    }

    public function create()
    {
        $this->logAction("Create Intake", "create", "Intake");

        $intakeStatuses = IntakeStatus::where('name', 'New')->get();
        $ethnicities = Ethnicity::cases();
        $genders = Gender::cases();
        $states = USState::cases();
        $address = new Address();
        $organizations = Organization::whereHas('organizationType', function ($query) {
            $query->where('name', 'like', '%Safe Families%');
        })->get();
        $urgencies = ['Urgent', 'Within The Next Week', 'Within The Next Month'];

        $orgTypes = OrganizationType::all();

        return view('intake.create', compact('intakeStatuses', 'ethnicities', 'genders', 'states', 'address', 'organizations', 'orgTypes', 'urgencies'));
    }

    public function store(IntakeFormRequest $request)
    {
        $this->logAction("Store Intake", "store", "Intake");
        $validatedData = $request->validated();

        try {
            $intake = $this->intakeService->createIntake($validatedData);
            if (Auth::check()) {
                return redirect()->route('intake.show', $intake->id)->with('success', 'Referral created successfully.');
            } else {
                return redirect()->route('intake.thankyou')->with('success', 'Referral created successfully.');
            }
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Failed to create intake: ' . $e->getMessage());
        }
    }

    public function show(Intake $intake)
    {
        $this->logAction("View Intake", "show", "Intake", $intake->id);
        return view('intake.show', compact('intake'));
    }

    public function edit(Intake $intake)
    {
        $this->logAction("Edit Intake", "edit", "Intake", $intake->id);
        $intakeStatuses = IntakeStatus::all();
        $ethnicities = Ethnicity::cases();
        $genders = Gender::cases();
        $states = USState::cases();
        $organizations = Organization::whereHas('organizationType', function ($query) {
            $query->where('name', 'like', '%Safe Families%');
        })->get();
        $urgencies = ['Urgent', 'Within The Next Week', 'Within The Next Month'];
        $orgTypes = OrganizationType::all();

        return view('intake.edit', compact('intake', 'intakeStatuses', 'ethnicities', 'genders', 'states', 'organizations', 'orgTypes', 'urgencies'));
    }

    public function update(IntakeFormRequest $request, Intake $intake)
    {
        $this->logAction("Update Intake", "update", "Intake", $intake->id);
        $validatedData = $request->validated();

        try {
            $intake = $this->intakeService->updateIntake($intake, $validatedData);
            return redirect()->route('intake.show', $intake)->with('success', 'Intake updated successfully.');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Failed to update intake: ' . $e->getMessage());
        }
    }

    public function destroy(Intake $intake)
    {
        $this->logAction("Delete Intake", "destroy", "Intake", $intake->id);
        try {
            $this->intakeService->deleteIntake($intake);
            return redirect()->route('intake.index')->with('success', 'Intake deleted successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to delete intake: ' . $e->getMessage());
        }
    }
}

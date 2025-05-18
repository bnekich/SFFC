<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\IntakeFormRequest;
use App\Enums\Statuses\IntakeStatus;
//use App\Enums\Ethnicity;
use App\Models\Intake;
use App\Models\Document;

class IntakeController extends Controller
{
    public function search(IntakeFormRequest $request)
    {
        $query = $request->input('query');
        $documents = Document::whereRaw('MATCH(content) AGAINST(? IN BOOLEAN MODE)', [$query])
            ->where('user_id', auth()->id()) // Restrict to user
            ->get();

        return view('document.index', compact('documents'));
    }

    public function index(IntakeFormRequest $request)
    {
        $this->logAction("Viewed Intakes", "index", "Intake");

        $query = Intake::query();

        // Search functionality
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('parent_name', 'like', "%$search%")
                    ->orWhere('case_summary', 'like', "%$search%");
            });
        }

        // Apply status filter
        if ($request->filled('status')) {
            $query->where('intake_status', $request->status);
        }

        // Sort functionality
        $sort = $request->get('sort', 'id'); // default sort by id
        $direction = $request->get('direction', 'asc'); // default ascending

        $query->orderBy($sort, $direction);

        $intakes = $query->paginate(10); // Adjust pagination as needed
        $statuses = IntakeStatus::cases();


        return view('intake.index', compact('intakes', 'statuses'));
    }

    public function create()
    {
        $this->logAction("Create Intake", "create", "Intake");
        $intakeStatuses = IntakeStatus::cases();
        return view('intake.create', compact('intakeStatuses'));
    }

    public function store(IntakeFormRequest $request)
    {
        $validatedData = $request->validated();
        $intake = Intake::create([
            'completed_by_id' => auth()->id(),
            'parent_name' => $validatedData['parent_name'],
            'parent_phone' => $validatedData['parent_phone'],
            'referral_date' => $validatedData['referral_date'],
            'referral_contact' => $validatedData['referral_contact'],
            'case_summary' => $validatedData['case_summary'],
            'hasSFFCHistory' => $validatedData['hasSFFCHistory'],
            //'do_not_share_list' => $validatedData['do_not_share_list'],
            'requesting_host_family' => $validatedData['requesting_host_family'],
            'requesting_family_friend' => $validatedData['requesting_family_friend'],
            'requesting_resource_friend' => $validatedData['requesting_resource_friend'],
            //'urgency' => $validatedData['urgency'],
            //'expected_support_duration' => $validatedData['expected_support_duration'],
            //'family_preference' => $validatedData['family_preference'],
            //'known_risks' => $validatedData['known_risks'],
            //'child_protective_services_experience' => $validatedData['child_protective_services_experience'],
            //'emotional_behavioral_medical_concerns' => $validatedData['emotional_behavioral_medical_concerns'],
            //'is_a_sffc_fit' => $validatedData['is_a_sffc_fit'],
            //'resources_provided' => $validatedData['resources_provided'],
            'intake_status' => $validatedData['intake_status'],
            'created_by' => auth()->id(),
            'updated_by' => auth()->id(),
        ]);

        return redirect()->route('intake.show', $intake->id)->with('success', 'Intake created successfully.');
    }

    public function show(Intake $intake)
    {
        return view('intake.show', compact('intake'));
    }

    public function edit(Intake $intake)
    {
        $this->logAction("Edit Intake", "edit", "Intake");
        $intakeStatuses = IntakeStatus::cases();
        return view('intake.edit', compact('intake', 'intakeStatuses'));
    }

    public function update(IntakeFormRequest $request, Intake $intake)
    {
        $validatedData = $request->validated();

        $intake->update([
            //'completed_by_id' => auth()->id(),
            'parent_name' => $validatedData['parent_name'],
            'parent_phone' => $validatedData['parent_phone'],
            'referral_date' => $validatedData['referral_date'],
            'referral_contact' => $validatedData['referral_contact'],
            'case_summary' => $validatedData['case_summary'],
            'hasSFFCHistory' => $validatedData['hasSFFCHistory'],
            //'do_not_share_list' => $validatedData['do_not_share_list'],
            'requesting_host_family' => $validatedData['requesting_host_family'],
            'requesting_family_friend' => $validatedData['requesting_family_friend'],
            'requesting_resource_friend' => $validatedData['requesting_resource_friend'],
            //'urgency' => $validatedData['urgency'],
            //'expected_support_duration' => $validatedData['expected_support_duration'],
            //'family_preference' => $validatedData['family_preference'],
            //'known_risks' => $validatedData['known_risks'],
            //'child_protective_services_experience' => $validatedData['child_protective_services_experience'],
            //'emotional_behavioral_medical_concerns' => $validatedData['emotional_behavioral_medical_concerns'],
            //'is_a_sffc_fit' => $validatedData['is_a_sffc_fit'],
            //'resources_provided' => $validatedData['resources_provided'],
            'intake_status' => $validatedData['intake_status'],
            'updated_by' => auth()->id(),
        ]);


        return redirect()->route('intake.show', $intake)->with('success', 'Intake updated successfully.');
    }

    public function destroy(Intake $intake)
    {
        $intake->delete();
        return redirect()->route('intake.index')->with('success', 'Intake deleted successfully.');
    }
}

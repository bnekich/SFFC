<?php

namespace App\Http\Controllers;

use App\Models\IntakeStatus;
use App\Http\Requests\IntakeStatusFormRequest;
use App\Models\Intake;
use Illuminate\Validation\Rules\In;

class IntakeStatusController extends Controller
{
    public function index()
    {
        $this->logAction("Viewed Intake Statuses", "index", "Intake Status");

        $intakeStatuses = IntakeStatus::paginate();
        return view('intake-statuses.index', compact('intakeStatuses'));
    }

    public function store(IntakeStatusFormRequest $request)
    {
        $request->validated();
        IntakeStatus::create($request->only('name'));

        return redirect()->route('intake-statuses.index')
            ->with('success', 'Intake Status created successfully.');
    }

    public function update(IntakeStatusFormRequest $request, IntakeStatus $intakeStatus)
    {
        $request->validated();

        $intakeStatus->update($request->only('name'));

        return redirect()->route('intake-statuses.index')
            ->with('success', 'Intake Status updated successfully.');
    }

    public function destroy(IntakeStatus $intakeStatus)
    {
        //
    }
}

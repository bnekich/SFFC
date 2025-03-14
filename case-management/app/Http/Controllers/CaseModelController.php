<?php
// filepath: d:\source\SFFC\case-management\app\Http\Controllers\CaseModelController.php
namespace App\Http\Controllers;

use App\Models\CaseModel;
use Illuminate\Http\Request;

class CaseModelController extends Controller
{
    public function index()
    {
        $cases = CaseModel::all();
        return view('cases.index', compact('cases'));
    }

    public function create()
    {
        return view('cases.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'case_identifier' => 'required|unique:cases|max:255',
            'case_description' => 'nullable',
            // Add other validation rules as needed
        ]);

        CaseModel::create($request->all());
        return redirect()->route('cases.index')->with('success', 'Case created successfully.');
    }

    public function show(CaseModel $case)
    {
        return view('cases.show', compact('case'));
    }

    public function edit(CaseModel $case)
    {
        return view('cases.edit', compact('case'));
    }

    public function update(Request $request, CaseModel $case)
    {
        $request->validate([
            'case_identifier' => 'required|max:255|unique:cases,case_identifier,' . $case->id,
            'case_description' => 'nullable',
            // Add other validation rules as needed
        ]);

        $case->update($request->all());
        return redirect()->route('cases.index')->with('success', 'Case updated successfully.');
    }

    public function destroy(CaseModel $case)
    {
        $case->delete();
        return redirect()->route('cases.index')->with('success', 'Case deleted successfully.');
    }
}

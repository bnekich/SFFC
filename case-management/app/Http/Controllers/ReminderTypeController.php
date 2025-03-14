<?php

namespace App\Http\Controllers;

use App\Models\ReminderType;
use Illuminate\Http\Request;

class ReminderTypeController extends Controller
{
    public function index()
    {
        $types = ReminderType::all();
        return view('admin.reminder-types.index', compact('types'));
    }

    public function create()
    {
        return view('admin.reminder-types.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:reminder_types,name',
        ]);

        ReminderType::create($request->only('name'));
        return redirect()->route('reminder-types.index')->with('success', 'Reminder type created successfully.');
    }

    public function edit(ReminderType $reminderType)
    {
        return view('admin.reminder-types.edit', compact('reminderType'));
    }

    public function update(Request $request, ReminderType $reminderType)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:reminder_types,name,' . $reminderType->id,
        ]);

        $reminderType->update($request->only('name'));
        return redirect()->route('reminder-types.index')->with('success', 'Reminder type updated successfully.');
    }

    public function destroy(ReminderType $reminderType)
    {
        $reminderType->delete();
        return redirect()->route('reminder-types.index')->with('success', 'Reminder type deleted successfully.');
    }
}

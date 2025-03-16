<?php
// filepath: d:\source\SFFC\case-management\app\Http\Controllers\AuditLogController.php
namespace App\Http\Controllers\Admin;

use App\Models\AuditLog;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuditLogController extends Controller
{
    public function index()
    {
        $auditLogs = AuditLog::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.audit-logs.index', compact('auditLogs'));
    }

    // public function create()
    // {
    //     return view('audit_logs.create');
    // }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'action' => 'required|max:255',
    //         'model_type' => 'nullable|max:255',
    //         'model_id' => 'nullable|integer',
    //         'details' => 'nullable',
    //     ]);

    //     AuditLog::create($request->all());
    //     return redirect()->route('audit-logs.index')->with('success', 'Audit Log created successfully.');
    // }

    public function show(AuditLog $auditLog)
    {
        return view('admin.audit-logs.show', compact('auditLog'));
    }

    // public function edit(AuditLog $auditLog)
    // {
    //     return view('audit_logs.edit', compact('auditLog'));
    // }

    // public function update(Request $request, AuditLog $auditLog)
    // {
    //     $request->validate([
    //         'action' => 'required|max:255',
    //         'model_type' => 'nullable|max:255',
    //         'model_id' => 'nullable|integer',
    //         'details' => 'nullable',
    //     ]);

    //     $auditLog->update($request->all());
    //     return redirect()->route('audit-logs.index')->with('success', 'Audit Log updated successfully.');
    // }

    // public function destroy(AuditLog $auditLog)
    // {
    //     $auditLog->delete();
    //     return redirect()->route('audit-logs.index')->with('success', 'Audit Log deleted successfully.');
    // }
}

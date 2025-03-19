<?php

namespace App\Http\Controllers\Admin;

use App\Models\AuditLog;
use App\Http\Controllers\Controller;

class AuditLogController extends Controller
{
    public function index()
    {
        $auditLogs = AuditLog::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.audit-logs.index', compact('auditLogs'));
    }

    public function show(AuditLog $auditLog)
    {
        return view('admin.audit-logs.show', compact('auditLog'));
    }
}

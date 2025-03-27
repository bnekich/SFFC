<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Models\AuditLog;
use App\Http\Controllers\Controller;

class AuditLogController extends Controller
{
    public function index()
    {
        $this->logAction("User viewed audit logs", "index", "AuditLog");
        $auditLogs = AuditLog::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.audit-logs.index', compact('auditLogs'));
    }

    public function show(AuditLog $auditLog)
    {
        $this->logAction("User viewed audit log detail", "show", "AuditLog");
        return view('admin.audit-logs.show', compact('auditLog'));
    }
}

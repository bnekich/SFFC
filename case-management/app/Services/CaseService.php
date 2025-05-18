<?php

namespace App\Services;

use App\Models\CaseModel;
use App\Models\Family;
use App\Models\Person;
use App\Models\User;
use App\Models\AuditLog; // Assuming you have this
use Illuminate\Support\Facades\DB;
use PHPUnit\TextUI\Help;

class CaseService
{
    public function createCase(array $data, User $currentUser): CaseModel
    {
        if (CaseModel::where('case_identifier', $data['case_identifier'])->exists()) {
            throw new \DomainException("The case identifier '{$data['case_identifier']}' is already in use.");
        }

        return DB::transaction(function () use ($data, $currentUser) {

            $case = CaseModel::create([
                'case_identifier' => $data['case_identifier'],
                'case_description' => $data['case_description'],
                'client_family_id' => $data['client_family_id'],
                'host_family_id' => $data['host_family_id'],
                'assigned_staff_id' => $data['assigned_staff_id'],
                'start_date' => $data['start_date'],
                'status' => $data['status'],
                'created_by' => auth()->id(),
                'updated_by' => auth()->id(),
            ]);

            // Send notifications
            // Notification::send($assignedStaff, new CaseAssignedNotification($case));

            return $case;
        });
    }
}

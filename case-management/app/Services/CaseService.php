<?php

namespace App\Services;

use App\Models\CaseModel;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class CaseService
{
    public function createCase(array $data): CaseModel
    {
        if (CaseModel::where('case_identifier', $data['case_identifier'])->exists()) {
            throw new \DomainException("The case identifier '{$data['case_identifier']}' is already in use.");
        }

        return DB::transaction(function () use ($data) {

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

    public function updateCase(array $data): CaseModel
    {

        return DB::transaction(function () use ($data) {
            $case = CaseModel::find($data['id']);

            $case->update([
                'status' => $data['status'],
                'start_date' => $data['start_date'],
                'end_date' => $data['end_date'],
                'case_description' => $data['case_description'],
                'client_family_id' => $data['client_family_id'],
                'host_family_id' => $data['host_family_id'],
                'assigned_staff_id' => $data['assigned_staff_id'],
                'updated_by' => auth()->id(),
            ]);

            return $case;
        });
    }
}

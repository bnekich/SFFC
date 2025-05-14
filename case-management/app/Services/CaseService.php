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

        // It's good practice to wrap database operations in a transaction
        // if multiple records are being created/updated.
        return DB::transaction(function () use ($data, $currentUser) {
            $creator = is_null($currentUser) ? 'system' : HelperService::getFormattedUserName($currentUser);

            // Simplified family creation for example
            // $clientFamily = Family::firstOrCreate(['family_name' => $data['client_family_name'] /* ... more attributes */]);
            // $hostFamily = null;
            // if (!empty($data['host_family_name'])) {
            //     $hostFamily = Family::firstOrCreate(['family_name' => $data['host_family_name'] /* ... more attributes */]);
            // }

            //$assignedStaff = Person::findOrFail($data['assigned_staff_id']);
            // Add more robust role checking if needed, or handle in FormRequest/Policy

            $case = CaseModel::create([
                'case_identifier' => $data['case_identifier'],
                'case_description' => $data['case_description'],
                'client_family_id' => $data['client_family_id'],
                'host_family_id' => $data['host_family_id'],
                'assigned_staff_id' => $data['assigned_staff_id'],
                'start_date' => $data['start_date'],
                'status' => $data['status'],
                'created_by' => $creator,
                'updated_by' => $creator,
            ]);

            // Send notifications
            // Notification::send($assignedStaff, new CaseAssignedNotification($case));

            // Log audit
            // AuditLog::create([
            //     'user_id' => $currentUser->id,
            //     'action' => 'created_case',
            //     'model_type' => CaseModel::class,
            //     'model_id' => $case->id,
            //     'details' => ['identifier' => $case->case_identifier],
            // ]);

            return $case;
        });
    }
}

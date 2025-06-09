<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\CaseModel;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;

class CaseService
{
    public function getCases(array $filters = [], array $sort = []): LengthAwarePaginator
    {
        $query = CaseModel::query();

        if (!empty($filters['search'])) {
            $search = $filters['search'];
            $query->where(function ($q) use ($search) {
                $q->where('case_identifier', 'like', "%{$search}%")
                    ->orWhere('case_description', 'like', "%{$search}%");
            });
        }

        if (!empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        $sort['field'] = $sort['field'] ?? 'case_identifier';
        $sort['direction'] = $sort['direction'] ?? 'asc';
        $query->orderBy($sort['field'], $sort['direction']);

        return $query->paginate(10);
    }

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
                'end_date' => $data['end_date'] ?? null,
                'status' => $data['status'],
                'created_by' => auth()->id(),
                'updated_by' => auth()->id(),
            ]);

            // TODO: Implement notifications
            // Notification::send($assignedStaff, new CaseAssignedNotification($case));

            return $case;
        });
    }

    public function updateCase(CaseModel $case, array $data): CaseModel
    {
        return DB::transaction(function () use ($case, $data) {
            $case->update([
                'case_description' => $data['case_description'],
                'client_family_id' => $data['client_family_id'],
                'host_family_id' => $data['host_family_id'],
                'assigned_staff_id' => $data['assigned_staff_id'],
                'start_date' => $data['start_date'],
                'end_date' => $data['end_date'] ?? null,
                'status' => $data['status'],
                'updated_by' => auth()->id(),
            ]);

            return $case;
        });
    }

    public function deleteCase(CaseModel $case): void
    {
        DB::transaction(function () use ($case) {
            $case->delete();
        });
    }
}

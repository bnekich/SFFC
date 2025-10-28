<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Intake;
use App\Models\Document;
use App\Http\Requests\IntakeFormRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class IntakeService
{
    public function getIntakes(array $filters = [], array $sort = []): LengthAwarePaginator
    {
        $query = Intake::query();

        if (!empty($filters['search'])) {
            $search = $filters['search'];
            $query->where(function ($q) use ($search) {
                $q->where('parent_name', 'like', "%{$search}%")
                    ->orWhere('case_summary', 'like', "%{$search}%");
            });
        }

        if (!empty($filters['status'])) {
            $query->where('intake_status_id', $filters['status']);
        }

        $sort['field'] = $sort['field'] ?? 'id';
        $sort['direction'] = $sort['direction'] ?? 'asc';
        $query->orderBy($sort['field'], $sort['direction']);

        return $query->paginate(10);
    }

    public function createIntake(array $data): Intake
    {
        return DB::transaction(function () use ($data) {
            return Intake::create([
                'completed_by_id' => auth()->id(),
                'parent_name' => $data['parent_name'],
                'parent_phone' => $data['parent_phone'],
                'referral_date' => $data['referral_date'],
                'referral_contact' => $data['referral_contact'],
                'case_summary' => $data['case_summary'],
                'hasSFFCHistory' => $data['hasSFFCHistory'],
                'requesting_host_family' => $data['requesting_host_family'],
                'requesting_family_friend' => $data['requesting_family_friend'],
                'requesting_resource_friend' => $data['requesting_resource_friend'],
                'intake_status_id' => $data['intake_status_id'],
                'created_by' => auth()->id(),
                'updated_by' => auth()->id(),
            ]);
        });
    }

    public function updateIntake(Intake $intake, array $data): Intake
    {
        return DB::transaction(function () use ($intake, $data) {
            $intake->update([
                'parent_name' => $data['parent_name'],
                'parent_phone' => $data['parent_phone'],
                'referral_date' => $data['referral_date'],
                'referral_contact' => $data['referral_contact'],
                'case_summary' => $data['case_summary'],
                'hasSFFCHistory' => $data['hasSFFCHistory'],
                'requesting_host_family' => $data['requesting_host_family'],
                'requesting_family_friend' => $data['requesting_family_friend'],
                'requesting_resource_friend' => $data['requesting_resource_friend'],
                'intake_status_id' => $data['intake_status_id'],
                'updated_by' => auth()->id(),
            ]);

            return $intake;
        });
    }

    public function deleteIntake(Intake $intake): void
    {
        DB::transaction(function () use ($intake) {
            $intake->delete();
        });
    }
}

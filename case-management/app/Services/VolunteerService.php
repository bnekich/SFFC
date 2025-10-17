<?php

declare(strict_types=1);

namespace App\Services;

use App\Http\Requests\VolunteerFormRequest;
use App\Models\Volunteer;
use App\Services\Responses\VolunteerServiceResponse;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class VolunteerService
{
  public function searchVolunteers(string $query, int $page = 1, int $perPage = 10): LengthAwarePaginator
  {
    return Volunteer::whereHas('person', function ($q) use ($query) {
      $q->where('last_name', 'like', "%{$query}%")
        ->orWhere('first_name', 'like', "%{$query}%");
    })->paginate($perPage);
  }

  public function getVolunteers(array $filters = [], array $sort = []): LengthAwarePaginator
  {
    $query = Volunteer::query();

    if (!empty($filters['search'])) {
      $search = $filters['search'];
      $query->whereHas('person', function ($q) use ($search) {
        $q->where('last_name', 'like', "%{$search}%")
          ->orWhere('first_name', 'like', "%{$search}%");
      });
    }

    if (!empty($filters['volunteer_status'])) {
      $query->where('volunteer_status_id', $filters['volunteer_status']);
    }

    $sort['field'] = $sort['field'] ?? 'created_at';
    $sort['direction'] = $sort['direction'] ?? 'desc';
    $query->orderBy($sort['field'], $sort['direction']);

    return $query->paginate(10);
  }

  // public function createVolunteer(array $data, VolunteerFormRequest $request): VolunteerServiceResponse
  // {
  //   return DB::transaction(function () use ($data, $request) {
  //     $volunteer = Volunteer::create([
  //       'person_id' => $data['person_id'],
  //       'county' => $data['county'] ?? null,
  //       'church_id' => $data['church_id'] ?? null,
  //       'volunteer_status_id' => $data['volunteer_status_id'],
  //       'created_by' => auth()->id(),
  //       'updated_by' => auth()->id(),
  //     ]);

  //     return new VolunteerServiceResponse($volunteer);
  //   });
  // }

  // public function updateVolunteer(VolunteerFormRequest $request): VolunteerServiceResponse
  // {
  //   return DB::transaction(function () use ($request) {
  //     $volunteer = $request->volunteer;
  //     $volunteer->update([
  //       'county' => $request->input['county'] ?? null,
  //       'church_id' => $request->input['church_id'] ?? null,
  //       'volunteer_status_id' => $request->input['volunteer_status_id'],
  //       'updated_by' => auth()->id(),
  //     ]);

  //     return new VolunteerServiceResponse($volunteer);
  //   });
  // }

  public function deleteVolunteer(Volunteer $volunteer): void
  {
    DB::transaction(function () use ($volunteer) {
      $volunteer->delete();
    });
  }
}

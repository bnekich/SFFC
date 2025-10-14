<?php

namespace App\Services;

use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\User;

class UserService
{
  public function getUsers(array $filters = [], array $sort = []): LengthAwarePaginator
  {
    $query = User::query()->with('roles');

    if (!empty($filters['search'])) {
      $search = $filters['search'];
      $query->where('lastName', 'like', "%{$search}%")
        ->orWhere('firstName', 'like', "%{$search}%")
        ->orWhere('email', 'like', "%{$search}%");
    }

    $sort['field'] = $sort['field'] ?? 'lastName';
    $sort['direction'] = $sort['direction'] ?? 'asc';
    $query->orderBy($sort['field'], $sort['direction']);

    return $query->paginate(10);
  }
}

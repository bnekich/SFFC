<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\OrganizationFormRequest;
use App\Models\Organization;

class OrganizationController extends Controller
{
  //for organization search
  public function search(OrganizationFormRequest $request)
  {
    $this->logAction("Searched Organizations", "search", "Organization");
    $query = $request->input('q');
    $page = $request->input('page', 1);
    $perPage = 10;

    $organizations = Organization::where('name', 'like', "%{$query}%")
      ->join('persons', 'organizations.contact_person_id', '=', 'persons.id')
      ->paginate($perPage);

    return response()->json([
      'items' => $organizations->items(),
      'current_page' => $organizations->currentPage(),
      'last_page' => $organizations->lastPage()
    ]);
  }

  public function index(OrganizationFormRequest $request)
  {
    $this->logAction("Viewed Organizations", "index", "Organization");

    $query = Organization::query();

    if ($request->has('search') && $request->search != '') {
      $search = $request->search;
      $query->join('persons', 'organizations.contact_person_id', '=', 'persons.id');
      $query->where(function ($q) use ($search) {
        $q->where('name', 'like', "%$search%")
          ->orWhere('first_name', 'like', "%$search%")
          ->orWhere('last_name', 'like', "%$search%");
      });
    }

    $sort = $request->get('sort', 'name');
    $direction = $request->get('direction', 'asc');
    $query->orderBy($sort, $direction);

    $organizations = $query->paginate(10);

    return view('organization.index', compact('organizations'));
  }
}

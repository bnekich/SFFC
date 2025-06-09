<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Family;
use App\Models\Address;
use App\Http\Requests\FamilyFormRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;

class FamilyService
{
    public function searchFamilies(string $query, int $page = 1, int $perPage = 10): LengthAwarePaginator
    {
        return Family::where('family_name', 'like', "%{$query}%")
            ->paginate($perPage);
    }

    public function getFamilies(array $filters = [], array $sort = []): LengthAwarePaginator
    {
        $query = Family::query();

        if (!empty($filters['search'])) {
            $search = $filters['search'];
            $query->where('family_name', 'like', "%{$search}%");
        }

        $sort['field'] = $sort['field'] ?? 'family_name';
        $sort['direction'] = $sort['direction'] ?? 'asc';
        $query->orderBy($sort['field'], $sort['direction']);

        return $query->paginate(10);
    }

    public function createFamily(array $data): Family
    {
        return DB::transaction(function () use ($data) {
            // Create the address if any address fields are provided
            $address = null;
            if (!empty(array_filter([
                $data['address_line_1'] ?? null,
                $data['address_line_2'] ?? null,
                $data['city'] ?? null,
                $data['state'] ?? null,
                $data['zip'] ?? null,
            ]))) {
                $address = Address::create([
                    'address_line_1' => $data['address_line_1'] ?? null,
                    'address_line_2' => $data['address_line_2'] ?? null,
                    'city' => $data['city'] ?? null,
                    'state' => $data['state'] ?? null,
                    'zip' => $data['zip'] ?? null,
                    'created_by' => auth()->id(),
                    'updated_by' => auth()->id(),
                ]);
            }

            $family = Family::create([
                'family_name' => $data['family_name'],
                'address_id' => $address ? $address->id : null,
                'created_by' => auth()->id(),
                'updated_by' => auth()->id(),
            ]);

            if (isset($data['person_ids'])) {
                $family->persons()->attach($data['person_ids']);
            }

            return $family;
        });
    }

    public function updateFamily(Family $family, array $data): Family
    {
        return DB::transaction(function () use ($family, $data) {
            $family->update([
                'family_name' => $data['family_name'],
                'updated_by' => auth()->id(),
            ]);

            // Update or create address
            if (!empty(array_filter([
                $data['address_line_1'] ?? null,
                $data['address_line_2'] ?? null,
                $data['city'] ?? null,
                $data['state'] ?? null,
                $data['zip'] ?? null,
            ]))) {
                if ($family->address) {
                    $family->address->update([
                        'address_line_1' => $data['address_line_1'] ?? null,
                        'address_line_2' => $data['address_line_2'] ?? null,
                        'city' => $data['city'] ?? null,
                        'state' => $data['state'] ?? null,
                        'zip' => $data['zip'] ?? null,
                        'updated_by' => auth()->id(),
                    ]);
                } else {
                    $address = Address::create([
                        'address_line_1' => $data['address_line_1'] ?? null,
                        'address_line_2' => $data['address_line_2'] ?? null,
                        'city' => $data['city'] ?? null,
                        'state' => $data['state'] ?? null,
                        'zip' => $data['zip'] ?? null,
                        'created_by' => auth()->id(),
                        'updated_by' => auth()->id(),
                    ]);
                    $family->address()->associate($address)->save();
                }
            }

            if (isset($data['person_ids'])) {
                $family->persons()->sync($data['person_ids']);
            }

            return $family;
        });
    }

    public function deleteFamily(Family $family): void
    {
        DB::transaction(function () use ($family) {
            $family->delete();
        });
    }
}

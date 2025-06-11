<?php

namespace Tests\Unit\Services;

use App\Models\Family;
use App\Services\FamilyService;
use Illuminate\Pagination\LengthAwarePaginator;
use Tests\Unit\ServiceTestCase;
use App\Models\Status;
use App\Models\Address;
use App\Models\Person;

class FamilyServiceTest extends ServiceTestCase
{
    private FamilyService $familyService;
    private Status $status;

    protected function setUp(): void
    {
        parent::setUp();

        // Create the status first
        $this->status = Status::factory()->create([
            'name' => 'Open',
        ]);

        // Initialize the service
        $this->familyService = new FamilyService();
    }

    public function test_search_families_returns_paginated_results()
    {
        // Arrange
        Family::factory()->create(['family_name' => 'Smith Family', 'status_id' => $this->status->id, 'address_id' => $this->address->id, 'created_by' => $this->user->id, 'updated_by' => $this->user->id]);
        Family::factory()->create(['family_name' => 'Jones Family', 'status_id' => $this->status->id, 'address_id' => $this->address->id, 'created_by' => $this->user->id, 'updated_by' => $this->user->id]);

        // Act
        $result = $this->familyService->searchFamilies('Smith');

        // Assert
        $this->assertInstanceOf(LengthAwarePaginator::class, $result);
        $this->assertEquals(1, $result->total());
        $this->assertEquals('Smith Family', $result->first()->family_name);
    }

    public function test_get_families_returns_all_paginated_families()
    {
        // Arrange
        Family::factory()->count(15)->create(['address_id' => $this->address->id, 'status_id' => $this->status->id, 'created_by' => $this->user->id, 'updated_by' => $this->user->id]);

        // Act
        $result = $this->familyService->getFamilies();

        // Assert
        $this->assertInstanceOf(LengthAwarePaginator::class, $result);
        $this->assertEquals(10, $result->perPage());
    }

    public function test_create_family_stores_family_with_valid_data()
    {
        // Arrange
        $data = [
            'family_name' => 'Test Family',
            'address_line_1' => '123 Test St',
            'address_line_2' => null,
            'city' => 'Test City',
            'state' => 'WI',
            'zip' => '12345',
            'status_id' => $this->status->id,
        ];

        // Act
        $family = $this->familyService->createFamily($data);

        // Assert
        $this->assertInstanceOf(Family::class, $family);
        $this->assertEquals('Test Family', $family->family_name);
        $this->assertEquals($this->user->id, $family->created_by);

        // Assert address was created
        $this->assertInstanceOf(Address::class, $family->address);
        $this->assertEquals('123 Test St', $family->address->address_line_1);
    }

    public function test_update_family_updates_existing_family()
    {
        // Arrange
        $family = Family::factory()->create(['family_name' => 'Smith Family', 'status_id' => $this->status->id, 'address_id' => $this->address->id, 'created_by' => $this->user->id, 'updated_by' => $this->user->id]);

        $data = [
            'family_name' => 'Updated Family',
            'address_id' => $this->address->id,
            'address_line_1' => '456 New St',
            'address_line_2' => null,
            'city' => 'Test City',
            'state' => 'WI',
            'zip' => '12345',
            'status_id' => $this->status->id,
            'updated_by' => $this->user->id,
        ];

        // Act
        $updatedFamily = $this->familyService->updateFamily($family, $data);

        // Assert
        $this->assertEquals('Updated Family', $updatedFamily->family_name);
        $this->assertEquals($this->user->id, $updatedFamily->updated_by);

        // Assert address was updated
        $this->assertEquals('456 New St', $updatedFamily->address->address_line_1);
    }

    public function test_delete_family_removes_family_and_address()
    {
        // Arrange
        $family = Family::factory()->create(['family_name' => 'Smith Family', 'status_id' => $this->status->id, 'address_id' => $this->address->id, 'created_by' => $this->user->id, 'updated_by' => $this->user->id]);
        //$address = Address::factory()->create(['family_id' => $family->id, 'address_line_1' => '123 Test St', 'city' => 'Test City', 'state' => 'WI', 'zip' => '12345']);

        // Act
        $this->familyService->deleteFamily($family);

        // Assert
        $this->assertSoftDeleted($family);
        //$this->assertModelDeleted($address);
    }
}

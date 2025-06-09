<?php

namespace Tests\Unit\Services;

use App\Models\Family;
use App\Models\Person;
use App\Models\User;
use App\Models\Address;
use App\Services\FamilyService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Pagination\LengthAwarePaginator;
use Tests\TestCase;
use Illuminate\Support\Facades\Auth;

class FamilyServiceTest extends TestCase
{
  use RefreshDatabase;

  private FamilyService $familyService;
  private User $user;

  protected function setUp(): void
  {
    parent::setUp();

    $this->familyService = new FamilyService();

    // Create and authenticate a user for testing
    $this->user = User::factory()->create();
    Auth::login($this->user);
  }

  public function test_search_families_returns_paginated_results()
  {
    // Arrange
    Family::factory()->create(['name' => 'Smith Family']);
    Family::factory()->create(['name' => 'Jones Family']);

    // Act
    $result = $this->familyService->searchFamilies('Smith');

    // Assert
    $this->assertInstanceOf(LengthAwarePaginator::class, $result);
    $this->assertEquals(1, $result->total());
    $this->assertEquals('Smith Family', $result->first()->name);
  }

  public function test_get_families_returns_all_paginated_families()
  {
    // Arrange
    Family::factory()->count(15)->create();

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
      'name' => 'Test Family',
      'type' => 'host',
      'primary_contact_id' => null,
      'address' => [
        'street' => '123 Family St',
        'city' => 'Anytown',
        'state' => 'WI',
        'zip' => '12345'
      ]
    ];

    // Act
    $family = $this->familyService->createFamily($data);

    // Assert
    $this->assertInstanceOf(Family::class, $family);
    $this->assertEquals('Test Family', $family->name);
    $this->assertEquals('host', $family->type);
    $this->assertEquals($this->user->id, $family->created_by);

    // Assert address was created
    $this->assertInstanceOf(Address::class, $family->address);
    $this->assertEquals('123 Family St', $family->address->street);
  }

  public function test_update_family_updates_existing_family()
  {
    // Arrange
    $family = Family::factory()->create();
    $data = [
      'name' => 'Updated Family',
      'type' => 'client',
      'address' => [
        'street' => '456 New St',
        'city' => 'Newtown',
        'state' => 'WI',
        'zip' => '54321'
      ]
    ];

    // Act
    $updatedFamily = $this->familyService->updateFamily($family, $data);

    // Assert
    $this->assertEquals('Updated Family', $updatedFamily->name);
    $this->assertEquals('client', $updatedFamily->type);
    $this->assertEquals($this->user->id, $updatedFamily->updated_by);

    // Assert address was updated
    $this->assertEquals('456 New St', $updatedFamily->address->street);
  }

  public function test_delete_family_removes_family_and_address()
  {
    // Arrange
    $family = Family::factory()->create();
    $address = Address::factory()->create(['family_id' => $family->id]);

    // Act
    $this->familyService->deleteFamily($family);

    // Assert
    $this->assertModelDeleted($family);
    $this->assertModelDeleted($address);
  }

  public function test_add_family_member_associates_person_with_family()
  {
    // Arrange
    $family = Family::factory()->create();
    $person = Person::factory()->create();

    // Act
    $result = $this->familyService->addFamilyMember($family, $person->id);

    // Assert
    $this->assertTrue($result);
    $this->assertDatabaseHas('family_person', [
      'family_id' => $family->id,
      'person_id' => $person->id
    ]);
  }

  public function test_remove_family_member_dissociates_person_from_family()
  {
    // Arrange
    $family = Family::factory()->create();
    $person = Person::factory()->create();
    $this->familyService->addFamilyMember($family, $person->id);

    // Act
    $result = $this->familyService->removeFamilyMember($family, $person->id);

    // Assert
    $this->assertTrue($result);
    $this->assertDatabaseMissing('family_person', [
      'family_id' => $family->id,
      'person_id' => $person->id
    ]);
  }

  public function test_get_family_members_returns_all_family_members()
  {
    // Arrange
    $family = Family::factory()->create();
    $person1 = Person::factory()->create();
    $person2 = Person::factory()->create();

    $this->familyService->addFamilyMember($family, $person1->id);
    $this->familyService->addFamilyMember($family, $person2->id);

    // Act
    $members = $this->familyService->getFamilyMembers($family);

    // Assert
    $this->assertCount(2, $members);
    $this->assertTrue($members->contains($person1));
    $this->assertTrue($members->contains($person2));
  }
}

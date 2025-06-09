<?php

namespace Tests\Unit\Services;

use App\Models\Person;
use App\Models\User;
use App\Models\Address;
use App\Services\PersonService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Pagination\LengthAwarePaginator;
use Tests\TestCase;
use Illuminate\Support\Facades\Auth;

class PersonServiceTest extends TestCase
{
  use RefreshDatabase;

  private PersonService $personService;
  private User $user;

  protected function setUp(): void
  {
    parent::setUp();

    $this->personService = new PersonService();

    // Create and authenticate a user for testing
    $this->user = User::factory()->create();
    Auth::login($this->user);
  }

  public function test_search_persons_returns_paginated_results()
  {
    // Arrange
    Person::factory()->create(['first_name' => 'John', 'last_name' => 'Doe']);
    Person::factory()->create(['first_name' => 'Jane', 'last_name' => 'Smith']);

    // Act
    $result = $this->personService->searchPersons('John');

    // Assert
    $this->assertInstanceOf(LengthAwarePaginator::class, $result);
    $this->assertEquals(1, $result->total());
    $this->assertEquals('John', $result->first()->first_name);
  }

  public function test_get_persons_returns_all_paginated_persons()
  {
    // Arrange
    Person::factory()->count(15)->create();

    // Act
    $result = $this->personService->getPersons();

    // Assert
    $this->assertInstanceOf(LengthAwarePaginator::class, $result);
    $this->assertEquals(10, $result->perPage());
  }

  public function test_create_person_stores_person_with_valid_data()
  {
    // Arrange
    $data = [
      'first_name' => 'John',
      'last_name' => 'Doe',
      'date_of_birth' => '1990-01-01',
      'gender' => 'M',
      'ethnicity' => 'White',
      'email' => 'john.doe@example.com',
      'phone' => '123-456-7890',
      'address' => [
        'street' => '123 Main St',
        'city' => 'Anytown',
        'state' => 'WI',
        'zip' => '12345'
      ]
    ];

    // Act
    $person = $this->personService->createPerson($data);

    // Assert
    $this->assertInstanceOf(Person::class, $person);
    $this->assertEquals('John', $person->first_name);
    $this->assertEquals('Doe', $person->last_name);
    $this->assertEquals($this->user->id, $person->created_by);

    // Assert address was created
    $this->assertInstanceOf(Address::class, $person->address);
    $this->assertEquals('123 Main St', $person->address->street);
  }

  public function test_update_person_updates_existing_person()
  {
    // Arrange
    $person = Person::factory()->create();
    $data = [
      'first_name' => 'Updated',
      'last_name' => 'Name',
      'email' => 'updated@example.com',
      'address' => [
        'street' => '456 New St',
        'city' => 'Newtown',
        'state' => 'WI',
        'zip' => '54321'
      ]
    ];

    // Act
    $updatedPerson = $this->personService->updatePerson($person, $data);

    // Assert
    $this->assertEquals('Updated', $updatedPerson->first_name);
    $this->assertEquals('Name', $updatedPerson->last_name);
    $this->assertEquals('updated@example.com', $updatedPerson->email);
    $this->assertEquals($this->user->id, $updatedPerson->updated_by);

    // Assert address was updated
    $this->assertEquals('456 New St', $updatedPerson->address->street);
  }

  public function test_delete_person_removes_person_and_address()
  {
    // Arrange
    $person = Person::factory()->create();
    $address = Address::factory()->create(['person_id' => $person->id]);

    // Act
    $this->personService->deletePerson($person);

    // Assert
    $this->assertDatabaseMissing('people', ['id' => $person->id]);
    $this->assertDatabaseMissing('addresses', ['id' => $address->id]);
  }

  public function test_get_person_by_id_returns_person_with_address()
  {
    // Arrange
    $person = Person::factory()->create();
    Address::factory()->create(['person_id' => $person->id]);

    // Act
    $result = $this->personService->getPersonById($person->id);

    // Assert
    $this->assertInstanceOf(Person::class, $result);
    $this->assertEquals($person->id, $result->id);
    $this->assertNotNull($result->address);
  }

  public function test_get_person_by_id_returns_null_for_invalid_id()
  {
    // Act
    $result = $this->personService->getPersonById(999);

    // Assert
    $this->assertNull($result);
  }
}

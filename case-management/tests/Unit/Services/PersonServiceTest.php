<?php

namespace Tests\Unit\Services;

use App\Models\Person;
use App\Models\Address;
use App\Services\PersonService;
use Illuminate\Pagination\LengthAwarePaginator;
use Tests\Unit\ServiceTestCase;
use App\Http\Requests\PersonFormRequest;
use Illuminate\Support\Arr;
use Mockery;

class PersonServiceTest extends ServiceTestCase
{
    private PersonService $personService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->personService = new PersonService();
    }

    public function test_search_persons_returns_paginated_results()
    {
        // Arrange
        Person::factory()->create(['first_name' => 'John', 'last_name' => 'Doe', 'created_by' => $this->user->id, 'updated_by' => $this->user->id, 'address_id' => $this->address->id]);
        Person::factory()->create(['first_name' => 'Jane', 'last_name' => 'Smith', 'created_by' => $this->user->id, 'updated_by' => $this->user->id, 'address_id' => $this->address->id]);

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
        Person::factory()->count(15)->create(['first_name' => 'John', 'last_name' => 'Doe', 'address_id' => $this->address->id, 'created_by' => $this->user->id, 'updated_by' => $this->user->id]);

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
            'address_line_1' => '123 Main St',
            'city' => 'Anytown',
            'state' => 'WI',
            'zip' => '12345',
        ];
        $request = Mockery::mock(PersonFormRequest::class);
        $request->shouldReceive('has')->andReturn(false);
        $request->shouldReceive('input')->andReturn(null);
        $request->shouldReceive('auth_roles')->andReturn(null);
        $request->person = null;
        $request->shouldReceive('all')->andReturn($data);
        $request->shouldReceive('route')->andReturn(null);

        // Act
        $response = $this->personService->createPerson($data, $request);
        $person = $response->person;

        // Assert
        $this->assertInstanceOf(Person::class, $person);
        $this->assertEquals('John', $person->first_name);
        $this->assertEquals('Doe', $person->last_name);
        $this->assertEquals($this->user->id, $person->created_by);

        // Assert address was created
        $this->assertInstanceOf(Address::class, $person->address);
        $this->assertEquals('123 Main St', $person->address->address_line_1);
    }

    public function test_update_person_updates_existing_person()
    {
        // Arrange
        $person = Person::factory()->create(['first_name' => 'John', 'last_name' => 'Doe', 'gender' => 'M', 'created_by' => $this->user->id, 'updated_by' => $this->user->id, 'address_id' => $this->address->id]);
        $data = [
            'first_name' => 'Updated',
            'last_name' => 'Name',
            'email' => 'updated@example.com',
            'phone' => '123-456-7890',
            'date_of_birth' => '1990-01-01',
            'gender' => $person->gender,
            'address_line_1' => '456 New St',
            'city' => 'Newtown',
            'state' => 'WI',
            'zip' => '54321',
        ];
        $request = Mockery::mock(PersonFormRequest::class);
        $request->shouldReceive('has')->andReturn(false);
        $request->shouldReceive('input')->andReturn(null);
        $request->shouldReceive('auth_roles')->andReturn(null);
        $request->person = $person;
        $request->shouldReceive('all')->andReturn($data);
        $request->shouldReceive('route')->andReturn(null);

        // Act
        $response = $this->personService->updatePerson($data, $request);
        $updatedPerson = $response->person;

        // Assert
        $this->assertEquals('Updated', $updatedPerson->first_name);
        $this->assertEquals('Name', $updatedPerson->last_name);
        $this->assertEquals('updated@example.com', $updatedPerson->email);
        $this->assertEquals($this->user->id, $updatedPerson->updated_by);

        // Assert address was updated
        $this->assertEquals('456 New St', $updatedPerson->address->address_line_1);
    }

    public function test_delete_person_removes_person()
    {
        // Arrange
        $person = Person::factory()->create(['first_name' => 'John', 'last_name' => 'Doe', 'gender' => 'M', 'created_by' => $this->user->id, 'updated_by' => $this->user->id, 'address_id' => $this->address->id]);

        // Act
        $this->personService->deletePerson($person);

        // Assert
        $this->assertSoftDeleted($person);
    }
}

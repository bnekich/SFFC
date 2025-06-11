<?php

namespace Tests\Unit;

use App\Models\User;
use App\Models\Person;
use App\Models\Address;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

abstract class ServiceTestCase extends TestCase
{
    use RefreshDatabase;

    protected User $user;
    protected Person $person;
    protected Address $address;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create([
            'firstName' => 'Test',
            'lastName' => 'User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);

        $this->address = Address::factory()->create([
            'address_line_1' => '123 Test St',
            'city' => 'Test City',
            'state' => 'WI',
            'zip' => '12345',
            'created_by' => $this->user->id,
            'updated_by' => $this->user->id,
        ]);

        $this->person = Person::factory()->create([
            'first_name' => 'Test',
            'last_name' => 'User',
            'email' => 'test@example.com',
            'address_id' => $this->address->id,
            'created_by' => $this->user->id,
            'updated_by' => $this->user->id,
        ]);

        // Authenticate the user
        Auth::login($this->user);
    }

    protected function createAuthenticatedUser(): User
    {
        // Create a person first (without address)
        //$person = Person::factory()->create();

        // Create and authenticate a user
        $user = User::factory()->create([
            'firstName' => 'Test',
            'lastName' => 'User',
            'email' => 'test@example.com',
        ]);

        Auth::login($user);

        // Create address with the authenticated user's ID
        $address = Address::factory()->create([
            'created_by' => $user->id,
            'updated_by' => $user->id
        ]);

        // Update the person with the address
        //$person->update(['address_id' => $address->id]);

        return $user;
    }

    protected function assertModelExists($model, array $attributes = []): void
    {
        $this->assertDatabaseHas($model->getTable(), array_merge(
            ['id' => $model->id],
            $attributes
        ));
    }

    protected function assertModelDeleted($model): void
    {
        $this->assertDatabaseMissing($model->getTable(), [
            'id' => $model->id
        ]);
    }
}

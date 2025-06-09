<?php

namespace Tests\Unit\Services;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Facades\Auth;

abstract class ServiceTestCase extends TestCase
{
  use RefreshDatabase;

  protected User $user;

  protected function setUp(): void
  {
    parent::setUp();

    // Create and authenticate a user for testing
    $this->user = User::factory()->create();
    Auth::login($this->user);
  }

  protected function createAuthenticatedUser(): User
  {
    $user = User::factory()->create();
    Auth::login($user);
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

<?php

namespace Tests\Unit\Services;

use App\Models\CaseModel;
use App\Models\User;
use App\Services\CaseService;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;

class CaseServiceTest extends ServiceTestCase
{
  private CaseService $caseService;

  protected function setUp(): void
  {
    parent::setUp();
    $this->caseService = new CaseService();
  }

  public function test_get_cases_returns_paginated_results()
  {
    // Arrange
    CaseModel::factory()->count(15)->create();

    // Act
    $result = $this->caseService->getCases();

    // Assert
    $this->assertInstanceOf(LengthAwarePaginator::class, $result);
    $this->assertEquals(10, $result->perPage());
  }

  public function test_get_cases_applies_search_filter()
  {
    // Arrange
    CaseModel::factory()->create(['case_identifier' => 'TEST123']);
    CaseModel::factory()->create(['case_identifier' => 'OTHER456']);

    // Act
    $result = $this->caseService->getCases(['search' => 'TEST']);

    // Assert
    $this->assertEquals(1, $result->total());
    $this->assertEquals('TEST123', $result->first()->case_identifier);
  }

  public function test_get_cases_applies_status_filter()
  {
    // Arrange
    CaseModel::factory()->create(['status' => 'active']);
    CaseModel::factory()->create(['status' => 'closed']);

    // Act
    $result = $this->caseService->getCases(['status' => 'active']);

    // Assert
    $this->assertEquals(1, $result->total());
    $this->assertEquals('active', $result->first()->status);
  }

  public function test_create_case_stores_case_with_valid_data()
  {
    // Arrange
    $data = [
      'case_identifier' => 'CASE001',
      'case_description' => 'Test case description',
      'client_family_id' => 1,
      'host_family_id' => 2,
      'assigned_staff_id' => 3,
      'start_date' => '2024-03-20',
      'status' => 'active'
    ];

    // Act
    $case = $this->caseService->createCase($data);

    // Assert
    $this->assertInstanceOf(CaseModel::class, $case);
    $this->assertEquals('CASE001', $case->case_identifier);
    $this->assertEquals('Test case description', $case->case_description);
    $this->assertEquals($this->user->id, $case->created_by);
  }

  public function test_create_case_throws_exception_for_duplicate_identifier()
  {
    // Arrange
    $data = [
      'case_identifier' => 'CASE001',
      'case_description' => 'Test case description',
      'client_family_id' => 1,
      'host_family_id' => 2,
      'assigned_staff_id' => 3,
      'start_date' => '2024-03-20',
      'status' => 'active'
    ];

    $this->caseService->createCase($data);

    // Assert
    $this->expectException(\DomainException::class);

    // Act
    $this->caseService->createCase($data);
  }

  public function test_update_case_updates_existing_case()
  {
    // Arrange
    $case = CaseModel::factory()->create();
    $data = [
      'case_description' => 'Updated description',
      'client_family_id' => 4,
      'host_family_id' => 5,
      'assigned_staff_id' => 6,
      'start_date' => '2024-03-21',
      'status' => 'closed'
    ];

    // Act
    $updatedCase = $this->caseService->updateCase($case, $data);

    // Assert
    $this->assertEquals('Updated description', $updatedCase->case_description);
    $this->assertEquals('closed', $updatedCase->status);
    $this->assertEquals($this->user->id, $updatedCase->updated_by);
  }

  public function test_delete_case_removes_case()
  {
    // Arrange
    $case = CaseModel::factory()->create();

    // Act
    $this->caseService->deleteCase($case);

    // Assert
    $this->assertModelDeleted($case);
  }
}

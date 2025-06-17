<?php

namespace Tests\Unit\Services;

use App\Models\CaseModel;
use App\Models\User;
use App\Services\CaseService;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Tests\Unit\ServiceTestCase;
use App\Models\Family;
use App\Models\Status;

class CaseServiceTest extends ServiceTestCase
{
    private CaseService $caseService;
    private Family $clientFamily;
    private Family $hostFamily;
    private Status $status;

    protected function setUp(): void
    {
        parent::setUp();
        $this->caseService = new CaseService();
        $this->status = Status::factory()->create([
            'name' => 'Open',
        ]);

        $this->clientFamily = Family::factory()->create([
            'family_name' => 'Client Family',
            'address_id' => $this->address->id,
            'status_id' => $this->status->id,
            'created_by' => $this->user->id,
            'updated_by' => $this->user->id,
        ]);

        $this->hostFamily = Family::factory()->create([
            'family_name' => 'Host Family',
            'address_id' => $this->address->id,
            'status_id' => $this->status->id,
            'created_by' => $this->user->id,
            'updated_by' => $this->user->id,
        ]);
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
        CaseModel::factory()->create(['case_identifier' => 'TEST123', 'created_by' => $this->user->id, 'updated_by' => $this->user->id, 'case_description' => 'Test case description', 'start_date' => '2024-03-20', 'status' => 'O']);
        CaseModel::factory()->create(['case_identifier' => 'OTHER456', 'created_by' => $this->user->id, 'updated_by' => $this->user->id, 'case_description' => 'Other case description', 'start_date' => '2024-03-20', 'status' => 'O']);

        // Act
        $result = $this->caseService->getCases(['search' => 'TEST']);

        // Assert
        $this->assertEquals(1, $result->total());
        $this->assertEquals('TEST123', $result->first()->case_identifier);
    }

    public function test_get_cases_applies_status_filter()
    {
        // Arrange
        CaseModel::factory()->create(['status' => 'O', 'created_by' => $this->user->id, 'updated_by' => $this->user->id, 'case_description' => 'Test case description', 'start_date' => '2024-03-20']);
        CaseModel::factory()->create(['status' => 'C', 'created_by' => $this->user->id, 'updated_by' => $this->user->id, 'case_description' => 'Other case description', 'start_date' => '2024-03-20']);

        // Act
        $result = $this->caseService->getCases(['status' => 'O']);

        // Assert
        $this->assertEquals(1, $result->total());
        $this->assertEquals('O', $result->first()->status);
    }

    public function test_create_case_stores_case_with_valid_data()
    {


        // Arrange
        $data = [
            'case_identifier' => 'CASE001',
            'case_description' => 'Test case description',
            'client_family_id' => $this->clientFamily->id,
            'host_family_id' => $this->hostFamily->id,
            'assigned_staff_id' => $this->user->id,
            'start_date' => '2024-03-20',
            'status' => 'O',
            'created_by' => $this->user->id,
            'updated_by' => $this->user->id,
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
            'client_family_id' => $this->clientFamily->id,
            'host_family_id' => $this->hostFamily->id,
            'assigned_staff_id' => $this->user->id,
            'start_date' => '2024-03-20',
            'status' => 'O',
            'created_by' => $this->user->id,
            'updated_by' => $this->user->id,
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
        $case = CaseModel::factory()->create([
            'case_identifier' => 'CASEZZZ',
            'case_description' => 'Test case description',
            'client_family_id' => $this->clientFamily->id,
            'host_family_id' => $this->hostFamily->id,
            'assigned_staff_id' => $this->user->id,
            'start_date' => '2024-03-20',
            'status' => 'O',
            'created_by' => $this->user->id,
            'updated_by' => $this->user->id,
        ]);
        $data = [
            'case_description' => 'Updated description',
            'client_family_id' => $this->clientFamily->id,
            'host_family_id' => $this->hostFamily->id,
            'assigned_staff_id' => $this->user->id,
            'start_date' => '2024-03-21',
            'status' => 'C',
            'updated_by' => $this->user->id,
        ];

        // Act
        $updatedCase = $this->caseService->updateCase($case, $data);

        // Assert
        $this->assertEquals('Updated description', $updatedCase->case_description);
        $this->assertEquals('C', $updatedCase->status);
        $this->assertEquals($this->user->id, $updatedCase->updated_by);
    }

    public function test_delete_case_removes_case()
    {
        // Arrange
        $case = CaseModel::factory()->create([
            'case_identifier' => 'CASEZZZ',
            'case_description' => 'Test case description',
            'client_family_id' => $this->clientFamily->id,
            'host_family_id' => $this->hostFamily->id,
            'assigned_staff_id' => $this->user->id,
            'start_date' => '2024-03-20',
            'status' => 'O',
            'created_by' => $this->user->id,
            'updated_by' => $this->user->id,
        ]);

        // Act
        $this->caseService->deleteCase($case);

        // Assert
        $this->assertSoftDeleted($case);
    }
}

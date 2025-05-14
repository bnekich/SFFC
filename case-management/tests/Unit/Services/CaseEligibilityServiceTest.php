<?php

namespace Tests\Unit\Services;

use App\Services\CaseEligibilityService; // Import the class we want to test
use PHPUnit\Framework\TestCase; // Standard PHPUnit base class for unit tests

class CaseEligibilityServiceTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_case_is_eligible_when_status_is_pending_review(): void
    {
        // Arrange: Set up the conditions for your test
        $service = new CaseEligibilityService();
        $status = 'pending_review';

        // Act: Perform the action you want to test
        $isEligible = $service->isEligible($status);

        // Assert: Verify that the outcome is what you expect
        $this->assertTrue($isEligible, "Case should be eligible when status is 'pending_review'.");
    }

    public function test_case_is_not_eligible_when_status_is_not_pending_review(): void
    {
        $service = new CaseEligibilityService();
        $status = 'closed';
        $isEligible = $service->isEligible($status);
        $this->assertFalse($isEligible, "Case should not be eligible when status is 'closed'.");
    }
}

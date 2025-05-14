<?php

namespace App\Services;

class CaseEligibilityService
{
  /**
   * Checks if a case is eligible based on its status.
   * For simplicity, let's say only 'pending_review' cases are eligible.
   */
  public function isEligible(string $caseStatus): bool
  {
    return $caseStatus === 'pending_review';
  }
}

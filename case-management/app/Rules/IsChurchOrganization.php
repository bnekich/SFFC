<?php

namespace App\Rules;

use App\Models\Organization;
use App\Models\OrganizationType;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class IsChurchOrganization implements ValidationRule
{
  /**
   * The ID of the 'Church Partner' organization type.
   *
   * @var int|null
   */
  private $churchPartnerTypeId;

  public function __construct()
  {
    // Cache the ID to avoid querying on every validation check.
    $this->churchPartnerTypeId = OrganizationType::where('name', 'Church Partner')->value('id');
  }

  /**
   * Run the validation rule.
   *
   * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
   */
  public function validate(string $attribute, mixed $value, Closure $fail): void
  {
    if (!$this->churchPartnerTypeId) {
      // This can happen if the OrganizationType seeder hasn't run or the name is wrong.
      $fail('The system is not configured correctly to validate church organizations.');
      return;
    }

    $isChurch = Organization::where('id', $value)
      ->where('organization_type_id', $this->churchPartnerTypeId)
      ->exists();

    if (!$isChurch) {
      $fail('The selected :attribute is not a valid church.');
    }
  }
}

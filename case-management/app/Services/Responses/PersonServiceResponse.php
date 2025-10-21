<?php

namespace App\Services\Responses;

use App\Models\Person;
use App\Models\Volunteer;

class PersonServiceResponse
{
  public Person $person;
  public ?Volunteer $volunteer;
  public string $tempPassword;

  public function __construct(Person $person, Volunteer|null $volunteer, string $tempPassword = '')
  {
    $this->person = $person;
    $this->volunteer = $volunteer;
    $this->tempPassword = $tempPassword;
  }
}

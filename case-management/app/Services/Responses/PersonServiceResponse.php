<?php

namespace App\Services\Responses;

use App\Models\Person;

class PersonServiceResponse
{
  public Person $person;
  public string $tempPassword;

  public function __construct(Person $person, string $tempPassword = '')
  {
    $this->person = $person;
    $this->tempPassword = $tempPassword;
  }
}

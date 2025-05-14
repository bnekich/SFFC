<?php

declare(strict_types=1);

namespace App\Services;


use App\Models\User;

class HelperService
{
  public static function getFormattedUserName(User $user)
  {
    return $user->firstName . ' ' . $user->lastName;
  }
}

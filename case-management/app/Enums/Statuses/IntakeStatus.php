<?php

declare(strict_types=1);

namespace App\Enums\Statuses;

enum IntakeStatus: string
{
  case FirstContactAttempt = 'F';
  case SecondContactAttempt = 'S';
  case ThirdContactAttempt = 'T';
  case InProgress = 'I';
  case Completed = 'C';
  case Closed = 'X';
  case Other = 'O';

  public function label(): string
  {
    return match ($this) {
      self::FirstContactAttempt => 'First Contact Attempt',
      self::SecondContactAttempt => 'Second Contact Attempt',
      self::ThirdContactAttempt => 'Third Contact Attempt',
      self::InProgress => 'In Progress',
      self::Completed => 'Completed',
      self::Closed => 'Not A Good Fit',
      self::Other => 'Other',
    };
  }
}

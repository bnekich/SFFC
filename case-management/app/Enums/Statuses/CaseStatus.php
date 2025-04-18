<?php

namespace App\Enums\Statuses;

enum CaseStatus: string
{
  case Open = 'O';
  case Closed = 'C';
  case OnHold = 'H';
  case Cancelled = 'X';

  public function label(): string
  {
    return match ($this) {
      self::Open => 'Open',
      self::Closed => 'Closed',
      self::OnHold => 'On Hold',
      self::Cancelled => 'Cancelled',
    };
  }
}

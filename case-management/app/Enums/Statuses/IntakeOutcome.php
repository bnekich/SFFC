<?php

declare(strict_types=1);

namespace App\Enums\Statuses;

enum IntakeOutcome: string
{
  case Open = "O";
  case Pending = "P";
  case NotOpen = "N";

  public function label(): string
  {
    return match ($this) {
      self::Open => 'Open',
      self::Pending => 'Pending',
      self::NotOpen => 'Not Open',
    };
  }
}

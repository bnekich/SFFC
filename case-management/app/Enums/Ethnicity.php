<?php

declare(strict_types=1);

namespace App\Enums;

enum Ethnicity: string
{
  case NativeAmerican = 'I';
  case Asian = 'A';
  case Black = 'B';
  case Hispanic = 'H';
  case MiddEastern = 'M';
  case PacificIslander = 'P';
  case White = 'W';
  case TwoOrMore = 'T';
  case Other = 'O';
  case NotProvided = 'N';
  case Unknown = 'U';

  public function label(): string
  {
    return match ($this) {
      self::NativeAmerican => 'American Indian/Alaska Native',
      self::Asian => 'Asian',
      self::Black => 'Black or African American',
      self::Hispanic => 'Hispanic or Latino',
      self::MiddEastern => 'Middle Eastern',
      self::PacificIslander => 'Native Hawaiian or Other Pacific Islander',
      self::White => 'White or Caucasian',
      self::TwoOrMore => 'Two or More',
      self::Other => 'Other',
      self::NotProvided => 'Not Provided',
      self::Unknown => 'Unknown',
    };
  }
}

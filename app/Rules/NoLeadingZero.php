<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class NoLeadingZero implements Rule
{
  public function passes($attribute, $value)
  {
    // Check if the number starts with 0
    return strpos((string)$value, '0') !== 0;
  }

  public function message()
  {
    return 'The score cannot start with 0.';
  }
}

<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class MoreThan50Words implements Rule
{
  public function passes($attribute, $value)
  {
    $wordCount = str_word_count($value);
    return $wordCount >= 20 && $wordCount <= 70;
  }

  public function message()
  {
    return 'Description must contain between 20 and 70 words.';
  }
}

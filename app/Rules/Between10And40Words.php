<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Between10And40Words implements Rule
{
  public function passes($attribute, $value)
  {
    $wordCount = str_word_count($value);
    return $wordCount >= 20 && $wordCount <= 60;
  }

  public function message()
  {
    return 'Description must contain between 20 and 60 words.';
  }
}

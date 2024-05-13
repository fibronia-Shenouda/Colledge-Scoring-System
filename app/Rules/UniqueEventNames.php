<?php

namespace App\Rules;

use Illuminate\Support\Facades\Request;
use Illuminate\Contracts\Validation\Rule;

class UniqueEventNames implements Rule
{
  public function passes($attribute, $value)
  {
    $inputFields = Request::all();
    $eventNames = [];

    foreach ($inputFields as $fieldName => $fieldValue) {
      // Exclude the current attribute being validated
      if ($fieldName !== $attribute) {
        // Check if the field value already exists in the eventNames array
        if (in_array($fieldValue, $eventNames)) {
          return false;
        }
        $eventNames[] = $fieldValue;
      }
    }

    return true;
  }

  public function message()
  {
    return 'Each event name must be unique across all input fields.';
  }
}

<?php

namespace App\Rules;

namespace App\Rules;
use Illuminate\Contracts\Validation\Rule;

class UniqueTeamMember implements Rule
{
  protected $previousMembers;

  public function __construct($previousMembers)
  {
    $this->previousMembers = (array) $previousMembers;
  }

  public function passes($attribute, $value)
  {
    foreach ($this->previousMembers as $previousMember) {
      if (request($previousMember) === $value) {
        return false;
      }
    }
    return true;
  }

  public function message()
  {
    return 'This email is signed already.';
  }
}


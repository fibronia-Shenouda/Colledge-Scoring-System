<?php

namespace App\Rules;
use App\Models\User;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class UserExists implements ValidationRule
{
  public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Check if the email exists in the users table
        $userExists = User::where('email', $value)->exists();

        // If the email does not exist, fail the validation
        if (!$userExists) {
            $fail("Member must register on the website first.");
        }
    }
}

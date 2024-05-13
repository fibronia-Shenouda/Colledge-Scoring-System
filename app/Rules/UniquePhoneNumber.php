<?php

namespace App\Rules;

use App\Models\User;
use Illuminate\Contracts\Validation\Rule;

class UniquePhoneNumber implements Rule
{
    protected $userId;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($userId)
    {
        $this->userId = $userId;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $user = User::where('phone_number', $value)->first();

        // If no user found with the provided phone number or the found user's ID matches the current user's ID, validation passes
        return !$user || $user->id === $this->userId;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The phone number has already been taken.';
    }
}

<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class UniqueEventName implements Rule
{
    protected $previousEvents;

    public function __construct($previousEvents)
    {
        $this->previousEvents = (array) $previousEvents;
    }

    public function passes($attribute, $value)
    {
        foreach ($this->previousEvents as $previousEvent) {
            if (request()->input($previousEvent) === $value) {
                return false;
            }
        }
        return true;
    }

    public function message()
    {
        return 'You have write this event before.';
    }
}

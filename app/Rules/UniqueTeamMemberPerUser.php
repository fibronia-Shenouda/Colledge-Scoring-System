<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Team;

class UniqueTeamMemberPerUser implements Rule
{
    public function passes($attribute, $value)
    {
        // Check if exists in the teams table
        return !Team::where('member1', $value)
                    ->orWhere('member2', $value)
                    ->orWhere('member3', $value)
                    ->orWhere('member4', $value)
                    ->orWhere('member5', $value)
                    ->exists();
    }

    public function message()
    {
        return 'This member has already signed up for another team.';
    }
}

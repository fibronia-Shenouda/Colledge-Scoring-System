<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable = ['team_name', 'member1', 'member2', 'member3', 'member4', 'member5', 'events'];

    public function events()
    {
        return $this->belongsToMany(Event::class);
    }

    public function scores(){
      return $this->hasMany(Score::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'photo', 'competition_id', 'is_academic'];

    public function competition(){
      return $this->belongsTo(competition::class);
    }

    public function teams()
    {
        return $this->belongsToMany(Team::class);
    }
}

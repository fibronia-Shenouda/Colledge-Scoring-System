<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Competition extends Model
{
  use HasFactory;

  protected $fillable = ['name', 'description', 'photo', 'is_team'];

  public function events()
  {
    return $this->hasMany(Event::class);
  }

  public function scopeFilter($query, array $filters)
  {
    if ($filters['search'] ?? false) {
      $query->where('name', 'like', '%' . $filters['search'] . '%');
    }
    if ($filters['category'] ?? false) {
      if ($filters['category'] == 'teams') {
        $query->where('is_team', '=', '1');
      }
      if ($filters['category'] == 'individuals') {
        $query->where('is_team', '=', '0');
      }
    }
  }
}

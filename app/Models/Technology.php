<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Technology extends Model
{
  use HasFactory;

  public function projects()
  {
    return $this->belongsToMany(Project::class);
  }

  public function getBadge()
  {
    return "<a href='#' style='color: $this->color; font-weight: bold;'>$this->label</a>";
  }
}

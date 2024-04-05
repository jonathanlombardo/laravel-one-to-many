<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
  use HasFactory;

  protected $fillable = [
    'title',
    // 'author',
    'type_id',
    'description',
    'git_hub',
    'image',
  ];

  public function type()
  {
    return $this->belongsTo(Type::class);
  }

  public function user()
  {
    return $this->belongsTo(User::class);
  }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Vite;

class Project extends Model
{
  use HasFactory;

  protected $fillable = [
    'title',
    // 'author',
    'type_id',
    'description',
    'git_hub',
    // 'image',
  ];

  public function type()
  {
    return $this->belongsTo(Type::class);
  }

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function technologies()
  {
    return $this->belongsToMany(Technology::class);
  }

  public function getAllTechBadges()
  {
    $badges = [];
    foreach ($this->technologies as $technology) {
      $badges[] = $technology->getBadge();
    }

    return implode(' - ', $badges);
  }

  public function getAllTechPublicBadges()
  {
    $badges = [];
    foreach ($this->technologies as $technology) {
      $badges[] = $technology->getPublicBadge();
    }

    return implode(' - ', $badges);
  }

  public function getImgUrl()
  {
    if ($this->image) {
      return "/storage/$this->image";
    } else {
      return "/img/projects/placeholder.jpg";
    }
  }
}

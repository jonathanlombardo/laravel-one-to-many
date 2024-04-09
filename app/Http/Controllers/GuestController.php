<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class GuestController extends Controller
{
  public function index($filter_users = null, $filter_types = null, $filter_technologies = null)
  {
    $projects = Project::select();

    if ($filter_users)
      $projects->whereBelongsTo($filter_users);

    if ($filter_types)
      $projects->whereBelongsTo($filter_types);

    if ($filter_technologies)
      $projects->whereBelongsTo($filter_technologies);

    $projects = $projects->orderBy('id', 'desc')->paginate(12);
    return view('guest.index', compact('projects'));

  }
}

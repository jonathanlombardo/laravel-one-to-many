<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class GuestController extends Controller
{
  public function index()
  {
    $projects = Project::orderBy('id', 'desc')->paginate(12);
    return view('guest.index', compact('projects'));

  }
}

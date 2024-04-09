<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Technology;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TechnologyController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   */
  public function index()
  {
    $techs = Technology::orderBy('id', 'desc')->paginate(15);
    return view('admin.technologies.index', compact('techs'));
  }

  /**
   * Show the form for creating a new resource.
   *
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   */
  public function store(Request $request)
  {
    //
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Technology  $technology
   */
  public function show(Technology $technology)
  {
    $related_projects = $technology->projects()->select();
    if (Auth::user()->role != 'admin')
      $related_projects->whereBelongsTo(Auth::user());
    $related_projects = $related_projects->paginate(10);
    return view('admin.technologies.show', compact('technology', 'related_projects'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\Technology  $technology
   */
  public function edit(Technology $technology)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Technology  $technology
   */
  public function update(Request $request, Technology $technology)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Technology  $technology
   */
  public function destroy(Technology $technology)
  {
    //
  }
}

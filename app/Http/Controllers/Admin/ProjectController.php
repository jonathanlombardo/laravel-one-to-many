<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ProjectFormRequest;
use App\Models\Project;
// use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Type;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   */
  public function index()
  {
    $types_count = Type::all()->count();

    $projects = Project::orderBy('id', 'desc')->paginate(15);
    return view('admin.projects.index', compact('projects', 'types_count'));
  }

  /**
   * Show the form for creating a new resource.
   *
   */
  public function create()
  {
    $types = Type::all();
    $editForm = false;
    if ($types->count())
      return view('admin.projects.form', compact('editForm', 'types'));
    return redirect()->route('admin.projects.index')->with('messageClass', 'alert-warning')->with('message', 'No available type. Please create a new Project Type before.');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   */
  public function store(ProjectFormRequest $request)
  {
    $request->validated();

    $datas = $request->all();
    $project = new Project;
    $project->fill($datas);
    if ($request['author'])
      $project->author = $request['author'];
    $project->slug = Str::of($project->title)->slug('-');
    $project->save();

    return redirect()->route('admin.projects.show', $project)->with('messageClass', 'alert-success')->with('message', 'Project Saved');

  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Project  $project
   */
  public function show(Project $project)
  {
    return view('admin.projects.show', compact('project'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\Project  $project
   */
  public function edit(Project $project)
  {
    $types = Type::all();
    $editForm = true;
    return view('admin.projects.form', compact('project', 'editForm', 'types'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Project  $project
   */
  public function update(ProjectFormRequest $request, Project $project)
  {

    $request->validated();

    $datas = $request->all();
    $project->fill($datas);
    $project->author = $request['author'];
    $project->slug = Str::of($project->title)->slug('-');
    $project->save();

    return redirect()->route('admin.projects.show', $project)->with('messageClass', 'alert-success')->with('message', 'Project Updated');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Project  $project
   */
  public function destroy(Project $project)
  {
    $project->delete();
    return redirect()->route('admin.projects.index')->with('messageClass', 'alert-success')->with('message', 'Project deleted');
  }
}

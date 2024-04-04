<?php

namespace App\Http\Controllers\Admin;

use App\Models\Type;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\TypeFormRequest;
use Illuminate\Support\Str;


class TypeController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   */
  public function index()
  {
    $types = Type::orderBy('id', 'desc')->paginate(15);
    return view('admin.types.index', compact('types'));
  }

  /**
   * Show the form for creating a new resource.
   *
   */
  public function create()
  {
    $editForm = false;
    return view('admin.types.form', compact('editForm'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   */
  public function store(TypeFormRequest $request)
  {
    $request->validated();

    $datas = $request->all();
    $type = new Type;
    $type->fill($datas);
    $type->save();

    return redirect()->route('admin.types.show', $type)->with('messageClass', 'alert-success')->with('message', 'Type Saved');
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Type  $type
   */
  public function show(Type $type)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\Type  $type
   */
  public function edit(Type $type)
  {
    $editForm = true;
    return view('admin.types.form', compact('type', 'editForm'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Type  $type
   */
  public function update(TypeFormRequest $request, Type $type)
  {
    $request->validated();

    $datas = $request->all();
    $type->fill($datas);
    $type->save();

    return redirect()->route('admin.types.show', $type)->with('messageClass', 'alert-success')->with('message', 'Type Saved');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Type  $type
   */
  public function destroy(Type $type)
  {
    //
  }
}

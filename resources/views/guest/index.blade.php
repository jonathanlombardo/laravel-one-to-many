@extends('layouts.main')

@section('assets')
  <style>
    .card img {
      height: 200px;
      width: 100%;
      object-fit: cover;
      object-position: center;
    }
  </style>
@endsection


@section('maincontent')
  <div class="container">
    <h1 class="text-center mt-5">HOME</h1>
    <p class="text-center">All projects</p>
    <div class="row g-3 py-5">
      @forelse ($projects as $project)
        <div class="col-4">
          <div class="card h-100">
            <img src="{{ $project->image }}" class="card-img-top" alt="...">
            <div class="card-body py-3 d-flex align-items-start flex-column">
              <h5 class="card-title">{{ $project->title }}</h5>
              {!! $project->type->getPublicBadge() !!}
              <p class="card-text py-3">{{ $project->description }}</p>
              <div class="align-self-end mt-auto">
                Author: {{ $project->user->name }}
              </div>
            </div>
          </div>
        </div>
      @empty
        <p class="text-center">No projects yet</p>
      @endforelse
    </div>
  </div>
@endsection

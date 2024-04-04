@extends('layouts.main')

@section('maincontent')
  <div class="container my-5">
    <h1>{{ $editForm ? 'Edit project' : 'Create Project' }}</h1>

    @if ($errors->any())
      <div class="error-alert alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Check and correct fields on error!</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

    <form action="{{ $editForm ? route('admin.projects.update', $project) : route('admin.projects.store') }}" method="POST" class="row my-4 g-3">
      @csrf
      @method($editForm ? 'PATCH' : 'POST')

      <div class="col-6">
        <div class="form-floating">
          <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" placeholder="title" value="{{ $editForm ? ($errors->any() ? old('title') : $project->title) : old('title') }}">
          <label for="title">Project Title</label>
          @error('title')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>
      </div>
      <div class="col-6">
        <div class="form-floating">
          <input type="text" class="form-control @error('author') is-invalid @enderror" id="author" name="author" placeholder="author" value="{{ $editForm ? ($errors->any() ? old('author') : $project->author) : old('author') }}">
          <label for="author">Project Author</label>
          @error('author')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>
      </div>
      <div class="col-6">
        <div class="form-floating">
          <input type="url" class="form-control @error('git_hub') is-invalid @enderror" id="git_hub" name="git_hub" placeholder="git_hub" value="{{ $editForm ? ($errors->any() ? old('git_hub') : $project->git_hub) : old('git_hub') }}">
          <label for="git_hub">GitHub Repo URL</label>
          @error('git_hub')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>
      </div>
      <div class="col-6">
        <div class="form-floating">
          <input type="url" class="form-control @error('image') is-invalid @enderror" id="image" name="image" placeholder="image" value="{{ $editForm ? ($errors->any() ? old('image') : $project->image) : old('image') }}">
          <label for="image">Image URL</label>
          @error('image')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>
      </div>
      <div class="col-12">
        <div class="form-floating">
          <textarea class="form-control @error('description') is-invalid @enderror" placeholder="description" id="description" name="description" style="height: 100px">{{ $editForm ? ($errors->any() ? old('description') : $project->description) : old('description') }}</textarea>
          <label for="description">Project Description</label>
          @error('description')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>
      </div>
      <div class="col-12">
        <button class="btn btn-success">{{ $editForm ? 'Edit project' : 'Save' }}</button>
        <a href="{{ route('admin.projects.index') }}" class="btn btn-warning">Back to projects list</a>
      </div>


    </form>
  </div>
@endsection

@section('script')
  <script>
    const inputs = document.querySelectorAll('input');
    const textareas = document.querySelectorAll('textarea');
    const errorAlertEl = document.querySelector('.error-alert');

    inputs.forEach((input) => {
      input.addEventListener("input", function() {
        this.classList.remove('is-invalid')
        errorAlertEl.classList.add('d-none')
      })
    });

    textareas.forEach((textarea) => {
      textarea.addEventListener("change", function() {
        this.classList.remove('is-invalid')
        errorAlertEl.classList.add('d-none')
      })
    });
  </script>
@endsection

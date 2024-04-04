@extends('layouts.main')

@section('assets')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('maincontent')
  <div class="container my-5">
    @include('layouts.partials.alert_message')
    <a href="{{ route('admin.projects.create') }}" class="btn btn-outline-primary mb-3"><i class="fa-solid fa-plus"></i> New project</a>
    <table class="table mb-5">
      <thead>
        <tr>
          <th>Title</th>
          <th>Author</th>
          <th>Option</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($projects as $project)
          <tr>
            <td>{{ $project->title }}</td>
            <td>{{ $project->author }}</td>
            <td class="fs-4">
              <a class="me-2 {{ $project->git_hub ? '' : 'disabled' }}" href="{{ $project->git_hub }}"><i class="fa-brands fa-github"></i></a>
              <a class="me-2" href="{{ route('admin.projects.show', $project) }}"><i class="fa-solid fa-eye"></i></a>
              <a class="me-2" href="{{ route('admin.projects.edit', $project) }}"><i class="fa-solid fa-pen-to-square"></i></a>
              <a class="me-2 text-danger" href="#" onclick="event.preventDefault(); document.getElementById('destroy-btn-{{ $project->id }}').click();"><i class="fa-solid fa-trash"></i></a>
              <button id="destroy-btn-{{ $project->id }}" type="button" class="d-none" data-bs-toggle="modal" data-bs-target="#confirm-destroy-{{ $project->id }}"></button>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="100%">No projects yet</td>
          </tr>
        @endforelse
      </tbody>
    </table>
    {{ $projects->links() }}
  </div>
@endsection

@section('modals')
  @foreach ($projects as $project)
    <!-- Modal -->
    <div class="modal fade" id="confirm-destroy-{{ $project->id }}" tabindex="-1" aria-labelledby="confirmDestroyModal" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Deleting project</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            The elimination is permanent. Would you like to delete project {{ $project->title }}?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
            <form action="{{ route('admin.projects.destroy', $project) }}" method="POST">
              @csrf
              @method('DELETE')
              <button class="btn btn-danger">Delete project</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  @endforeach
@endsection

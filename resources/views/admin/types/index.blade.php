@extends('layouts.main')

@section('assets')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('maincontent')
  <div class="container my-5">
    @include('layouts.partials.alert_message')
    <a href="{{ route('admin.types.create') }}" class="btn btn-outline-primary mb-3"><i class="fa-solid fa-plus"></i> New Type</a>
    <table class="table mb-5">
      <thead>
        <tr>
          <th>Label</th>
          <th>Color</th>
          <th class="text-end">Option</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($types as $type)
          <tr>
            <td>{{ $type->label }}</td>
            <td>{{ $type->color }}</td>
            <td class="fs-4 text-end">
              <a class="me-2" href="{{ route('admin.types.show', $type) }}"><i class="fa-solid fa-eye"></i></a>
              <a class="me-2" href="{{ route('admin.types.edit', $type) }}"><i class="fa-solid fa-pen-to-square"></i></a>
              <a class="me-2 text-danger" href="#" onclick="event.preventDefault(); document.getElementById('destroy-btn-{{ $type->id }}').click();"><i class="fa-solid fa-trash"></i></a>
              <button id="destroy-btn-{{ $type->id }}" type="button" class="d-none" data-bs-toggle="modal" data-bs-target="#confirm-destroy-{{ $type->id }}"></button>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="100%">No Types yet</td>
          </tr>
        @endforelse
      </tbody>
    </table>
    {{ $types->links() }}
  </div>
@endsection

@section('modals')
  @foreach ($types as $type)
    <!-- Modal -->
    <div class="modal fade" id="confirm-destroy-{{ $type->id }}" tabindex="-1" aria-labelledby="confirmDestroyModal" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Deleting type</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            The elimination is permanent. Would you like to delete type {{ $type->title }}?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
            <form action="{{ route('admin.types.destroy', $type) }}" method="POST">
              @csrf
              @method('DELETE')
              <button class="btn btn-danger">Delete type</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  @endforeach
@endsection

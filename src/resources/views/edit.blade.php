@extends('formset::layout')

@section('content')

  @if ($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <h3>Formset</h3>

  <hr>

  <form action="{{url('formset/update/'.$formset->id)}}" method="POST">
    @csrf
    <div class="form-group">
      <label for="name">Name</label>
      <input type="text" class="form-control" name="name" id="name" value="{{ $formset->name }}">
    </div>
    <div class="form-group">
      <label for="table">Table</label>
      <input type="text" class="form-control" name="table" id="table" value="{{ $formset->table }}" disabled>
    </div>
    <div class="form-group">
      <label for="desc">Description</label>
      <textarea class="form-control" name="desc" id="desc" rows="3">{{ $formset->desc }}</textarea>
    </div>

    <hr>
    
    <button type="submit" class="btn btn-primary">Update</button>
    <a href="/formset" class="btn btn-secondary">Cancel</a>
  </form>
@endsection
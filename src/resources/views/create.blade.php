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

  <form action="{{url('formset/store')}}" method="POST">
    @csrf
    <div class="form-group">
      <label for="name">Name</label>
      <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}">
    </div>
    <div class="form-group">
      <label for="desc">Description</label>
      <textarea class="form-control" name="desc" id="desc" rows="3">{{ old('desc') }}</textarea>
    </div>

    <hr>

    <button type="submit" class="btn btn-primary">Create</button>
    <a href="/formset" class="btn btn-secondary">Cancel</a>
  </form>
@endsection
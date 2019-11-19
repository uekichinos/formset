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

  <h3>Fieldset</h3>

  <hr>

  <form action="{{url('formset/'.$id.'/fieldset/store')}}" method="POST">
    @csrf
    <div class="form-group">
      <label for="name">Name</label>
      <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}">
    </div>
    <div class="form-group">
      <label for="field">Field</label>
      <input type="text" class="form-control" name="field" id="field" value="{{ old('field') }}">
    </div>
    <div class="form-group">
      <label for="datatype">Data Type</label>
      <select class="form-control" id="datatype" name="datatype">
        <option value="integer">Integer</option>
        <option value="double">Double</option>
        <option value="char">Char</option>
        <option value="text">Text</option>
        <option value="boolean">Boolean</option>
        <option value="date">Date</option>
        <option value="time">Time</option>
        <option value="datetime">Date Time</option>
        <option value="binary">Binary</option>
      </select>
    </div>

    <hr>
    
    <button type="submit" class="btn btn-primary"><i class="fa fa-check-circle"></i>&nbsp;Submit</button>
    <a href="{{url('formset/show/'.$id)}}" class="btn btn-secondary"><i class="fa fa-ban"></i>&nbsp;Cancel</a>
  </form>
@endsection
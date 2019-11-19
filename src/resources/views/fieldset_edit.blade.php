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

  <form action="{{url('formset/'.$result->formsetid.'/fieldset/update/'.$result->id)}}" method="POST">
    @csrf
    <div class="form-group">
      <label for="name">Name</label>
      <input type="text" class="form-control" name="name" id="name" value="{{ $result->name }}">
    </div>
    <div class="form-group">
      <label for="field">Field</label>
      <input type="text" class="form-control" name="field" id="field" value="{{ $result->field }}" disabled="">
    </div>
    <div class="form-group">
      <label for="datatype">Data Type</label>
      <select class="form-control" id="datatype" name="datatype">
        <option value="integer" {{ ($result->datatype == 'integer' ? 'selected' : '') }}>Integer</option>
        <option value="double" {{ ($result->datatype == 'double' ? 'selected' : '') }}>Double</option>
        <option value="char" {{ ($result->datatype == 'char' ? 'selected' : '') }}>Char</option>
        <option value="text" {{ ($result->datatype == 'text' ? 'selected' : '') }}>Text</option>
        <option value="boolean" {{ ($result->datatype == 'boolean' ? 'selected' : '') }}>Boolean</option>
        <option value="date" {{ ($result->datatype == 'date' ? 'selected' : '') }}>Date</option>
        <option value="time" {{ ($result->datatype == 'time' ? 'selected' : '') }}>Time</option>
        <option value="datetime" {{ ($result->datatype == 'datetime' ? 'selected' : '') }}>Date Time</option>
        <option value="binary" {{ ($result->datatype == 'binary' ? 'selected' : '') }}>Binary</option>
      </select>
    </div>

    <hr>
    
    <button type="submit" class="btn btn-primary"><i class="fa fa-check-circle"></i>&nbsp;Update</button>
    <a href="{{url('formset/show/'.$result->formsetid)}}" class="btn btn-secondary"><i class="fa fa-ban"></i>&nbsp;Cancel</a>
  </form>
@endsection
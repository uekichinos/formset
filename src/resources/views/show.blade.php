@extends('formset::layout')

@section('content')
  @if(session('status'))
    <div class="alert alert-{{ session('status') }}">{{ session('msg') }}</div>
  @endif

  <h3>Formset</h3>

  <hr>

  <div class="form-group">
    <div>Name: {{ $formset->name }}</div>
  </div>
  <div class="form-group">
    <div>Description: {{ $formset->desc }}</div>
  </div>
  <div class="form-group">
    <div>Table: {{ $formset->table }}</div>
  </div>
  <div class="form-group">
    <div>Created Date: {{ $formset->created_at->format('d M Y, H:i') }}</div>
  </div>

  <hr>

  <div class="row">
    <div class="col-4">
      <a href="{{url('formset/'.$formset->id.'/fieldset/create')}}" class="btn btn-primary">Create Fieldset</a>
      <a href="{{url('formset')}}" class="btn btn-secondary">Back</a>
    </div>

    @if(count($fieldsets) > 0)
    <div class="col-2">
      <form action="{{url('formset/gentable/'.$formset->id)}}" method="POST">
        @csrf
        <button type="submit" class="btn btn-primary">Generate Table</button>
      </form>
    </div>
    @endif

    @if($hastable)
    <div class="col">
      <form action="{{url('formset/genmigration/'.$formset->id)}}" method="POST">
        @csrf
        <button type="submit" class="btn btn-info">Migration</button>
      </form>
    </div>
    @endif
  </div>
  <br>

  <div class="row">
    <div class="col">
      <table class="table">
        <thead class="thead-dark">
          <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Field</th>
            <th scope="col">Data Type</th>
            <th scope="col">Created Date</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          @if(count($fieldsets) > 0)
            @foreach($fieldsets as $key => $fieldset)
              <tr>
                <th scope="row">{{ $key+1 }}</th>
                <td>{{ $fieldset->name }}</td>
                <td>{{ $fieldset->field }}</td>
                <td>{{ $fieldset->datatype }}</td>
                <td>{{ $fieldset->created_at->format('d M Y, H:i') }}</td>
                <td>
                  <a href="{{url('formset/'.$formset->id.'/fieldset/edit/'.$fieldset->id)}}">Edit</a> | 
                  <a href="{{url('formset/'.$formset->id.'/fieldset/delete/'.$fieldset->id)}}">Delete</a>
                </td>
              </tr>
            @endforeach
          @else
            <tr>
              <td colspan="6">no record found</td>
            </tr>
          @endif
        </tbody>
      </table>
    </div>
  </div>

@endsection
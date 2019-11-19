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
    <div class="col">
      <a href="{{url('formset')}}" class="btn btn-secondary"><i class="fa fa-chevron-left"></i>&nbsp;Back</a>
      <a href="{{url('formset/'.$formset->id.'/fieldset/create')}}" class="btn btn-primary"><i class="fa fa-plus"></i>&nbsp;Add Fieldset</a>
    </div>

    @if(count($fieldsets) > 0)
    <div class="col-3 text-right">
      <form action="{{url('formset/gentable/'.$formset->id)}}" method="POST">
        @csrf
        <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i>&nbsp;Create Table</button>
      </form>
    </div>
    @endif

    @if($hastable)
    <div class="col-3 text-right">
      <form action="{{url('formset/genmigration/'.$formset->id)}}" method="POST">
        @csrf
        <button type="submit" class="btn btn-info"><i class="fa fa-wrench"></i>&nbsp;Create Migration</button>
      </form>
    </div>
    @endif
  </div>
  <br>

  <div class="row">
    <div class="col">
      <table class="table table-striped">
        <thead class="thead-dark">
          <tr>
            <th scope="col" width="5%">#</th>
            <th scope="col">Name</th>
            <th scope="col">Field</th>
            <th scope="col" width="15%">Data Type</th>
            <th scope="col" width="15%">Created Date</th>
            <th scope="col" width="15%">Action</th>
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
                  <a href="{{url('formset/'.$formset->id.'/fieldset/edit/'.$fieldset->id)}}"><i class="fa fa-edit"></i>&nbsp;Edit</a>&nbsp;&nbsp;
                  <a href="{{url('formset/'.$formset->id.'/fieldset/delete/'.$fieldset->id)}}"><i class="fa fa-trash"></i>&nbsp;Delete</a>
                </td>
              </tr>
            @endforeach
          @else
            <tr>
              <td colspan="6" class="text-center">Owh! no record here. Lets add fieldset.</td>
            </tr>
          @endif
        </tbody>
      </table>
    </div>
  </div>

@endsection
@extends('formset::layout')

@section('content')
  @if(session('status'))
    <div class="alert alert-{{ session('status') }}">{{ session('msg') }}</div>
  @endif

  <div class="row">
    <div class="col"><h3>Formset</h3></div>
    <div class="col text-right"><a href="{{url('formset/create')}}" class="btn btn-primary"><i class="fa fa-plus"></i>&nbsp;Add</a></div>
  </div>

  <hr>

  <table class="table table-striped">
    <thead class="thead-dark">
      <tr>
        <th scope="col" width="5%">#</th>
        <th scope="col" width="20%">Name</th>
        <th scope="col">Descrption</th>
        <th scope="col" width="15%">Table</th>
        <th scope="col" width="15%">Created Date</th>
        <th scope="col" width="20%">Action</th>
      </tr>
    </thead>
    <tbody>
      @if(count($results) > 0)
        @foreach($results as $key => $result)
          <tr>
            <th scope="row">{{ $key+1 }}</th>
            <td>{{ $result->name }}</td>
            <td>{{ $result->desc }}</td>
            <td>{{ $result->table }}</td>
            <td>{{ $result->created_at->format('d M Y, H:i') }}</td>
            <td>
              <a href="{{url('formset/show/'.$result->id)}}"><i class="fa fa-info-circle"></i>&nbsp;Detail</a>&nbsp;&nbsp;
              <a href="{{url('formset/edit/'.$result->id)}}"><i class="fa fa-edit"></i>&nbsp;Edit</a>&nbsp;&nbsp;
              <a href="{{url('formset/delete/'.$result->id)}}"><i class="fa fa-trash"></i>&nbsp;Delete</a>
            </td>
          </tr>
        @endforeach
      @else
        <tr>
          <td colspan="6" class="text-center">Owh! no record here. Lets add formset.</td>
        </tr>
      @endif
    </tbody>
  </table>
@endsection
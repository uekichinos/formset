@extends('formset::layout')

@section('content')
  @if(session('status'))
    <div class="alert alert-{{ session('status') }}">{{ session('msg') }}</div>
  @endif

  <div class="row">
    <div class="col"><h3>Formset</h3></div>
    <div class="col text-right"><a href="{{url('formset/create')}}" class="btn btn-primary">Create</a></div>
  </div>

  <hr>

  <table class="table">
    <thead class="thead-dark">
      <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Descrption</th>
        <th scope="col">Table</th>
        <th scope="col">Created Date</th>
        <th scope="col">Action</th>
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
              <a href="{{url('formset/show/'.$result->id)}}">Detail</a> | 
              <a href="{{url('formset/edit/'.$result->id)}}">Edit</a> | 
              <a href="{{url('formset/delete/'.$result->id)}}">Del</a>
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
@endsection
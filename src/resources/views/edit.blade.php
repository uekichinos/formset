@extends('formset::layout')

@section('content')
  @if ($errors->any())
    <div class="row formset-alert alert alert-danger">
      <div class="col">
        <ul>
          @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    </div>
  @endif
  <div class="row formset-header">
    <div class="col"><h3>Formset</h3></div>
  </div>
  <div class="row fromset-body">
    <table class="table table-striped">
      <tbody>
        <tr>
          <td>
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
              <button type="submit" class="btn btn-primary"><i class="fa fa-check-circle"></i>&nbsp;Update</button>
              <a href="/formset" class="btn btn-secondary"><i class="fa fa-ban"></i>&nbsp;Cancel</a>
            </form>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
@endsection
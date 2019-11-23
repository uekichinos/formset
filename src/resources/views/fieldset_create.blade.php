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
    <div class="col"><h3>Fieldset</h3></div>
  </div>
  <div class="row fromset-body">
    <table class="table table-striped">
      <tbody>
        <tr>
          <td>
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
                  @foreach ($fieldsets as $key => $fieldset)
                    <option value="{{ $key }}">{{ $fieldset['name'] }}</option>
                  @endforeach
                </select>
              </div>
              <hr>
              <button type="submit" class="btn btn-primary"><i class="fa fa-check-circle"></i>&nbsp;Submit</button>
              <a href="{{url('formset/show/'.$id)}}" class="btn btn-secondary"><i class="fa fa-ban"></i>&nbsp;Cancel</a>
            </form>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
@endsection
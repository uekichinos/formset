@extends('formset::layout')

@section('content')
  @if(session('status'))
    <div class="row formset-alert alert alert-{{ session('status') }}">
      {{ session('msg') }}
    </div>
  @endif
  <div class="row formset-header">
    <div class="col"><h3>Formset</h3></div>
    <div class="col text-right">
      <a href="{{url('formset')}}" class="btn btn-secondary"><i class="fa fa-chevron-left"></i>&nbsp;Back</a>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-9">
      <div class="row fromset-body">
        <table class="table table-striped">
          <thead class="thead-dark">
            <tr>
              <th scope="col" width="5%">#</th>
              <th scope="col" width="15%">Name</th>
              <th scope="col" width="15%">Field</th>
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
                  <td>{{ $fields[$fieldset->datatype]['name'] }}</td>
                  <td>{{ $fieldset->created_at->format('d M Y, H:ia') }}</td>
                  <td>
                    <a href="{{url('formset/'.$formset->id.'/fieldset/edit/'.$fieldset->id)}}"><i class="fa fa-edit"></i>&nbsp;Edit</a>&nbsp;&nbsp;
                    <a href="{{url('formset/'.$formset->id.'/fieldset/delete/'.$fieldset->id)}}" class="delete"><i class="fa fa-trash"></i>&nbsp;Delete</a>
                  </td>
                </tr>
              @endforeach
            @else
              <tr>
                <td colspan="6" class="text-center">Owh! its empty. Lets add fieldset.</td>
              </tr>
            @endif
          </tbody>
        </table>
      </div>
    </div>
    <div class="col-sm-3">
      <div class="row mb-1">
        <div class="col">
          <a href="{{url('formset/'.$formset->id.'/fieldset/create')}}" class="btn btn-primary btn-block">
            <i class="fa fa-plus"></i>&nbsp;Add Fieldset
          </a>
        </div>
      </div>
      @if(count($fieldsets) > 0)
        <div class="row mb-1">
          <div class="col">
            <form action="{{url('formset/gentable/'.$formset->id)}}" method="POST">
              @csrf
              <button type="submit" class="btn btn-info btn-block">
                <i class="fa fa-plus"></i>&nbsp;Create Table Structure
              </button>
            </form></a>
          </div>
        </div>
      @endif
      @if(($hastable) && ($btn_migration))
        <div class="row mb-1">
          <div class="col">
            <form action="{{url('formset/genmigration/'.$formset->id)}}" method="POST">
              @csrf
              <button type="submit" class="btn btn-info btn-block">
                <i class="fa fa-wrench"></i>&nbsp;Create Migration FIle
              </button>
            </form></a>
          </div>
        </div>
      @endif
      <br>
      <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h6 class="card-title">Formset Detail</h6>
              <hr>
              {{ $formset->name }} 
              <span class="text-muted font-weight-light font-italic">
                <small>({{ $formset->table }})</small>
              </span>
              <br>{{ $formset->desc }}<br>
              <span class="text-muted font-weight-light font-italic">
                <small>{{ $formset->created_at->format('d/m/Y, H:ia') }}</small>
              </span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('script')
  <script>
    $(".delete").on("click", function(){
        return confirm("Are you sure?");
    });
  </script>
@endsection
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
      <a href="{{url('formset/create')}}" class="btn btn-primary"><i class="fa fa-plus"></i>&nbsp;Add</a>
    </div>
  </div>
  <div class="row">
    @if(count($results) > 0)
        @foreach($results as $key => $result)
          <div class="col-sm-4 mb-3 pl-0">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title">{{ $result->name }} <span class="text-muted font-weight-light font-italic">({{ $result->table }})</span></h5>
              </div>
              <div class="card-body">
                <p class="card-text">
                  {{ $result->desc }}
                  <div class="card-subtitle text-muted font-weight-light font-italic"><small>{{ $result->created_at->format('d/m/Y, H:ia') }}</small></div>
                </p>
              </div>
              <div class="card-footer font-weight-light font-italic">
                <div class="row">
                  <div class="col-sm-4 text-center" style="font-size:20px;">
                    <a href="{{url('formset/show/'.$result->id)}}"><i class="fa fa-list-alt"></i></a>
                  </div>
                  <div class="col-sm-4 text-center" style="font-size:20px;">
                    <a href="{{url('formset/edit/'.$result->id)}}"><i class="fa fa-edit"></i></a>
                  </div>
                  <div class="col-sm-4 text-center" style="font-size:20px;">
                    <a href="{{url('formset/delete/'.$result->id)}}" class="delete"><i class="fa fa-trash"></i></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        @endforeach
    @else
      Owh! its empty. Lets add formset.
    @endif
  </div>
@endsection

@section('script')
  <script>
    $(".delete").on("click", function(){
        return confirm("Are you sure?");
    });
  </script>
@endsection

@extends('master')

@section('content')

<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>All PF Interest Fund </h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active"><a href="#">PF Interest</a></li>
          <li class="breadcrumb-item active"><a href="#">All PF Interest Information</a></li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>
<section class="content">

  <div class="card card-success card-outline">
    <div class="card-header">
      <div class="row">
        <div class="col-sm-6">
            <h3 class="card-title">All PF Interest Information</h3>
        </div>

        <div class="col-md-6">
          <a href="" class="btn btn-success" data-toggle="modal" data-target="#modal-default">Batch Upload</a> 
          <a href="{{url('download_excel/pf_interest/Interest.xlsx')}}" class="btn btn-success">Download Sample Excel</a> 
          <a href="{{route('add-pf-interest')}}" class="btn btn-primary"><i class="fas fa-plus"></i> Add Interest</a>
        </div>
        <div class="col-md-6 offset-3 mt-2">
            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
                </div>
            @endif

            @if ($message = Session::get('error'))
            <div class="alert alert-danger alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
            </div>
           @endif

            @if ($errors->any())
                <div class="alert alert-warning">
                <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>

      </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th>SL NO</th>
          <th>Interest Date</th>
          <th>Interest Source</th>
          <th>Staff Code</th>
          <th>Own</th>
          <th>Organization</th>
          <th>Action</th>
        </tr>
        </thead>
        <tbody>

        <?php $i = 1; ?>
        @foreach ($all_pf_interests as $all_pf_interest)
        <tr>
          <td> {{$i++}} </td>
          <td>{{$all_pf_interest->interest_date}}</td>
          <td>{{$all_pf_interest->interest_source}}</td>
          <td>{{$all_pf_interest->staff_code}}</td>
          <td>{{$all_pf_interest->own}}</td>
          <td>{{$all_pf_interest->organization}}</td>
          <td class="row">
              <a href="{{route('edit-pf-interest',$all_pf_interest->id)}}" class="btn btn-warning"><i class="fas fa-edit"></i></a>
              <a href="{{route('delete-pf-interest',$all_pf_interest->id)}}" class="btn btn-danger ml-2"><i class="fas fa-trash-alt "></i></a>
          </td>
        </tr>
        @endforeach

        </tbody>
      </table>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->

</section>


<!-- START EMPLOYEE BATCH UPLOAD MODAL -->
<div class="modal fade" id="modal-default">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">PF interest Bacth Upload</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="{{route('save-pf-batch-upload')}}" method="post" enctype="multipart/form-data">
        @csrf
          <input type="file" name="file" class="form-control">
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Upload</button>
          </div>
        </form>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- END EMPLOYEE BATCH UPLOAD MODAL -->
@endsection

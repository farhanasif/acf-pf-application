
@extends('master')

@section('content')

<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
          <h1>All Account Head Information</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
          <li class="breadcrumb-item active"><a href="javascript:void(0)">Account Head</a></li>
          <li class="breadcrumb-item active"><a href="javascript:void(0)">All Account Head Information</a></li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
  </section>

  <section class="content">
    <div class="card card-success card-outline">
      <div class="card-header">
        <h3 class="card-title">All Account Head Information</h3>
        <div class="float-right">
            <a href="{{route('add-account-head')}}" class="btn btn-primary "><i class="fas fa-plus"></i> Add Account Head</a>
        </div>
   

        <div class="col-md-5 text-center offset-3 mt-2">
            @if ($message = Session::get('danger'))
              <div class="alert alert-danger alert-block text-center">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
              </div>
            @endif

            @if ($message = Session::get('success'))
              <div class="alert alert-success alert-block text-center">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
              </div>
            @endif
        </div>
      </div>
    <!-- /.card-header -->
    <div class="card-body">
      <table id="all-account-head" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>SL NO</th>
            <th>Account Head</th>
            <th>Account Code</th>
            <th>Account Type</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
         <?php $i=1;?>
         @foreach ($all_accounts as $row)
          <tr>
          <td>{{$i++}}</td>
          <td>{{$row->account_head}}</td>
          <td>{{$row->account_code}}</td>
          <td>{{$row->account_type}}</td>
          <td>
            <a href="{{route('edit-account-head',$row->id)}}" class="btn btn-warning"><i class="fas fa-edit"></i></a>
            <a href="{{route('delete-account-head',$row->id)}}" class="btn btn-danger"><i class="fas fa-trash-alt "></i></a>
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

@endsection
@section('customjs')  
<script>

  $(document).ready( function(){
    $('#all-account-head').DataTable();
  });

</script>
@endsection
@extends('master')
@section('content')
 <!-- DataTables -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>All Withdraw Information</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
          <li class="breadcrumb-item active"><a href="javascript:void(0);">Withdraw</a></li>
          <li class="breadcrumb-item active"><a href="javascript:void(0);">All Withdraw Information</a></li>
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
          <h3 class="card-title">All Withdraw Information</h3>
        </div>

        <div class="col-md-6">
          <a href="" class="btn btn-success">Batch Upload</a> 
          <a href="" class="btn btn-success">Download Sample Excel</a> 
          <a href="{{route('add-pf-withdraw')}}" class="btn btn-primary"><i class="fas fa-plus"></i> Add Withdraw</a>
        </div>
        <div class="col-md-6 offset-3 mt-2">
            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
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
          <th>Staff Code</th>
          <th>Received Amount</th>
          <th>Received Date</th>
          <th>Received By</th>
          <th>Received In</th>
          <th>Authorization Signatory</th>
          <th>Description</th>
          <th>Action</th>
        </tr>
        </thead>
        <tbody>

        <?php $i = 1;?>
        @foreach ($all_pf_withdraws as $all_pf_withdraw)
        <tr>
        <td>{{$i++}}</td>
        <td>{{$all_pf_withdraw->staff_code}}</td>
          <td>{{$all_pf_withdraw->received_amount}}</td>
          <td>{{$all_pf_withdraw->received_date}}</td>
          <td>{{$all_pf_withdraw->received_by}}</td>
          <td>{{$all_pf_withdraw->received_in}}</td>
          <td>{{$all_pf_withdraw->authorization_signatory}}</td>
          <td>{{$all_pf_withdraw->description}}</td>
          <td class="row">
            <a href="{{route('edit-pf-withdraw',$all_pf_withdraw->id)}}" class="btn btn-warning"><i class="fas fa-edit"></i></a>
            <a href="{{route('delete-pf-withdraw',$all_pf_withdraw->id)}}" class="btn btn-danger ml-2"><i class="fas fa-trash-alt"></i></a>
        </td>
        </tr>
        @endforeach
        </tfoot>
      </table>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</section>
@endsection


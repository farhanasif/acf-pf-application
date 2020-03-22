@extends('master')
@section('customcss') 
  
@endsection
@section('content')
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
          <h3 class="card-title">All Withdraw Information</h3>
        <div class="float-sm-right">
          <a href="" class="btn btn-success" data-toggle="modal" data-target="#modal-default">Batch Upload</a> 
          <a href="{{url('download_excel/pf_withdraw/pf-withdraw.xlsx')}}" class="btn btn-success">Download Sample Excel</a> 
          <a href="{{route('add-pf-withdraw')}}" class="btn btn-success"><i class="fas fa-plus"></i> Add Withdraw</a>
        </div>
        <div class="col-md-6 offset-3 mt-2">
            @if ($message = Session::get('success'))
              <div class="alert alert-success alert-block text-center">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
              </div>
            @endif

            @if ($message = Session::get('danger'))
              <div class="alert alert-danger alert-block text-center">
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
    <!-- /.card-header -->
    <div class="card-body">
      <table id="all-pf-withdraw" class="table table-bordered table-striped">
        <thead>
          <tr class="bg-success">
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
          <td>
            <a href="{{route('edit-pf-withdraw',$all_pf_withdraw->id)}}" class="btn btn-warning"><i class="fas fa-edit"></i></a>
            <a href="{{route('delete-pf-withdraw',$all_pf_withdraw->id)}}" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
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

  <!-- START WITHDRAW BATCH UPLOAD MODAL -->
  <div class="modal fade" id="modal-default">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">PF Withdraw Bacth Upload</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{route('save-pf-withdraw-batch-upload')}}" method="post" enctype="multipart/form-data">
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
  <!--  /.END WITHDRAW BATCH UPLOAD MODAL -->

@endsection

@section('customjs')  
<script>

$(document).ready( function(){
$('#all-pf-withdraw').DataTable({
    "info": true,
    "autoWidth": false,
    scrollX:'50vh', 
    scrollY:'50vh',
    scrollCollapse: true,
    fixedColumns: {
    leftColumns: 2
}
});
});
</script>
@endsection
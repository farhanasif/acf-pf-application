
@extends('master')
@section('customcss') 
  
@endsection
@section('content')

<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>All PF Deposit Information</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
          <li class="breadcrumb-item active"><a href="javascript:void(0)">PF Deposit</a></li>
          <li class="breadcrumb-item active"><a href="javascript:void(0)">All PF Deposit Information</a></li>
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
          <h3 class="card-title">All PF Deposit Information</h3>
        </div>

        <div class="col-md-6">
          <a href="" class="btn btn-success" data-toggle="modal" data-target="#pf-deposit">Batch Upload</a> 
          <a href="{{url('download_excel/pf_deposit/pf-deposit.xlsx')}}" class="btn btn-success">Download Sample Excel</a> 
          <a href="{{route('add-provident-fund')}}" class="btn btn-primary"><i class="fas fa-plus"></i> Add PF Deposit</a>
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
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <table id="all-pf-deposit" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>SL NO</th>
            <th>Deposit Date</th>
            <th>Staff Code</th>
            <th>Own PF Deposit</th>
            <th>Organization PF Deposit</th>
            <th>Total PF Deposit</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php $i=1;?>
          @foreach($provident_funds as $provident_fund)
          <tr>
            <td>{{$i++}}</td>
            <td>{{$provident_fund->deposit_date}}</td>
            <td>{{ sprintf("%04d", $provident_fund->staff_code)}}</td>
            <td>{{$provident_fund->own_pf}}</td>
            <td>{{$provident_fund->organization_pf}}</td>
            <td>{{$provident_fund->total_pf}}</td>
            <td>
                <a href="{{route('edit-provident-fund',$provident_fund->id)}}" class="btn btn-warning"><i class="fas fa-edit"></i></a>
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

    <!-- START PF DEPOSIT BATCH UPLOAD MODAL -->
    <div class="modal fade" id="pf-deposit">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">PF Deposit Bacth Upload</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="{{route('save-pf-deposit-batch')}}" method="post" enctype="multipart/form-data">
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
    <!-- END PF DEPOSIT BATCH UPLOAD MODAL -->

    @section('customjs')  
    <script>

  $(document).ready( function(){
    $('#all-pf-deposit').DataTable({
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

@endsection

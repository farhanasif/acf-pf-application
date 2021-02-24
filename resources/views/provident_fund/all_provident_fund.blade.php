
@extends('master')
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
          <h3 class="card-title">All PF Deposit Information</h3>
        <div class="float-sm-right">
          <button type="submit" id="all-pf-deposit-download" onclick="exportToExcel('all-pf-deposit','all-pf-deposit')" class="btn btn-success">Download Excel</button>
          {{-- <a href="{{route('pf-deposit-export')}}" class="btn btn-success"> Download Excel</a> --}}
          <a href="" class="btn btn-success" data-toggle="modal" data-target="#pf-deposit">Batch Upload</a>
          <a href="{{url('download_excel/pf_deposit/pf-deposit.xlsx')}}" class="btn btn-success">Download Sample Excel</a>
          <a href="{{route('add-provident-fund')}}" class="btn btn-success"><i class="fas fa-plus"></i> Add PF Deposit</a>
        </div>
    </div>

        @include('message')

    <div class="card-header card-secondary">
      <div class="card-header">
        <h3 class="card-title">Filters</h3>
        </div>
    <form role="form" action="{{route('all-provident-fund')}}" method="POST">
      @csrf
      <div class="row">
        <div class="col-md-6 col-sm-6">
          <div class="form-group">
          <label>Staff Code</label>
          <select class="custom-select select2bs4 " id="staff_code" name="staff_code">
              <option value="-1">--select--</option>
              @foreach ($staff_codes as $provident_fund)
                <option value="{{ sprintf("%04d", $provident_fund->staff_code)}}"> {{ sprintf("%04d", $provident_fund->staff_code)}} </option>
              @endforeach
          </select>
          </div>
        </div>

        <div class="col-md-6 col-sm-6">
          <div class="form-group">
          <label>Deposit Date</label>
          <select class="custom-select select2bs4 " id="deposit_date" name="deposit_date">
              <option value="-1">--select--</option>
              @foreach ($deposit_dates as $deposit_date)
                <option value="{{ $deposit_date->deposit_date }}">{{ $deposit_date->month_name }}</option>
              @endforeach
          </select>
          </div>
        </div>
          </div>

          <div class="mb-5">
            <button type="submit" id="search" class="btn btn-success">Generate</button>
          </div>
   </form>
  </div>
    <!-- /.card-header -->
    <div class="card-body table-responsive p-0" style="height: 500px;">
      <table id="all-pf-deposit" class="table table-bordered table-striped table-head-fixed text-nowrap">
        <thead>
          <tr>
            <th class="bg-success">SL NO</th>
            <th class="bg-success">Deposit Date</th>
            <th class="bg-success">Staff Code</th>
            <th class="bg-success">Own PF Deposit</th>
            <th class="bg-success">Organization PF Deposit</th>
            <th class="bg-success">Total PF Deposit</th>
            <th class="bg-success">Action</th>
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
                <a href="{{route('edit-provident-fund',$provident_fund->id)}}" class="btn btn-info btn-xs"><i class="fas fa-edit"></i>
                </a>
                <a href="{{route('delete-provident-fund',$provident_fund->id)}}" class="btn btn-danger btn-xs"><i class="fas fa-trash-alt"></i>
                </a>
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
    @endsection

@section('customjs')
  <script src="http://www.jqueryscript.net/demo/jQuery-Plugin-To-Convert-HTML-Table-To-CSV-tabletoCSV/jquery.tabletoCSV.js"></script>

<script>

 $(document).ready(function(){

  $('.select2bs4').select2({
    theme: 'bootstrap4',
  });


  </script>

  <script>
  	      function exportToExcel(tableID, filename){
        //  console.log(staff_code);
      var downloadLink;
      var dataType = 'application/vnd.ms-excel';
      var header = "<h2 style='text-align:center;'>Name : Arif Khan</h2><h2 style='text-align:center;'>Staff Code: 1111</h2>";
      var tableSelect = document.getElementById(tableID);
      var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
      // console.log(header);
      // Specify file name
      filename = filename?filename+'.xls':'excel_data.xls';
  
      // Create download link element
      downloadLink = document.createElement("a");
  
      document.body.appendChild(downloadLink);
  
      if(navigator.msSaveOrOpenBlob){
          var blob = new Blob(['\ufeff', tableHTML], {
              type: dataType
          });
          navigator.msSaveOrOpenBlob( blob, filename);
      }else{
          // Create a link to the file
          downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
  
          // Setting the file name
          downloadLink.download = filename;
  
          //triggering the function
          downloadLink.click();
      }
  }

  </script>
@endsection


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
          <h3 class="card-title">All PF Deposit Information</h3>
        <div class="float-sm-right">
          {{-- <button type="submit" id="all-pf-deposit-download" class="btn btn-success">Download Excel</button> --}}
          <a href="{{route('pf-deposit-export')}}" class="btn btn-success"> Download Excel</a>
          <a href="" class="btn btn-success" data-toggle="modal" data-target="#pf-deposit">Batch Upload</a>
          <a href="{{url('download_excel/pf_deposit/pf-deposit.xlsx')}}" class="btn btn-success">Download Sample Excel</a>
          <a href="{{route('add-provident-fund')}}" class="btn btn-success"><i class="fas fa-plus"></i> Add PF Deposit</a>
        </div>

         @include('message')

    </div>

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
    <div class="card-body">
      <table id="all-pf-deposit" class="table table-bordered table-striped">
        <thead>
          <tr class="bg-success">
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
    @endsection

@section('customjs')
<script src="http://www.jqueryscript.net/demo/jQuery-Plugin-To-Convert-HTML-Table-To-CSV-tabletoCSV/jquery.tabletoCSV.js"></script>

<script>

 $(document).ready(function(){

  $('.select2bs4').select2({
    theme: 'bootstrap4',
  });

 // START ALL EMPLOYEE TABLE DATA DOWNLOAD CLICK FUNCTION
  $( "#all-pf-deposit-download" ).click(function() {
        $("#all-pf-deposit").tableToCSV();
    });
// END ALL EMPLOYEE TABLE DATA DOWNLOAD CLICK FUNCTION

// START TABLE TO CSV CONVERT FUNCTION
var tableToExcel = (function() {
      var uri = 'data:application/vnd.ms-excel;base64,',
          template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>',
          base64 = function(s) {
          return window.btoa(unescape(encodeURIComponent(s)))
          },
          format = function(s, c) {
          return s.replace(/{(\w+)}/g, function(m, p) {
              return c[p];
          })
          }
      return function(table, name) {
          if (!table.nodeType)
          table = document.getElementById(table)
          var ctx = {
          worksheet: name || 'Worksheet',
          table: table.innerHTML
          }
          var HeaderName = 'Download-ExcelFile';
          var ua = window.navigator.userAgent;
          var msieEdge = ua.indexOf("Edge");
          var msie = ua.indexOf("MSIE ");
          if (msieEdge > 0 || msie > 0) {
          if (window.navigator.msSaveBlob) {
              var dataContent = new Blob([base64(format(template, ctx))], {
              type: "application/csv;charset=utf-8;"
              });
              var fileName = "excel.xls";
              navigator.msSaveBlob(dataContent, fileName);
          }
          return;
          }
          window.open('data:application/vnd.ms-excel,' + encodeURIComponent(format(template, ctx)));
      }
  })()
// END TABLE TO CSV CONVERT FUNCTION

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

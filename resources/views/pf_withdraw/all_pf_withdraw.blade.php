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
        <div class="float-right">
          <button type="submit" id="all-pf-withdraw-download" class="btn btn-success">Download Excel</button>
          {{-- <a href="" class="btn btn-success" data-toggle="modal" data-target="#update-modal-default">Update Batch</a> --}}
          <a href="" class="btn btn-success" data-toggle="modal" data-target="#modal-default">Batch Upload</a> 
          <a href="{{url('download_excel/pf_withdraw/pf-withdraw.xlsx')}}" class="btn btn-success">Download Sample Excel</a> 
          <a href="{{route('add-pf-withdraw')}}" class="btn btn-success"><i class="fas fa-plus"></i> Add Withdraw</a>
        </div>

          @include('message')
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
            <a href="{{route('edit-pf-withdraw',$all_pf_withdraw->id)}}" class="btn btn-info btn-xs"><i class="fas fa-edit"></i></a>
            <a href="{{route('delete-pf-withdraw',$all_pf_withdraw->id)}}" class="btn btn-danger btn-xs"><i class="fas fa-trash-alt"></i></a>
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


    <!-- START WITHDRAW UPDATE BATCH UPLOAD MODAL -->
    <div class="modal fade" id="update-modal-default">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">PF Withdraw Update Bacth</h4>
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
    <!--  /.END WITHDRAW UPDATE BATCH UPLOAD MODAL -->

@endsection

@section('customjs')  
<script src="http://www.jqueryscript.net/demo/jQuery-Plugin-To-Convert-HTML-Table-To-CSV-tabletoCSV/jquery.tabletoCSV.js"></script>

<script>

  $(document).ready( function(){

  // START PF WITHDRAW TABLE DATA DOWNLOAD CLICK FUNCTION
    $( "#all-pf-withdraw-download" ).click(function() {
          $("#all-pf-withdraw").tableToCSV();
      });
  // END PF WITHDRAW TABLE DATA DOWNLOAD CLICK FUNCTION

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

  $('#all-pf-withdraw').DataTable({
    
      "info": true,
      "autoWidth": false,
      scrollX:'50vh', 
      scrollY:'50vh',
      scrollCollapse: true,
  });

  });

</script>
@endsection
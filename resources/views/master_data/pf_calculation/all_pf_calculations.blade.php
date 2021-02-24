
@extends('master')

@section('content')

<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>All Pf Calculation Information</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
          <li class="breadcrumb-item active"><a href="#">Pf Calculation</a></li>
          <li class="breadcrumb-item active"><a href="#">All Pf Calculation Information</a></li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>
<section class="content">

  <div class="card card-success card-outline">
    <div class="card-header">
            <h3 class="card-title">All Pf Calculation Information</h3>
        <div class="float-right">
            <button type="submit" id="all-pf-calculation-download" class="btn btn-success">Download Excel</button>
            <a href="{{route('add-pf-calculation')}}" class="btn btn-success"><i class="fas fa-plus"></i> Add Pf</a>
        </div>

      <div class="col-md-5 text-center offset-3 mt-2">
          @if ($message = Session::get('danger'))
            <div class="alert alert-danger alert-block">
              <button type="button" class="close" data-dismiss="alert">×</button>
              <strong>{{ $message }}</strong>
            </div>
          @endif

          @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
              <button type="button" class="close" data-dismiss="alert">×</button>
              <strong>{{ $message }}</strong>
            </div>
          @endif
      </div>

    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <table id="all-pf-calculation" class="table table-bordered table-striped">
        <thead>
          <tr class="bg-success">
            <th>SL NO</th>
            <th>Name</th>
            <th>Own Pf</th>
            <th>Organization Pf</th>
            <th>Total Pf</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
          <?php $i=1;?>
          @foreach ($pf_calculation as $row)
          <tr>
            <td>{{$i++}}</td>
            <td>{{$row->name}}</td>
            <td>{{$row->own_pf}}</td>
            <td>{{$row->organization_pf}}</td>
            <td>{{$row->total_pf}}</td>
            <td>
              <a href="{{route('edit-pf-calculation',$row->id)}}" class="btn btn-info btn-xs"><i class="fas fa-edit"></i></a>
              <a href="{{route('delete-pf-calculation',$row->id)}}" class="btn btn-danger btn-xs"><i class="fas fa-trash-alt"></i></a>
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
<script src="http://www.jqueryscript.net/demo/jQuery-Plugin-To-Convert-HTML-Table-To-CSV-tabletoCSV/jquery.tabletoCSV.js"></script>

<script>

  $(document).ready( function(){



  // START PF CALCULATION TABLE DATA DOWNLOAD CLICK FUNCTION
  $( "#all-pf-calculation-download" ).click(function() {
          $("#all-pf-calculation").tableToCSV();
      });
  // END PF CALCULATION TABLE DATA DOWNLOAD CLICK FUNCTION

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


    $('#all-pf-calculation').DataTable({
          "info": true,
          "autoWidth": false,
          scrollX:'50vh', 
          scrollY:'50vh',
    });
  });

</script>
@endsection
@extends('master')

@section('content')

<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>All Base Information</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active"><a href="#">Base</a></li>
          <li class="breadcrumb-item active"><a href="#">All Base Information</a></li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<section class="content">
  <div class="card card-success card-outline">
    <div class="card-header">
          <h3 class="card-title">All Base Information</h3>
        <div class="float-right">
            <button type="submit" id="all-base-download" class="btn btn-success">Download Excel</button>
            <a href="{{route('add-base')}}" class="btn btn-success"><i class="fas fa-plus"></i> Add Base</a>
        </div>

      @include('message')

    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <table id="all-base" class="table table-bordered table-striped">
        <thead>
          <tr class="bg-success">
          <th>SL NO</th>
          <th>Base Name</th>
          <th>Base Description</th>
          <th>Action</th>
        </tr>
        </thead>
        <tbody>
          <?php $i=1;?>
          @foreach ($bases as $base)
          <tr>
            <td>{{ $i++}}</td>
            <td>{{$base->base_name}}</td>
            <td>{{$base->base_description}}</td>
            <td>
              <div style="display: block; width:150px">
              <a href="{{route('edit-base',$base->id)}}" class="btn btn-info btn-xs"><i class="fas fa-edit"></i></a>
              <a href="{{route('delete-base',$base->id)}}" class="btn btn-danger btn-xs"><i class="fas fa-trash-alt"></i></a>
            </div>
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


  // START BASE TABLE DATA DOWNLOAD CLICK FUNCTION
  $( "#all-base-download" ).click(function() {
          $("#all-base").tableToCSV();
      });
  // END BASE TABLE DATA DOWNLOAD CLICK FUNCTION

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


    $('#all-base').DataTable({
          "info": true,
          "autoWidth": false,
          scrollX:'50vh', 
          scrollY:'50vh',
    });
  });

</script>
@endsection
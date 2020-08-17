@extends('master')
@section('content')
<section>
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Loan Details</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="javascript:void()">Home</a></li>
            <li class="breadcrumb-item active">Loan Details</li>
          </ol>
        </div>
      </div>
      </div><!-- /.container-fluid -->
    </section>
    <section class="content">
      <div class="card card-success card-outline">
        <div class="card-header">
          <h3 class="card-title">Loan Amount Details</h3>
          <div class="float-sm-right">
            <button type="submit" id="loanTable-download" class="btn btn-success">Download Excel</button>
          <a href="{{route('create-loan')}}" class="btn btn-success"><i class="fas fa-plus"></i> Create New Loan</a>
        </div>
        </div>
        <div class="card-body">
          <div class="card-body table-responsive p-0" style="">
            <table class="table table-striped table-head-fixed text-nowrap" id="loanTable">
              <thead>
                <tr>
                  <th class="bg-success">SL</th>
                  <th class="bg-success">Date</th>
                  <th class="bg-success">Staff Code</th>
                  <th class="bg-success">Name</th>
                  <th class="bg-success">Amount</th>
                  <th class="bg-success">Interest</th>
                  <th class="bg-success">Months</th>
                  <th class="bg-success">Start Month</th>
                  <th class="bg-success">End Month</th>
                  <th class="bg-success">Action</th>
                </tr>
              </thead>
              <tbody>
               <?php $ci = 1; ?>
                @foreach ($data as $item)
                <tr>
                  <td><?php 
                      if($ci < 10) echo '0'.$ci++;
                      else echo $ci;
                   ?></td>
                  <td> {{ date('j F, Y', strtotime($item->issue_date)) ? date('j F, Y', strtotime($item->issue_date)) : 'Nill' }}  </td>
                  <td><a href="{{ url('/employee-details',$item->staff_code) }}">{{ $item->staff_code }} </a></td>
                  <td><a href="{{ url('/employee-details',$item->staff_code) }}">{{ $item->first_name.' '.$item->last_name ? $item->first_name.' '.$item->last_name : 'Nill'}} </a></td>
                  <td class="center"><dt> {{ $item->loan_amount ? number_format($item->loan_amount) : 'Nill' }} </dt></td>
                  <td class="center">{{$item->interest ? $item->interest :'Nill'}}</td>
                  <td class="center"> {{$item->total_months ? $item->total_months : 'Nill' }} </td>
                  <td> {{ date('j F, Y', strtotime($item->loan_start_date)) ? date('j F, Y', strtotime($item->loan_start_date)) : 'Nill' }}  </td>
                  <td> {{ date('j F, Y', strtotime($item->loan_end_date)) ? date('j F, Y', strtotime($item->loan_end_date)) : 'Nill' }}  </td>
                  <td><a href="{{ url('/adjust-loan',$item->staff_code) }}"><button class="btn btn-warning" style="color: White;font-weight: 700;">Adjust Loan</button></a></td>
                </tr>
                @endforeach
              </tbody>
            </table>
            </div><!-- /.card-body -->
          </div>
        </div>
        </div><!-- /.card-body -->
      </section>
    </section>
    @endsection
    @section('customjs')
    <script src="http://www.jqueryscript.net/demo/jQuery-Plugin-To-Convert-HTML-Table-To-CSV-tabletoCSV/jquery.tabletoCSV.js"></script>

    <script>
    $(document).ready(function() {

      // START ALL LOANS TABLE DATA DOWNLOAD CLICK FUNCTION
    $( "#loanTable-download" ).click(function() {
          $("#loanTable").tableToCSV();
      });
  // END ALL LOANS TABLE DATA DOWNLOAD CLICK FUNCTION

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


    $('#loanTable').DataTable();
    } );
    </script>
    @endsection
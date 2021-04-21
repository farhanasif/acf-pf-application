
@extends('master')
@section('customcss')

@endsection
@section('content')

<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>All Forfeiture Account Information </h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
          <li class="breadcrumb-item active"><a href="javascript:void(0)">Forfeiture Account</a></li>
          <li class="breadcrumb-item active"><a href="javascript:void(0)">All Forfeiture Account Information</a></li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>
<section class="content">

  <div class="card card-success card-outline">
    <div class="card-header">
        <h3 class="card-title">All Forfeiture Account Information</h3>
        <div class="float-sm-right">
          <button type="submit" id="pf-interest-download" class="btn btn-success"  onclick="exportToExcel('pf-interest','pf-interest')">Download Excel</button>
          {{-- <a href="" class="btn btn-success" data-toggle="modal" data-target="#update-modal-default">Update Batch</a> --}}
          <a href="" class="btn btn-success" data-toggle="modal" data-target="#modal-default">Batch Upload</a>
          <a href="{{url('download_excel/forfeiture_account/Forfeiture.xlsx')}}" class="btn btn-success">Download Sample Excel</a>
          <a href="{{route('create.forfeiture_accounts')}}" class="btn btn-success"><i class="fas fa-plus"></i> Create Forfeiture Account</a>
        </div>
        @include('message')
    </div>

    <div class="card-header card-secondary">
      <div class="card-header">
        <h3 class="card-title">Filters</h3>
        </div>
    <form role="form" action="{{route('forfeiture_accounts.index')}}" method="POST">
      @csrf
      <div class="row">
        <div class="col-md-6 col-sm-6">
          <div class="form-group">
          <label>Staff Code</label>
          <select class="custom-select select2bs4 " id="staff_code" name="staff_code">
            <option value="-1">--select--</option>
            @foreach ($staff_codes as $staff_code)
              <option value="{{ sprintf("%04d", $staff_code->staff_code)}}"> {{ sprintf("%04d", $staff_code->staff_code)}} </option>
            @endforeach
         </select>
          </div>
        </div>

        <div class="col-md-6 col-sm-6">
          <div class="form-group">
          <label>Forfeiture Account Date</label>
          <select class="custom-select select2bs4 " id="interest_date" name="interest_date">
            <option value="-1">--select--</option>
            @foreach ($fa_dates as $fa_date)
              <option value="{{$fa_date->fa_date}}"> {{$fa_date->month_name}} </option>
            @endforeach
        </select>
          </div>
        </div>        
          </div>

          <div class="mb-5">
            <button type="submit" class="btn btn-success">Generate</button>
          </div>
   </form>
  </div>

    <!-- /.card-header -->
    <div class="card-body table-responsive p-0"  style="height: 500px;">
      <table id="pf-interest" class="table table-bordered table-striped table-head-fixed text-nowrap">
        <thead>
          <tr>
            <th class="bg-success">SL NO</th>
            <th class="bg-success">Forfeiture Account Date</th>
            <th class="bg-success">Forfeiture Account Source</th>
            <th class="bg-success">Staff Code</th>
            <th class="bg-success">Own</th>
            <th class="bg-success">Organization</th>
            <th class="bg-success">Action</th>
        </tr>
        </thead>
        <tbody>

        <?php $i = 1; ?>
        @foreach ($all_forfeiture_accounts as $forfeiture_account)
        <tr>
          <td> {{$i++}} </td>
          <td>{{ date('j F, Y', strtotime($forfeiture_account->fa_date,3))}}</td>
          <td>{{$forfeiture_account->fa_source}}</td>
          <td>{{ sprintf("%04d", $forfeiture_account->staff_code)}}</td>
          <td>{{$forfeiture_account->own}}</td>
          <td>{{$forfeiture_account->organization}}</td>
          <td>
              <a href="{{route('edit.forfeiture_accounts',$forfeiture_account->id)}}" class="btn btn-info btn-xs"><i class="fas fa-edit"></i></a>
              <a href="{{route('delete.forfeiture_accounts',$forfeiture_account->id)}}" class="btn btn-danger btn-xs"><i class="fas fa-trash-alt "></i></a>
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

<!-- START EMPLOYEE BATCH UPLOAD MODAL -->
<div class="modal fade" id="modal-default">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Forfeiture Account Bacth Upload</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="{{route('store_forfeiture_accounts_batch_upload')}}" method="post" enctype="multipart/form-data">
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
<!-- END EMPLOYEE BATCH UPLOAD MODAL -->
@endsection

@section('customjs')
{{-- <script src="http://www.jqueryscript.net/demo/jQuery-Plugin-To-Convert-HTML-Table-To-CSV-tabletoCSV/jquery.tabletoCSV.js"></script> --}}

  <script>

   $(document).ready( function(){

    $('.select2bs4').select2({
      theme: 'bootstrap4',
    });

   // $('#pf-interest').DataTable({
      //"info": true,
      //"autoWidth": false,
      /// scrollX:'50vh',
       // scrollY:'50vh',
       // scrollCollapse: true,
    //});
   });

    </script>
    <script>
        function exportToExcel(tableID, filename){
            // var staff_code = $('#staff_code').val();
          //  console.log(staff_code);
        //    var first_name = $('#first_name').val();
        //    var last_name = $('#last_name').val();
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

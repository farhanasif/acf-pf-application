
@extends('master')
@section('content')
      <!-- Content Wrapper. Contains page content -->
      
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1>Provident Fund Report</h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                  <li class="breadcrumb-item active">Provident Fund Report</li>
                </ol>
              </div>
            </div>
          </div><!-- /.container-fluid -->
        </section>
    
        <!-- Main content -->
        <section class="content">
    
          <!-- general form elements disabled -->
          <div class="card card-secondary">
                <div class="card-header">
                <h3 class="card-title">Select month range to continue</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                <form role="form">
                    <div class="row">
                    <div class="col-sm-6">
                        <!-- select -->
                        <div class="form-group">
                        <label>From Month</label>
                        <select class="custom-select" id="from_date">
                            <option value="2017-10-26 00:00:00">August'2017</option>
                            <option value="2017-09-01 00:00:00">September'2017</option>
                            <option value="2017-10-26 00:00:00">October'2017</option>
                            <option value="2017-11-01 00:00:00">November'2017</option>
                            <option value="2017-12-01 00:00:00">December'2017</option>
                        </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                        <label>To Month</label>
                        <select class="custom-select" id="to_date">
                            <option value="2017-10-26 23:59:59">August'2017</option>
                            <option value="2017-09-01 23:59:59">September'2017</option>
                            <option value="2017-10-26 23:59:59">October'2017</option>
                            <option value="2017-11-01 23:59:59">November'2017</option>
                            <option value="2017-12-01 23:59:59">December'2017</option>
                        </select>
                        </div>
                    </div>
                    </div>
    
                </form>
                </div>
                <!-- /.card-body -->
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" id="generate" class="btn btn-success">Generate</button>
                    <button type="submit" id="download" class="btn btn-info">Download</button>
                    <button type="submit" class="btn btn-default float-right">Back</button>
                </div>
                <!-- /.card-footer -->
            </div>
            <!-- /.card -->
            <!-- Default box -->
          <div class="card card-success card-outline">
            <div class="card-header">
              <h3 class="card-title">Report details</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Third Part</th>
                  <th>First Name</th>
                  <th>Last Name</th>
                  <th>Category</th>
                  <th>Level</th>
                  <th>Entry Date</th>
                  <th>Contract<br />Start Date</th>
                  <th>End Date</th>
                  <th>Workplace</th>
                  <th>Month of Payment</th>
                  <th>Basic Salary</th>
                  <th>Gross Salary</th>
                  <th>Employee</th>
                  <th>ACF</th>
                  <th>Total</th>
                </tr>
                </thead>
                <tbody>
    
                </tbody>
                <!-- <tfoot>
                <tr>
                  <th>Third Part</th>
                  <th>First Name</th>
                  <th>Last Name</th>
                  <th>Category</th>
                  <th>Level</th>
                  <th>Entry Date</th>
                  <th>Contract<br />Start Date</th>
                  <th>End Date</th>
                  <th>Workplace</th>
                  <th>Month of Payment</th>
                  <th>Basic Salary</th>
                  <th>Gross Salary</th>
                  <th>Employee</th>
                  <th>ACF</th>
                  <th>Total</th>
                </tr>
                </tfoot> -->
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </section>
        <!-- /.content -->
@endsection
@section('customjs')
{{--   
     <script>
  $(function () {
    // $("#example1").DataTable();
    $('#example1').DataTable({
      //    "paging": true,
      //   // "lengthChange": false,
      // // "searching": false,
      //   "ordering": true,
      // "info": true,
      // "autoWidth": false,
      // scrollX:'50vh',
      // scrollY:'50vh',
      // scrollCollapse: true,
        "info": true,
        "autoWidth": false,
        scrollX:'50vh', 
        scrollY:'50vh',
        scrollCollapse: true,
    });

    $('.input-daterange').datepicker({});
    
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

  });
</script>  --}}

<script>
  var table;
  $(function () {
    // table = $("#example1").DataTable({
    //     "info": true,
    //     "autoWidth": false,
    //     scrollX:'50vh',
    //     scrollY:'50vh',
    //     scrollCollapse: true,
    // });

    $( "#generate" ).click(function() {
        from_date = $('#from_date').val();
        to_date = $('#to_date').val();

        //
        $.ajax({
            type: 'GET',
            url: './get-fund-data',
            data: {
                from_date: from_date,
                to_date: to_date
            },
            dataType: 'json',
            success: function (data) {
                console.log(data);
                table.destroy();
                $("#example1 thead").empty();
                $("#example1 tbody").empty();
                $("#example1 thead").append('<tr>'+
                    '<th>Third Part</th>'+
                    '<th>First Name</th>'+
                    '<th>Last Name</th>'+
                    '<th>Category</th>'+
                    '<th>Level</th>'+
                    '<th>Entry Date</th>'+
                    '<th>Contract<br />Start Date</th>'+
                    '<th>End Date</th>'+
                    '<th>Workplace</th>'+
                    '<th>Month<br />of Payment</th>'+
                    '<th>Basic Salary</th>'+
                    '<th>Gross Salary</th>'+
                    '<th>Employee</th>'+
                    '<th>ACF</th>'+
                    '<th>Total</th>'+
                '</tr>');

                $.each(data, function(index, element) {
                $("#example1 tbody").append("<tr>"
                        +"<td>"+element.staff_code+"</td>"
                        +"<td>"+element.first_name+"</td>"
                        +"<td>"+element.last_name+"</td>"
                        +"<td>"+element.category+"</td>"
                        +"<td>"+element.level+"</td>"
                        +"<td>"+element.joining_date+"</td>"
                        +"<td>"+element.joining_date+"</td>"
                        +"<td>"+element.ending_date+"</td>"
                        +"<td>"+element.work_place+"</td>"
                        +"<td>"+element.PaymentMonth+"</td>"
                        +"<td>"+element.basic_salary+"</td>"
                        +"<td>"+element.gross_salary+"</td>"
                        +"<td>"+element.own_pf+"</td>"
                        +"<td>"+element.organization_pf+"</td>"
                        +"<td>"+element.total_pf+"</td>"
                        +"</tr>");
                });

                table = $('#example1').DataTable({
                    "info": true,
                    "autoWidth": false,
                    scrollX:'50vh',
                    scrollY:'50vh',
                    scrollCollapse: true,
                });
            }
        });

        alert( "Handler for .click() called. - "+from_date );
    });

    $( "#download" ).click(function() {
        from_date = $('#from_date').val();
        to_date = $('#to_date').val();

        //
        alert( "Handler for download .click() called." );
    });
  });
</script>

@endsection

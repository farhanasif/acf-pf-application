@extends('master')

@section('content')
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Ledger Report</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
              <li class="breadcrumb-item active">Ledger Report
              </li>
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
                        <option value="2019-01-01">January'2019</option>
                        <option value="2019-02-01">February'2019</option>
                        <option value="2019-03-01">March'2019</option>
                        <option value="2019-04-01">April'2019</option>
                        <option value="2019-05-01">May'2019</option>
                        <option value="2019-06-01">June'2019</option>
                    </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                    <label>To Month</label>
                    <select class="custom-select" id="to_date">
                        <option value="2019-01-31">January'2019</option>
                        <option value="2019-02-28">February'2019</option>
                        <option value="2019-03-31">March'2019</option>
                        <option value="2019-04-30">April'2019</option>
                        <option value="2019-05-31">May'2019</option>
                        <option value="2019-06-30">June'2019</option>
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
          <h3 class="card-title">Ledger Report Details</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div style="overflow-x: auto;">
                <table id="example1" class="table table-bordered table-striped table-sm">
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
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </section>
@endsection
@section('customjs')
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
        $("#example1 thead").empty();
        $("#example1 tbody").empty();
        $( "#generate" ).click(function() {
            from_date = $('#from_date').val();
            to_date = $('#to_date').val();
            //
            $.ajax({
                type: 'GET',
                url: './ledger-report',
                data: {
                    from_date: from_date,
                    to_date: to_date
                },
                dataType: 'json',
                success: function (data) {
                    //console.log(data[1131]);
                    //table.destroy();
                    $("#example1 thead").empty();
                    $("#example1 tbody").empty();
                    var column_length = (Object.keys(data[0]).length);
                    var columns = Object.keys(data[0]);
                    var thead = '';
                    var thead_total = '';
                    var thead_total_value = '';
                    var data_length = data.length - 1;
                    //console.log(columns[0]);
                    //-----HEADER PART-------///////////
                    //-----HEADER PART-------///////////
                    //-----HEADER PART-------///////////
                    for(i = 0; i < column_length; i++){
                        var head_name = columns[i];
                        head_name = head_name.replace("_"," ");
                        if(i > 4) thead_total = thead_total+'<th style="text-align: center;">Total</th>';
                        else thead_total = thead_total+'<th></th>';
                        thead = thead+'<th style="text-align: center;">'+head_name+'</th>';
                        if(i > 4) thead_total_value = thead_total_value+'<th style="text-align: center;">'+numberWithCommas(data[data_length][columns[i]])+'</th>';
                        else thead_total_value = thead_total_value+'<th></th>';
                    }
                    $("#example1 thead").append('<tr class="table-primary">'+
                    thead_total+
                    '</tr>');
                    $("#example1 thead").append('<tr class="table-danger">'+
                    thead_total_value+
                    '</tr>');
                    $("#example1 thead").append('<tr class="table-warning">'+
                    thead+
                    '</tr>');
                    //----------TBODY PART-----//////////
                    //----------TBODY PART-----//////////
                    //----------TBODY PART-----//////////
                    $.each(data, function(index, element) {
                        //console.log(element);
                        var tbody = '';
                        if(element.staff_code == 'Total'){}
                        else{
                            for(i = 0; i < column_length; i++){
                                if(i < 1){
                                    tbody = tbody+'<td class="table-dark" style="text-align: center;">'+element[columns[i]]+'</td>';
                                }
                                else if(i > 0 && i <5){
                                    tbody = tbody+'<td class="table-info" style="text-align: center;">'+element[columns[i]]+'</td>';
                                }
                                else{
                                    tbody = tbody+'<td style="text-align: center;">'+numberWithCommas(element[columns[i]])+'</td>';
                                }
                            }
                            console.log(tbody);
                        }
                        $("#example1 tbody").append("<tr>"
                            +tbody
                        +"</tr>");
                    });
                    // $("#example1 thead").append('<tr>'+
                    //     '<th>Third Part</th>'+
                    //     '<th>First Name</th>'+
                    //     '<th>Last Name</th>'+
                    //     '<th>Category</th>'+
                    //     '<th>Level</th>'+
                    //     '<th>Entry Date</th>'+
                    //     '<th>Contract<br />Start Date</th>'+
                    //     '<th>End Date</th>'+
                    //     '<th>Workplace</th>'+
                    //     '<th>Month<br />of Payment</th>'+
                    //     '<th>Basic Salary</th>'+
                    //     '<th>Gross Salary</th>'+
                    //     '<th>Employee</th>'+
                    //     '<th>ACF</th>'+
                    //     '<th>Total</th>'+
                    // '</tr>');
                    // $.each(data, function(index, element) {
                    // $("#example1 tbody").append("<tr>"
                    //         +"<td>"+element.staff_code+"</td>"
                    //         +"<td>"+element.first_name+"</td>"
                    //         +"<td>"+element.last_name+"</td>"
                    //         +"<td>"+element.category+"</td>"
                    //         +"<td>"+element.level+"</td>"
                    //         +"<td>"+element.joining_date+"</td>"
                    //         +"<td>"+element.joining_date+"</td>"
                    //         +"<td>"+element.ending_date+"</td>"
                    //         +"<td>"+element.work_place+"</td>"
                    //         +"<td>"+element.PaymentMonth+"</td>"
                    //         +"<td>"+element.basic_salary+"</td>"
                    //         +"<td>"+element.gross_salary+"</td>"
                    //         +"<td>"+element.own_pf+"</td>"
                    //         +"<td>"+element.organization_pf+"</td>"
                    //         +"<td>"+element.total_pf+"</td>"
                    //         +"</tr>");
                    // });
                    // table = $('#example1').DataTable({
                    //     "info": true,
                    //     "autoWidth": false,
                    //     scrollX:'50vh',
                    //     scrollY:'50vh',
                    //     scrollCollapse: true,
                    // });
                }
            });
            //alert( "Handler for .click() called. - "+from_date );
        });
        $( "#download" ).click(function() {
            from_date = $('#from_date').val();
            to_date = $('#to_date').val();
            //
            alert( "Handler for download .click() called." );
        });
    });
    function numberWithCommas(number) {
        //return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        const fixedNumber = Number.parseFloat(number).toFixed(2);
        return String(fixedNumber).replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }
</script>
@endsection

@extends('master')
@section('customcss')
  <link rel="stylesheet" href="{{ asset('css/spin.css') }}">
@endsection
@section('content')

    <style>
        tr.selected td {
            background-color:coral !important;
        }
        .selected {
            background-color: coral;
        }
        .first-col {
            text-align: center; background-color: #212529; color: #fff;
        }
        .general-col {
            text-align: center; background-color: #bee5eb; color: #000;
        }
    </style>
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
            <h3 class="card-title">Select filter to continue</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
            <form role="form">
                <div class="row">
                <div class="col-md-3">
                    <!-- select -->
                    <div class="form-group">
                    <label>From Month</label>
                    <select class="custom-select select2bs4" id="from_date">
                        <option value="">--select--</option>

                        @foreach ($lreport as $data)
                            <option value="{{$data->deposit_date}}"> {{$data->month_name}}</option>
                        @endforeach

                    </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                    <label>To Month</label>
                    <select class="custom-select select2bs4" id="to_date">
                        <option value="">--select--</option>

                        @foreach ($lreport as $data)
                            <option value="{{$data->deposit_date}}"> {{$data->month_name}}</option>
                        @endforeach

                    </select>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                    <label>Position</label>
                    <select class="custom-select select2bs4" id="work_position">
                        <option value="-1">--select--</option>
                        @foreach ($positions as $position)
                            <option value="{{$position->position_name}}">{{$position->position_name}}</option>
                        @endforeach
                    </select>
                    </div>
                </div>

                <div class="col-md-3">
                    <!-- select -->
                    <div class="form-group">
                    <label>Department Code</label>
                    <select class="custom-select select2bs4" id="work_department">
                        <option value="-1">--select--</option>
                        @foreach ($departments as $department)
                            <option value="{{$department->department_code}}">{{$department->department_code}}</option>
                        @endforeach
                    </select>
                    </div>
                </div>

                </div>

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                        <label>Sub Location</label>
                        <select class="custom-select select2bs4" id="work_sublocation">
                            <option value="-1">--select--</option>
                            @foreach ($subLocations as $subLocation)
                                <option value="{{$subLocation->sub_location_name}}">{{$subLocation->sub_location_name}}</option>
                            @endforeach
                        </select>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                        <label>Category</label>
                        <select class="custom-select select2bs4" id="work_category">
                            <option value="-1">--select--</option>
                            @foreach ($categories as $category)
                                <option value="{{$category->category_name}}">{{$category->category_name}}</option>
                            @endforeach
                        </select>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <!-- select -->
                        <div class="form-group">
                        <label>Level</label>
                        <select class="custom-select select2bs4" id="work_level">
                            <option value="-1">--select--</option>
                            @foreach ($levels as $level)
                                <option value="{{$level->level_name}}">{{$level->level_name}}</option>
                            @endforeach
                        </select>
                        </div>
                    </div>


                    <div class="col-md-3">
                        <!-- select -->
                        <div class="form-group">
                        <label>Work Place</label>
                        <select class="custom-select select2bs4" id="work_place">
                            <option value="-1">--select--</option>
                            @foreach ($work_places as $work_place)
                                <option value="{{$work_place->work_place_name}}">{{$work_place->work_place_name}}</option>
                            @endforeach
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
            <div id='table-cont' style="max-height: 500px !important; overflow-y: auto; overflow-x: scroll; max-width: 100%;">
                <table id="example1" class="table table-sm">
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
                </table>
            </div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </section>
@endsection
@section('customjs')
<script src="http://www.jqueryscript.net/demo/jQuery-Plugin-To-Convert-HTML-Table-To-CSV-tabletoCSV/jquery.tabletoCSV.js"></script>
<script>
    var table;
    $("tr").click(function() {
            console.log('clicked');
            $(this).addClass('selected').siblings().removeClass("selected");
    });
    $(function () {

        var tableCont = document.querySelector('#table-cont');
        function scrollHandle (e){
            var scrollTop = this.scrollTop;
            this.querySelector('thead').style.transform = 'translateY(' + scrollTop + 'px)';
        }

        tableCont.addEventListener('scroll',scrollHandle);

        $("#example1 thead").empty();
        $("#example1 tbody").empty();
        $( "#generate" ).click(function() {
            $('#generate').attr('disabled', true);
    	    $('#generate').addClass('loading-bar');
            //------params-------------///
            from_date = $('#from_date').val();
            to_date = $('#to_date').val();
            work_position = $('#work_position').val();
            work_department = $('#work_department').val();
            work_sublocation = $('#work_sublocation').val();
            work_category = $('#work_category').val();
            work_level = $('#work_level').val();
            work_place = $('#work_place').val();
            //------params-------------///
            $("#example1 thead").empty();
            $("#example1 tbody").empty();
            //
            $.ajax({
                type: 'GET',
                url: './ledger-report',
                data: {
                    from_date: from_date,
                    to_date: to_date,
                    work_position: work_position,
                    work_department: work_department,
                    work_sublocation: work_sublocation,
                    work_category: work_category,
                    work_level: work_level,
                    work_place: work_place
                },
                dataType: 'json',
                success: function (data) {
                    $('#generate').attr('disabled', false);
    	            $('#generate').removeClass('loading-bar');
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
                        if(i > 4) thead_total = thead_total+'<td style="text-align: center; font-weight:bold">Total</td>';
                        else thead_total = thead_total+'<td></td>';
                        thead = thead+'<td style="text-align: center;font-weight:bold">'+head_name+'</td>';
                        if(i > 4) thead_total_value = thead_total_value+'<td style="text-align: center;font-weight:bold">'+numberWithCommas(data[data_length][columns[i]])+'</td>';
                        else thead_total_value = thead_total_value+'<td></td>';
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
                                    tbody = tbody+'<td class="first-col">'+element[columns[i]].slice(-4)+'</td>';
                                }
                                else if(i > 0 && i <5){
                                    tbody = tbody+'<td class="general-col">'+element[columns[i]]+'</td>';
                                }
                                else{
                                    tbody = tbody+'<td style="text-align: center;">'+numberWithCommas(element[columns[i]])+'</td>';
                                }
                            }
                            //console.log(tbody);
                        }
                        if(element[columns[column_length -1]] < 1){
                            //console.log('Found 0: '+element[columns[0]]);
                        }else{
                            $("#example1 tbody").append("<tr onclick=\"var s = this.parentNode.querySelector('tr.selected'); s && s.classList.remove('selected'); this.classList.add('selected');\">"
                                +tbody
                            +"</tr>");
                        }

                    });
                }
            });
            //alert( "Handler for .click() called. - "+from_date );
        });
        $( "#download" ).click(function() {
            $("#example1").tableToCSV();
            //tableToExcel('example1', 'SHEET1')
        });
    });
    function numberWithCommas(number) {
        //return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        const fixedNumber = Number.parseFloat(number).toFixed(2);
        return String(fixedNumber).replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }
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
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    });
</script>
@endsection

@extends('master')

@section('content')
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Installment Report</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
              <li class="breadcrumb-item active">Loan Installment Report
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
                    <div class="col-sm-3">
                        <div class="form-group">
                        <label>&nbsp;&nbsp; From Month</label>
                          <div class="col-md-12 col-sm-12">
                             <input type="text" class="form-control" name="from_date2" placeholder="Start Date" id="from_data">
                          </div>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="form-group">
                        <label>&nbsp;&nbsp; To Month</label>
                          <div class="col-md-12 col-sm-12">
                             <input type="text" class="form-control" name="to_date2" placeholder="End Date" id="to_data">
                          </div>
                        </div>
                    </div>

                <div class="col-md-3">
                    <div class="form-group">
                    <label>Position</label>
                    <select class="custom-select select2bs4" id="position">
                        <option value="">--select--</option>
                        <?php foreach ($info['position'] as $pos) { ?>
                            <option value="{{ $pos->position_name }}">{{ $pos->position_name}}</option>
                         <?php } ?>

                    </select>
                    </div>
                </div>

                <div class="col-md-3">
                    <!-- select -->
                    <div class="form-group">
                    <label>Department Code</label>
                    <select class="custom-select select2bs4" id="department_code">
                        <option value="">--select--</option>
                        <?php foreach ($info['department'] as $depart) { ?>
                            <option value="{{ $depart->department_code }}">{{ $depart->department_code}}</option>
                         <?php } ?>

                    </select>
                    </div>
                </div>

                </div>

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                        <label>Base</label>
                        <select class="custom-select select2bs4" id="base">
                            <option value="">--select--</option>
                            <?php foreach ($info['base'] as $bas) { ?>
                                <option value="{{ $bas->base_name }}">{{ $bas->base_name}}</option>
                             <?php } ?>
                        </select>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                        <label>Category</label>
                        <select class="custom-select select2bs4" id="category">
                            <option value="">--select--</option>
                            <?php foreach ($info['category'] as $cat) { ?>
                                <option value="{{ $cat->category_name }}">{{ $cat->category_name}}</option>
                             <?php } ?>
                        </select>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <!-- select -->
                        <div class="form-group">
                        <label>Level</label>
                        <select class="custom-select select2bs4" id="level">
                            <option value="">--select--</option>
                            <?php foreach ($info['level'] as $lav) { ?>
                                <option value="{{ $lav->level_name }}">{{ $lav->level_name}}</option>
                             <?php } ?>
                        </select>
                        </div>
                    </div>


                    <div class="col-md-3">
                        <!-- select -->
                        <div class="form-group">
                        <label>Work Place</label>
                        <select class="custom-select select2bs4" id="work_place">
                            <option value="">--select--</option>
                            <?php foreach ($info['work_place'] as $work) { ?>
                                <option value="{{ $work->work_place_name }}">{{ $work->work_place_name}}</option>
                             <?php } ?>
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
                <button type="submit" class="btn btn-default float-right">Back</button>
            </div>
            <!-- /.card-footer -->
        </div>
        <!-- /.card -->
        <!-- Default box -->
      <div class="card card-success card-outline">
        <div class="card-header" style="">
          <h3 class="card-title" style="width: 50%;float: left;margin-top: 10px;">Installment Report Details</h3>
          <button style="float: right;" type="submit" onclick="downloadExcel('loan_installment')" class="btn btn-info">Excel Download</button>
        </div>
<!--         <div class="card-header" style="width: 45%;float: right;">
            <button type="submit" id="download" class="btn btn-info">Download</button>
        </div> -->
        <!-- /.card-header -->
        <div class="card-body">
            <div style="overflow-x: auto;">
                <table id="loan_installment" class="table table-bordered table-striped table-sm">
                    <thead>
                    <tr>
                    <th>SI</th>
                    <th>Staff Code</th>
                    <th>Name</th>
                    <th>Position</th>
                    <th>Department Code</th>
                    <th>Level</th>
                    <th>Base</th>
                    <th>Workplace</th>
                    <th>Amount</th>
                    <th>Date</th>
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
            from_date = $('#from_data').val();
            // console.log(from_date);
            to_date = $('#to_data').val();
            position = $('#position').val();
            base = $('#base').val();
            work_place = $('#work_place').val();
            category = $('#category').val();
            department_code = $('#department_code').val();
            level = $('#level').val();
            console.log(level);
            var token = "{{ csrf_token() }}";
            var url_data = "{{ url('/loan_installment_data') }}";
            //
            $.ajax({
                type: 'GET',
                url: url_data,
                data: {
                    _token: token,
                    from_date: from_date,
                    to_date: to_date,
                    position: position,
                    base: base,
                    work_place: work_place,
                    category: category,
                    department_code: department_code,
                    level: level
                },
                dataType: 'json',
                success: function (data) {
                    var trHTML = '';
                        $.each(data, function (i, item) {
                            trHTML += '<tr><td>' + (i+1)
                                    + '</td><td>' + item.staff_code
                                    + '</td><td>' + item.first_name + ' ' + item.last_name
                                    + '</td><td>' + item.position
                                    + '</td><td>' + item.department_code
                                    + '</td><td>' + item.level
                                    + '</td><td>' + item.base
                                    + '</td><td>' + item.work_place
                                    + '</td><td>' + item.payment
                                    + '</td><td>' + item.pay_date
                                    +'</td></tr>';
                        });
                    $('#loan_installment').append(trHTML);
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
    function downloadExcel(loan_installment,filename='loan_installment_data'){
        var downloadLink;
        var dataType = 'application/vnd.ms-excel';
        var tableSelect = document.getElementById(loan_installment);
        var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');

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
<script>
$(document).ready(function() {
      $('.select2bs4').select2({
        theme: 'bootstrap4',
      });
  $(function() {
     $( "#from_data" ).datepicker({
          dateFormat: "YYYY-MM-DD HH:mm:ss",
          orientation: "bottom left"
     });
    $( "#to_data" ).datepicker({
          dateFormat: "YYYY-MM-DD HH:mm:ss",
          orientation: "bottom left"
     });
    });
  });
</script>
@endsection

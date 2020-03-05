<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AAH | Provident Fund App</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('theme/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- overlayScrollbars -->
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('theme/plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
  <link rel="stylesheet" href="{{ asset('theme/dist/css/adminlte.min.css') }}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-dark navbar-success">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="javascript:void(0);" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="javascript:void(0);" class="nav-link">Contact</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-user"></i>
          <span class="badge badge-danger navbar-badge">3</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="{{ asset('theme/dist/img/user1-128x128.jpg')}}" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  {{ Auth::user()->name }}
                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">{{ Auth::user()->email }}</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> Administrator</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <!-- <a href="{{ url('/logout') }}" class="dropdown-item dropdown-footer">LogOut</a> -->
            <a class="dropdown-item" href="{{ route('logout') }}"
               onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
            </a>
          
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="{{ asset('theme/dist/img/AdminLTELogo.png') }}"
           alt="AdminLTE Logo"
           class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">PF APP</span>
    </a>

    <!-- Sidebar -->
    @include('includes.sidenavbar')
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Ledger Report</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Page Title</li>
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
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 1.0.2
    </div>
    <strong>Copyright &copy; 2020-2021 <a href="https://www.actioncontrelafaim.org/en/">ACTION CONTRE LA FAIM</a>.</strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ asset('theme/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('theme/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- DataTables -->
<script src="{{ asset('theme/plugins/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ asset('theme/plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('theme/dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('theme/dist/js/demo.js') }}"></script>
<!-- page script -->
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
</body>
</html>
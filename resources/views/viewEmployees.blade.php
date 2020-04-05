
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
        <a href="../../index3.html" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
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
              <img src="{{ asset('theme/dist/img/user1-128x128.jpg') }}" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Md Khalil Ahmed
                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">test@gmail.com</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> Administrator</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">LogOut</a>
        </div>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="../../index3.html" class="brand-link">
      <img src="{{ asset('theme/dist/img/AdminLTELogo.png') }}"
           alt="AdminLTE Logo"
           class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">PF APP</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('theme/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Samun Chowdhury</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Employee Setup
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Employees</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add New Employee</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tree"></i>
              <p>
                Master Data
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Offices</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>PF Calculations</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Time Schedule</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Duration</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Alerts</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Reports
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./report" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dummy Report</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Balance Sheet</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Loan Statement</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#  " class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>General Provident Fund</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-envelope"></i>
              <p>
                Loan Management
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Loans</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Create Loan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Adust Loan</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Reconciliation
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="../examples/invoice.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Loan Disburse</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-header">MISCELLANEOUS</li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-file"></i>
              <p>Documentation</p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>All Employees</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">All Employees</li>
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
            <h3 class="card-title">Filters</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
            <form role="form" method="POST" action="http://localhost/go/acf-pf-application/public/index.php/allemployees">
                @csrf
                <div class="row">
                <div class="col-sm-6">
                    <!-- select -->
                    <div class="form-group">
                    <label>Position</label>
                    <select name="position" id="position" class="form-control select2bs4">
                        <option value="-1">--select--</option>
                        @foreach ($positions as $position)
                            <option value="{{$position->position_name}}">{{$position->position_name}}</option>
                        @endforeach
                    </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                    <label>Category</label>
                    <select name="category" id="category" class="form-control select2bs4">
                        <option value="-1">--select--</option>
                        @foreach ($categories as $category)
                            <option value="{{$category->category_name}}">{{$category->category_name}}</option>
                        @endforeach
                    </select>
                    </div>
                </div>
                </div>
                <div class="card-footer">
                    <button type="submit" id="generate" class="btn btn-success">Generate</button>
                </div>
            </form>
            </div>
            {{-- <!-- /.card-body -->
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="submit" id="generate" class="btn btn-success">Generate</button>
                <button type="submit" id="download" class="btn btn-info">Download</button>
                <button type="submit" class="btn btn-default float-right">Back</button>
            </div>
            <!-- /.card-footer --> --}}
        </div>
        <!-- /.card -->
        <!-- Default box -->
      <div class="card card-success card-outline">
        <div class="card-header">
          <h3 class="card-title">All Employee details</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>SL</th>
              <th>Staff Code</th>
              <th>Name</th>
              <th>Position</th>
              <th>Category</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($employees as $employee)
                    <tr>
                        <td>1</td>
                        <td>{{ $employee->staff_code }}</td>
                        <td>{{ $employee->first_name }} {{ $employee->last_name}}</td>
                        <td>{{ $employee->position }}</td>
                        <td>{{ $employee->category }}</td>
                    </tr>
                @endforeach
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
      console.log('loaded');
    // table = $("#example1").DataTable({
    //     "info": true,
    //     "autoWidth": false,
    //     scrollX:'50vh',
    //     scrollY:'50vh',
    //     scrollCollapse: true,
    // });

    // $( "#generate" ).click(function() {
    //     from_date = $('#from_date').val();
    //     to_date = $('#to_date').val();

    //     //
    //     $.ajax({
    //         type: 'GET',
    //         url: './get-fund-data',
    //         data: {
    //             from_date: from_date,
    //             to_date: to_date
    //         },
    //         dataType: 'json',
    //         success: function (data) {
    //             console.log(data);
    //             table.destroy();
    //             $("#example1 thead").empty();
    //             $("#example1 tbody").empty();
    //             $("#example1 thead").append('<tr>'+
    //                 '<th>Third Part</th>'+
    //                 '<th>First Name</th>'+
    //                 '<th>Last Name</th>'+
    //                 '<th>Category</th>'+
    //                 '<th>Level</th>'+
    //                 '<th>Entry Date</th>'+
    //                 '<th>Contract<br />Start Date</th>'+
    //                 '<th>End Date</th>'+
    //                 '<th>Workplace</th>'+
    //                 '<th>Month<br />of Payment</th>'+
    //                 '<th>Basic Salary</th>'+
    //                 '<th>Gross Salary</th>'+
    //                 '<th>Employee</th>'+
    //                 '<th>ACF</th>'+
    //                 '<th>Total</th>'+
    //             '</tr>');

    //             $.each(data, function(index, element) {
    //             $("#example1 tbody").append("<tr>"
    //                     +"<td>"+element.staff_code+"</td>"
    //                     +"<td>"+element.first_name+"</td>"
    //                     +"<td>"+element.last_name+"</td>"
    //                     +"<td>"+element.category+"</td>"
    //                     +"<td>"+element.level+"</td>"
    //                     +"<td>"+element.joining_date+"</td>"
    //                     +"<td>"+element.joining_date+"</td>"
    //                     +"<td>"+element.ending_date+"</td>"
    //                     +"<td>"+element.work_place+"</td>"
    //                     +"<td>"+element.PaymentMonth+"</td>"
    //                     +"<td>"+element.basic_salary+"</td>"
    //                     +"<td>"+element.gross_salary+"</td>"
    //                     +"<td>"+element.own_pf+"</td>"
    //                     +"<td>"+element.organization_pf+"</td>"
    //                     +"<td>"+element.total_pf+"</td>"
    //                     +"</tr>");
    //             });

    //             table = $('#example1').DataTable({
    //                 "info": true,
    //                 "autoWidth": false,
    //                 scrollX:'50vh',
    //                 scrollY:'50vh',
    //                 scrollCollapse: true,
    //             });
    //         }
    //     });

    //     alert( "Handler for .click() called. - "+from_date );
    // });

    // $( "#download" ).click(function() {
    //     from_date = $('#from_date').val();
    //     to_date = $('#to_date').val();

    //     //
    //     alert( "Handler for download .click() called." );
    // });
  });
</script>
</body>
</html>

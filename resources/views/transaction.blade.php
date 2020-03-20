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
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="{{ asset('theme/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
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
                                <img src="{{ asset('theme/dist/img/user1-128x128.jpg') }}" alt="User Avatar"
                                    class="img-size-50 mr-3 img-circle">
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
                <img src="{{ asset('theme/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">PF APP</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{ asset('theme/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                            alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">Samun Chowdhury</a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
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
                            <h1>Bank Reconciliation</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Bank Book</li>
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
                        <h3 class="card-title">Select month to continue</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form role="form">
                            <div class="row">
                                <div class="col-sm-6">
                                    <!-- select -->
                                    <div class="form-group">
                                        <label>Select Month</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="far fa-calendar-alt"></i>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control float-right" id="from_date">
                                        </div>
                                        {{-- <input type="text" class="form-control" placeholder="yyyy-mm-dd" id="from_date"> --}}
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
                        <button type="submit" id="addnewtransaction" class="btn btn-outline-success float-right" data-toggle="modal" data-target="#modal-default">Add a
                            new Transaction</button>
                    </div>
                    <!-- /.card-footer -->
                </div>
                <!-- /.card -->
                <!-- Default box -->
                <div class="card card-success card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Bank Reconciliation</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <h5 style="text-align: center">Bank Book</h5>
                        <br />
                        <div style="overflow-x: auto;">
                            <table id="example1" class="table table-bordered table-striped table-sm">
                                <thead>
                                    <tr>
                                        <th style="text-align: center;">Date</th>
                                        <th style="text-align: center;">Voucher No</th>
                                        <th style="text-align: center;">Description</th>
                                        <th style="text-align: center;">Cheque No</th>
                                        <th style="text-align: center;">Amount</th>
                                        <th style="text-align: center;">Account Head</th>
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
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <div class="modal fade" id="modal-default">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Add a transaction to bank book</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form role="form">
                  <div class="row">
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Transaction date</label>
                        <input type="text" class="form-control" id="transactionDate" placeholder="Enter ...">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Effective Date</label>
                        <input type="text" class="form-control" id="effectiveDate" placeholder="Enter ...">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Description</label>
                        <input type="text" class="form-control" id="description" placeholder="Enter ...">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Account head</label>
                        <select class="custom-select" id="account_head">
                          <option value="0">Select...</option>
                          {{-- <option value="2">Cash In Bank</option>
                          <option value="3">PF Settlement</option>
                          <option value="4">Deposit Amount</option> --}}
                          @foreach ($account_heads as $account_head)
                            <option value="{{ $account_head->id }}">{{ $account_head->account_head }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Voucher No</label>
                        <input type="text" class="form-control" id="voucherno" placeholder="Enter ...">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Cheque No</label>
                        <input type="text" class="form-control" id="chequeno" placeholder="Enter ...">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Amount</label>
                        <input type="number" class="form-control" id="amount" placeholder="000">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Type</label>
                        <select class="custom-select" id="transaction_type">
                          <option value="IN">CASH IN</option>
                          <option value="OUT">CASH OUT</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
              <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal" id="closeTransaction">Close</button>
                <button type="button" class="btn btn-primary" id="saveTransaction">Save changes</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

        <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
                <b>Version</b> 1.0.2
            </div>
            <strong>Copyright &copy; 2020-2021 <a href="https://www.actioncontrelafaim.org/en/">ACTION CONTRE LA
                    FAIM</a>.</strong> All rights
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js">
    </script>
    <script src="{{ asset('theme/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <!-- page script -->
    <script>
        
        $(function () {
            const Toast = Swal.mixin({
              toast: true,
              position: 'top-end',
              showConfirmButton: false,
              timer: 4000
            });

            $("#example1 thead").empty();
            $("#example1 tbody").empty();

            $('#from_date').datepicker({
                //format: "yyyy-mm-dd",
                orientation: "bottom left",
                format: "yyyy-mm",
                startView: "months", 
                minViewMode: "months"
            });

            $('#transactionDate').datepicker({
                format: "yyyy-mm-dd",
                orientation: "bottom left"
            });

            $('#effectiveDate').datepicker({
                format: "yyyy-mm-dd",
                orientation: "bottom left"
            });

            $('#saveTransaction').click(function() {

              //get the data
              var transactionDate = $('#transactionDate').val();
              var effectiveDate = $('#transactionDate').val();
              var description = $('#description').val();
              var account_head = $('#account_head').val();
              var voucherno = $('#voucherno').val();
              var chequeno = $('#chequeno').val();
              var amount = $('#amount').val();
              var type = $('#transaction_type').val();

              if(description == '' || transactionDate == '' || effectiveDate == '' || amount == '' || amount == '0' || account_head == '0'){
                Toast.fire({
                  type: 'error',
                  title: ' Please enter all fields to save the transaction'
                });
              }
              else{
                
                //save the transaction
                $.ajax({
                  type: 'GET',
                  url: './save-monthly-bank-book',
                  data: {
                      transactionDate: transactionDate,
                      effectiveDate: effectiveDate,
                      description: description,
                      account_head: account_head,
                      voucherno: voucherno,
                      chequeno: chequeno,
                      amount: amount,
                      type: type
                  },
                  dataType: 'text',
                  success: function (data) {
                    console.log(data);
                    generate_book();
                    $('#modal-default').modal('hide');
                
                    Toast.fire({
                      type: 'success',
                      title: ' Transaction successfully saved in Bank Book.'
                    });
                  }
                });
              }

              
            });

            $('#closeTransaction').click(function() {
              generate_book();
              $('#modal-default').modal('hide');
              //toastr.success('Transaction successfully saved in Bank Book.')
              Toast.fire({
                type: 'info',
                title: ' Transaction closed.'
              })
            });

            $('#generate').click(function() {
              generate_book();
            });
        });

        function generate_book(){
          from_date = $('#from_date').val();

          if(from_date == '' || from_date == undefined){
            Toast.fire({
              type: 'error',
              title: ' Please enter a date to calculate bank book for that month.'
            });
          }
          else{
            $.ajax({
              type: 'GET',
              url: './monthy-bank-book',
              data: {
                  from_date: from_date,
              },
              dataType: 'json',
              success: function (data) {
                console.log(data);
                
                $("#example1 thead").empty();
                $("#example1 tbody").empty();
                $("#example1 thead").append('<tr>'+
                    '<th style="text-align: center;">Date</th>'+
                    '<th style="text-align: center;">Voucher No</th>'+
                    '<th style="text-align: center;">Description</th>'+
                    '<th style="text-align: center;">Cheque No</th>'+
                    '<th style="text-align: center;">Amount</th>'+
                    '<th style="text-align: center;">Account Head</th>'+
                '</tr>');

                $.each(data, function(index, element) {
                  if(element.description == 'TOTAL'){
                    $("#example1 tbody").append("<tr class=\"table-info\">"
                      +"<td style=\"text-align: center;\">"+element.transaction_date+"</td>"
                      +"<td style=\"text-align: center;\">"+element.voucher_no+"</td>"
                      +"<td style=\"text-align: center;font-weight: bold;\">"+element.description+"</td>"
                      +"<td style=\"text-align: center;\">"+element.cheque_no+"</td>"
                      +"<td style=\"text-align: right;font-weight: bold;\">"+numberWithCommas(element.amount)+"</td>"
                      +"<td style=\"text-align: center;\">"+element.account_head+"</td>"
                      +"</tr>");
                  }
                  else{
                    $("#example1 tbody").append("<tr>"
                      +"<td style=\"text-align: center;\">"+element.transaction_date+"</td>"
                      +"<td style=\"text-align: center;\">"+element.voucher_no+"</td>"
                      +"<td style=\"text-align: center;\">"+element.description+"</td>"
                      +"<td style=\"text-align: center;\">"+element.cheque_no+"</td>"
                      +"<td class=\"table-danger\" style=\"text-align: right;\">"+numberWithCommas(element.amount)+"</td>"
                      +"<td style=\"text-align: center;\">"+element.account_head+"</td>"
                      +"</tr>");
                  }
                });
              }
            });
          }
        }


        function numberWithCommas(number) {
          if(number == 0 || number == undefined){
            return '0.00';
          }
          else{
            const fixedNumber = Number.parseFloat(number).toFixed(2);
            return String(fixedNumber).replace(/\B(?=(\d{3})+(?!\d))/g, ",");
          }
        }
    </script>
</body>

</html>

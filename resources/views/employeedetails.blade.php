
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AAH | Provident Fund App</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="https://www.actionagainsthunger.org/sites/all/themes/acf2014zen/favicon.ico" type="image/vnd.microsoft.icon" />
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
            <h1>Employee Details</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Details</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="card card-widget widget-user">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-success">
              <h3 class="widget-user-username">Md Moshiur Rahman</h3>
              <h5 class="widget-user-desc">Senior Project Officer Nutrition</h5>
            </div>
            <div class="widget-user-image">
              <img class="img-circle elevation-2" src="{{ asset('theme/dist/img/person-icon.png') }}" alt="User Avatar">
            </div>
            <div class="card-footer">
              <div class="row">
                <div class="col-sm-4 border-right">
                  <div class="description-block">
                    <h5 class="description-header">3,200 / Month</h5>
                    <span class="description-text">Provident Fund Amount</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-4 border-right">
                  <div class="description-block">
                    <h5 class="description-header">72,000</h5>
                    <span class="description-text">Total PF Amount</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-4">
                  <div class="description-block">
                    <h5 class="description-header">35,000 (1)</h5>
                    <span class="description-text">Loan Amount (Total)</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
          </div>

      <div class="card card-success card-outline">
        <div class="card-header">
          <h3 class="card-title">Account Details</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="card">
                <div class="card-header p-2">
                  <ul class="nav nav-pills">
                    <li class="nav-item"><a class="nav-link active" href="#pfaccount" data-toggle="tab">PF Account Details</a></li>
                    <li class="nav-item"><a class="nav-link" href="#loandetails" data-toggle="tab">Loan Account Details</a></li>
                    <li class="nav-item"><a class="nav-link" href="#generalinformation" data-toggle="tab">General Information</a></li>
                  </ul>
                </div><!-- /.card-header -->
                <div class="card-body">
                  <div class="tab-content">
                    <div class="active tab-pane" id="pfaccount">
                        <div class="card card-outline card-success">
                            <div class="card-header">
                              <h3 class="card-title">Provident Fund Deposits</h3>

                              <div class="card-tools">
                                <div class="input-group input-group-sm" style="width: 150px;">
                                  <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                                  <div class="input-group-append">
                                    <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0" style="height: 300px;">
                              <table class="table table-striped table-head-fixed text-nowrap">
                                <thead>
                                  <tr>
                                    <th>ID</th>
                                    <th>Date</th>
                                    <th>Employee Amount</th>
                                    <th>Employer Amount</th>
                                    <th>Total</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <td>183</td>
                                    <td>23 January, 2020</td>
                                    <td>3,200</td>
                                    <td>3,200</td>
                                    <td>6,400</td>
                                  </tr>
                                  <tr>
                                    <td>183</td>
                                    <td>23 January, 2020</td>
                                    <td>3,200</td>
                                    <td>3,200</td>
                                    <td>6,400</td>
                                  </tr>
                                  <tr>
                                    <td>183</td>
                                    <td>23 January, 2020</td>
                                    <td>3,200</td>
                                    <td>3,200</td>
                                    <td>6,400</td>
                                  </tr>
                                  <tr>
                                    <td>183</td>
                                    <td>23 January, 2020</td>
                                    <td>3,200</td>
                                    <td>3,200</td>
                                    <td>6,400</td>
                                  </tr>
                                  <tr>
                                    <td>183</td>
                                    <td>23 January, 2020</td>
                                    <td>3,200</td>
                                    <td>3,200</td>
                                    <td>6,400</td>
                                  </tr>
                                  <tr>
                                    <td>183</td>
                                    <td>23 January, 2020</td>
                                    <td>3,200</td>
                                    <td>3,200</td>
                                    <td>6,400</td>
                                  </tr>
                                  <tr>
                                    <td>183</td>
                                    <td>23 January, 2020</td>
                                    <td>3,200</td>
                                    <td>3,200</td>
                                    <td>6,400</td>
                                  </tr>
                                  <tr>
                                    <td>183</td>
                                    <td>23 January, 2020</td>
                                    <td>3,200</td>
                                    <td>3,200</td>
                                    <td>6,400</td>
                                  </tr>
                                  <tr>
                                    <td>183</td>
                                    <td>23 January, 2020</td>
                                    <td>3,200</td>
                                    <td>3,200</td>
                                    <td>6,400</td>
                                  </tr>
                                  <tr>
                                    <td>183</td>
                                    <td>23 January, 2020</td>
                                    <td>3,200</td>
                                    <td>3,200</td>
                                    <td>6,400</td>
                                  </tr>
                                  <tr>
                                    <td>183</td>
                                    <td>23 January, 2020</td>
                                    <td>3,200</td>
                                    <td>3,200</td>
                                    <td>6,400</td>
                                  </tr>
                                  <tr>
                                    <td>183</td>
                                    <td>23 January, 2020</td>
                                    <td>3,200</td>
                                    <td>3,200</td>
                                    <td>6,400</td>
                                  </tr>
                                  <tr>
                                    <td>183</td>
                                    <td>23 January, 2020</td>
                                    <td>3,200</td>
                                    <td>3,200</td>
                                    <td>6,400</td>
                                  </tr>
                                  <tr>
                                    <td>183</td>
                                    <td>23 January, 2020</td>
                                    <td>3,200</td>
                                    <td>3,200</td>
                                    <td>6,400</td>
                                  </tr>
                                  <tr>
                                    <td>183</td>
                                    <td>23 January, 2020</td>
                                    <td>3,200</td>
                                    <td>3,200</td>
                                    <td>6,400</td>
                                  </tr>

                                </tbody>
                              </table>
                            </div>
                            <!-- /.card-body -->
                          </div>
                          <div class="card card-outline card-warning">
                            <div class="card-header">
                              <h3 class="card-title">Provident Fund Interests</h3>

                              <div class="card-tools">
                                <div class="input-group input-group-sm" style="width: 150px;">
                                  <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                                  <div class="input-group-append">
                                    <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0" style="height: 300px;">
                              <table class="table table-striped table-head-fixed text-nowrap">
                                <thead>
                                  <tr>
                                    <th>ID</th>
                                    <th>Date</th>
                                    <th>Description</th>
                                    <th>Amount</th>
                                    <th>Comment</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <td>183</td>
                                    <td>23 January, 2020</td>
                                    <td>Interest for XYZ</td>
                                    <td>3,200</td>
                                    <td>NA</td>
                                  </tr>
                                  <tr>
                                    <td>183</td>
                                    <td>23 January, 2019</td>
                                    <td>Interest for XYZ</td>
                                    <td>3,200</td>
                                    <td>NA</td>
                                  </tr>


                                </tbody>
                              </table>
                            </div>
                            <!-- /.card-body -->
                          </div>
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="loandetails">
                        <div class="card card-outline card-danger">
                            <div class="card-header">
                              <h3 class="card-title">Your Loans Against Provident Fund</h3>

                              <div class="card-tools">
                                <div class="input-group input-group-sm" style="width: 150px;">
                                  <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                                  <div class="input-group-append">
                                    <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0" style="height: 300px;">
                              <table class="table table-striped table-head-fixed text-nowrap">
                                <thead>
                                  <tr>
                                    <th>ID</th>
                                    <th>Date</th>
                                    <th>Name</th>
                                    <th>Amount</th>
                                    <th>Interest</th>
                                    <th>Months</th>
                                    <th>Start Month</th>
                                    <th>End Month</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <td>183</td>
                                    <td>23 January, 2020</td>
                                    <td>Md Moshiur Rahman</td>
                                    <td><dt>50,000</dt></td>
                                    <td>2,000</td>
                                    <td>12</td>
                                    <td>1st March, 2020</td>
                                    <td>1st February, 2020</td>
                                  </tr>


                                </tbody>
                              </table>
                            </div>
                            <!-- /.card-body -->
                          </div>
                        <div class="card card-outline card-success">
                            <div class="card-header">
                              <h3 class="card-title">Loan Adjustments</h3>

                              <div class="card-tools">
                                <div class="input-group input-group-sm" style="width: 150px;">
                                  <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                                  <div class="input-group-append">
                                    <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0" style="height: 300px;">
                              <table class="table table-striped table-head-fixed text-nowrap">
                                <thead>
                                  <tr>
                                    <th>ID</th>
                                    <th>Date</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Remaining</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <td>1</td>
                                    <td>1 March, 2020</td>
                                    <td><dt>4,334</dt></td>
                                    <td class="text-success">PAID</td>
                                    <td>47,666</td>
                                  </tr>
                                  <tr>
                                    <td>2</td>
                                    <td>1 April, 2020</td>
                                    <td><dt>4,334</dt></td>
                                    <td class="text-danger">DUE</td>
                                    <td>4,3332</td>
                                  </tr>
                                  <tr>
                                    <td>3</td>
                                    <td>1 May, 2020</td>
                                    <td><dt>4,334</dt></td>
                                    <td class="text-danger">DUE</td>
                                    <td>38,998</td>
                                  </tr>
                                  <tr>
                                    <td>4</td>
                                    <td>1 June, 2020</td>
                                    <td><dt>4,334</dt></td>
                                    <td class="text-danger">DUE</td>
                                    <td>47,666</td>
                                  </tr>
                                  <tr>
                                    <td>5</td>
                                    <td>1 July, 2020</td>
                                    <td><dt>4,334</dt></td>
                                    <td class="text-danger">DUE</td>
                                    <td>47,666</td>
                                  </tr>
                                  <tr>
                                    <td>6</td>
                                    <td>1 August, 2020</td>
                                    <td><dt>4,334</dt></td>
                                    <td class="text-danger">DUE</td>
                                    <td>47,666</td>
                                  </tr>
                                  <tr>
                                    <td>7</td>
                                    <td>1 September, 2020</td>
                                    <td><dt>4,334</dt></td>
                                    <td class="text-danger">DUE</td>
                                    <td>47,666</td>
                                  </tr>
                                  <tr>
                                    <td>8</td>
                                    <td>1 October, 2020</td>
                                    <td><dt>4,334</dt></td>
                                    <td class="text-danger">DUE</td>
                                    <td>47,666</td>
                                  </tr>
                                  <tr>
                                    <td>9</td>
                                    <td>23 November, 2020</td>
                                    <td><dt>4,334</dt></td>
                                    <td class="text-danger">DUE</td>
                                    <td>47,666</td>
                                  </tr>
                                  <tr>
                                    <td>10</td>
                                    <td>23 December, 2020</td>
                                    <td><dt>4,334</dt></td>
                                    <td class="text-danger">DUE</td>
                                    <td>47,666</td>
                                  </tr>
                                  <tr>
                                    <td>11</td>
                                    <td>23 January, 2020</td>
                                    <td><dt>4,334</dt></td>
                                    <td class="text-danger">DUE</td>
                                    <td>47,666</td>
                                  </tr>
                                  <tr>
                                    <td>12</td>
                                    <td>23 February, 2020</td>
                                    <td><dt>4,334</dt></td>
                                    <td class="text-danger">DUE</td>
                                    <td>0</td>
                                  </tr>
                                </tbody>
                              </table>
                            </div>
                            <!-- /.card-body -->
                          </div>

                    </div>
                    <!-- /.tab-pane -->

                    <div class="tab-pane" id="generalinformation">
                      <form class="form-horizontal">
                        <div class="form-group row">
                          <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                          <div class="col-sm-10">
                            <input type="email" class="form-control" id="inputName" placeholder="Name">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                          <div class="col-sm-10">
                            <input type="email" class="form-control" id="inputEmail" placeholder="Email">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="inputName2" class="col-sm-2 col-form-label">Name</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputName2" placeholder="Name">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="inputExperience" class="col-sm-2 col-form-label">Experience</label>
                          <div class="col-sm-10">
                            <textarea class="form-control" id="inputExperience" placeholder="Experience"></textarea>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="inputSkills" class="col-sm-2 col-form-label">Skills</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputSkills" placeholder="Skills">
                          </div>
                        </div>
                        <div class="form-group row">
                          <div class="offset-sm-2 col-sm-10">
                            <div class="checkbox">
                              <label>
                                <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                              </label>
                            </div>
                          </div>
                        </div>
                        <div class="form-group row">
                          <div class="offset-sm-2 col-sm-10">
                            <button type="submit" class="btn btn-danger">Submit</button>
                          </div>
                        </div>
                      </form>
                    </div>
                    <!-- /.tab-pane -->
                  </div>
                  <!-- /.tab-content -->
                </div><!-- /.card-body -->
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
</script>
</body>
</html>

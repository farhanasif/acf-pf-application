
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

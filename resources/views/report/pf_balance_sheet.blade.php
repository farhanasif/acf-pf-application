@extends('master')
@section('content')
      <!-- Content Wrapper. Contains page content -->

        <!-- Content Header (Page header) -->
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1>Per Staff Balance Sharing Report</h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                  <li class="breadcrumb-item active">Staff Balance Sheet Report</li>
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
                <form role="form" action="{{ url('/print-pf-balance-sheet') }}" method="get">
                    <div class="row">
                    <div class="col-sm-4">
                        <!-- select -->
                        <div class="form-group">
                        <label> Staff Code</label>
                          <select name="staff" id="staff" class="form-control select2bs4">
                             <option value="">--select--</option>
                             <option value="0">All</option>
                              @foreach ($employee_code as $empolyee)
                                <option value="{{ $empolyee->staff_code }}">{{ sprintf('%04d', $empolyee->staff_code) }} &nbsp;&nbsp; {{ $empolyee->first_name }} {{ $empolyee->last_name }}</option>
                              @endforeach
                          </select>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group">
                        <label>&nbsp;&nbsp; From Month</label>
                          <div class="col-md-12 col-sm-12">
                             <input type="text" class="form-control" name="from_date_for_balanace" placeholder="From Date For Balance Sheet" id="from_data">
                          </div>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group">
                        <label>&nbsp;&nbsp; To Month</label>
                          <div class="col-md-12 col-sm-12">
                             <input type="text" class="form-control" name="to_date_for_balance" placeholder="To Date For Balance Sheet" id="to_data">
                          </div>
                        </div>
                    </div>
                    </div>

                    <div class="row">
                     <div class="col-md-4">
                      <div class="form-group">
                      <label>Position</label>
                        <select class="custom-select select2bs4" id="position" name="position">
                            <option value="">--select--</option>
                            <?php foreach ($info['position'] as $pos) { ?>
                                <option value="{{ $pos->position_name }}">{{ $pos->position_name}}</option>
                             <?php } ?>
                        </select>
                      </div>
                    </div>

                    <div class="col-md-4">
                    <!-- select -->
                    <div class="form-group">
                    <label>Department Code</label>
                    <select class="custom-select select2bs4" id="department_code" name="department_code">
                        <option value="">--select--</option>
                        <?php foreach ($info['department'] as $depart) { ?>
                            <option value="{{ $depart->department_code }}">{{ $depart->department_code}}</option>
                         <?php } ?>

                    </select>
                    </div>
                </div>
                <div class="col-md-4">
                        <div class="form-group">
                        <label>Base</label>
                        <select class="custom-select select2bs4" id="base" name="base">
                            <option value="">--select--</option>
                            <?php foreach ($info['base'] as $bas) { ?>
                                <option value="{{ $bas->base_name }}">{{ $bas->base_name}}</option>
                             <?php } ?>
                        </select>
                        </div>
                    </div>
                    </div>

                   <div class="row">

                    <div class="col-md-4">
                        <div class="form-group">
                        <label>Category</label>
                        <select class="custom-select select2bs4" id="category" name="category">
                            <option value="">--select--</option>
                            <?php foreach ($info['category'] as $cat) { ?>
                                <option value="{{ $cat->category_name }}">{{ $cat->category_name}}</option>
                             <?php } ?>
                        </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <!-- select -->
                        <div class="form-group">
                        <label>Level</label>
                        <select class="custom-select select2bs4" id="level" name="lebel">
                            <option value="">--select--</option>
                            <?php foreach ($info['level'] as $lav) { ?>
                                <option value="{{ $lav->level_name }}">{{ $lav->level_name}}</option>
                             <?php } ?>
                        </select>
                        </div>
                    </div>


                    <div class="col-md-4">
                        <!-- select -->
                        <div class="form-group">
                        <label>Work Place</label>
                        <select class="custom-select select2bs4" id="work_place" name="work_place"> 
                            <option value="">--select--</option>
                            <?php foreach ($info['work_place'] as $work) { ?>
                                <option value="{{ $work->work_place_name }}">{{ $work->work_place_name}}</option>
                             <?php } ?>
                        </select>
                        </div>
                    </div>

                    </div>

                </div>
                <!-- /.card-body -->
                <!-- /.card-body -->
                <div class="card-footer">
                    <a href=""><button type="submit" id="generate" class="btn btn-success">Generate</button></a>
                </div>
              </form>
                <!-- /.card-footer -->
            </div>
        </section>
        <!-- /.content -->
@endsection
@section('customjs')

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
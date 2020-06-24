@extends('master')
@section('customcss')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')

<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Employee Details</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="javascript:void()">Home</a></li>
          <li class="breadcrumb-item active">Details</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<section class="content">
  <div class="card card-widget widget-user">
      <!-- Add the bg color to the header using any of the bg-* classes -->
      <div class="widget-user-header bg-success">
      <h3 class="widget-user-username"> {{$employees->first_name.' '.$employees->last_name}}</h3>
        <h5 class="widget-user-desc"> {{$employees->position}} </h5>
      </div>
      <div class="widget-user-image">
        <img class="img-circle elevation-2" src="{{ asset('theme/dist/img/person-icon.png') }}" alt="User Avatar">
      </div>
      <div class="card-footer">
        <div class="row">
          <div class="col-sm-2 border-right">
            <div class="description-block">
              <h5 class="description-header">
                @foreach ($interests_and_pf_deposit as $item)
                  {{number_format($item->maximum_total_pf)}} Tk / Month
                @endforeach
              </h5>
              <span class="description-text">Provident Fund Amount</span>
            </div>
            <!-- /.description-block -->
          </div>
          <!-- /.col -->
          <div class="col-sm-3 border-right">
            <div class="description-block">
            <h5 class="description-header">
              @foreach ($interests_and_pf_deposit as $item)
                 {{number_format($item->total_pf_amount)}} Tk
              @endforeach

            </h5>
              <span class="description-text">Total PF Amount (without interest)</span>
            </div>
            <!-- /.description-block -->
          </div>

          <div class="col-sm-3 border-right">
            <div class="description-block">
            <h5 class="description-header">
                @if ($interests_and_pf_deposit)
                @foreach ($interests_and_pf_deposit as $item)
                {{ number_format($item->own + $item->organization+ $item->total_pf_amount) }} Tk
                @endforeach

                @else
                    0 Tk
                @endif
            </h5>
              <span class="description-text">Total PF Amount (with interest)</span>
            </div>
            <!-- /.description-block -->
          </div>

          <!-- /.col -->
          <div class="col-sm-2 border-right">
            <div class="description-block">
              @foreach ($loan_account_details as $item)
                <h5 class="description-header">
                  {{$item->loan_amount ? number_format($item->loan_amount) : '0'}} Tk
                </h5>
              @endforeach

              <span class="description-text">Loan Amount (Total)</span>
            </div>
            <!-- /.description-block -->
          </div>
          <!-- /.col -->

          <!-- /.col -->
          <div class="col-sm-2">
            <div class="description-block">
              <h5 class="description-header">
                @foreach ($interests_and_pf_deposit as $item)
                  {{number_format( ($item->own + $item->organization+ $item->total_pf_amount) * 80/100)}} Tk
                @endforeach
              </h5>
              <span class="description-text">LOAN AMOUNT(MAXIMUM)</span>
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
                        <div class="float-sm-right">
                        <button type="submit" id="pf-deposit-download" class="btn btn-success">Download Excel</button>
                        {{-- <button type="submit" class="print-pdf-pf-deposit" class="btn btn-success" >Download PDF</button> --}}
                        </div>
                      </div>
                      <!-- /.card-header -->
                      <div class="card-body table-responsive p-0" style="height: 300px;">
                        <table id="pf-deposit" class="table table-striped table-head-fixed text-nowrap">
                          <thead>
                            <tr>
                              <th  class="bg-success">SL</th>
                              <th  class="bg-success">Date</th>
                              <th  class="bg-success">Employee Amount</th>
                              <th  class="bg-success">Employer Amount</th>
                              <th  class="bg-success">Total</th>
                            </tr>
                          </thead>
                          <tbody>
                              <tr style="display:none">
                                <td colspan="4"> Staff Code:  {{ sprintf("%04d", $employees->staff_code)}}</td>
                                {{-- <td></td>
                                <td></td>
                                <td></td> --}}
                                <td rowspan=""> Full Name: {{$employees->first_name.' '.$employees->last_name}}</td>
                              </tr>
                            <?php $i=1;?>
                            @foreach ($pf_deposits as $pf_deposit)
                            <tr>
                              <td> {{$i++}} </td>
                              <td> {{ date('j F, Y', strtotime($pf_deposit->deposit_date)) }} </td>
                              <td> {{number_format($pf_deposit->own_pf)}} </td>
                              <td> {{ number_format($pf_deposit->organization_pf)}} </td>
                              <td> {{ number_format($pf_deposit->total_pf)}} </td>
                            </tr>

                            @endforeach

                          </tbody>
                        </table>
                      </div>
                      <!-- /.card-body -->
                    </div>


                    <div class="card card-outline card-warning">
                      <div class="card-header">
                        <h3 class="card-title">Provident Fund Interests</h3>
                        <button type="submit" id="pf-interest-download" class="btn btn-success float-right">Download Excel</button>

                      </div>

                      <?php if(!empty($interests_and_pf_deposit[0]->interests_id)) { ?>
                      <!-- /.card-header -->
                      <div class="card-body table-responsive p-0" style="height: 300px;">
                        <table id="pf-interest" class="table table-striped table-head-fixed text-nowrap">
                          <thead>
                            <tr>
                              <th class="bg-success">SL</th>
                              <th class="bg-success">Date</th>
                              <th class="bg-success">Interest Source</th>
                              <th class="bg-success">Own Interest</th>
                              <th class="bg-success">Organization Interest</th>
                              <th class="bg-success">Total Interest</th>
                            </tr>
                          </thead>
                          <tbody>
                              <tr style="display:none">
                                <td colspan="4"> Staff Code:  {{ sprintf("%04d", $employees->staff_code)}}</td>
                                {{-- <td></td>
                                <td></td>
                                <td></td> --}}
                                <td rowspan=""> Full Name: {{$employees->first_name.' '.$employees->last_name}}</td>
                              </tr>
                            <?php $i=1;?>
                            @foreach ($interests_and_pf_deposit as $item)
                            <tr>
                            <td>{{$i++}}</td>
                              <td>{{ date('j F, Y', strtotime($item->interest_date)) }}  </td>
                              <td> {{$item->interest_source}} </td>
                              <td> {{$item->own}} </td>
                              <td> {{$item->organization}} </td>
                              <td> {{$item->own + $item->organization }} </td>
                            </tr>
                            @endforeach


                          </tbody>
                        </table>
                      </div>
                      <!-- /.card-body -->
                      <?php }else { ?>
                        <div>
                          <p class="text-center"> No Data Found!</p>
                       </div>
                       <?php } ?>
                    </div>
              </div>
              <!-- /.tab-pane -->

              <div class="tab-pane" id="loandetails">
                           <?php if(!empty($loan_account_details[0]->id)) { ?>
                  <div class="card card-outline card-danger">
                      <div class="card-header">
                        <h3 class="card-title">Your Loans Against Provident Fund</h3>
                        <button type="submit" id="loan-against-pf-download" class="btn btn-success float-right">Download Excel</button>
                      </div>
                      <!-- /.card-header arif-->

                      <div class="card-body table-responsive p-0" style="height: 200px;">
                        <table id="loan-against-pf" class="table table-striped table-head-fixed text-nowrap">
                          <thead>
                            <tr>
                              <th  class="bg-success">SL</th>
                              <th  class="bg-success">Date</th>
                              <th  class="bg-success">Name</th>
                              <th  class="bg-success">Amount</th>
                              <th  class="bg-success">Interest</th>
                              <th  class="bg-success">Months</th>
                              <th  class="bg-success">Start Month</th>
                              <th  class="bg-success">End Month</th>
                            </tr>
                          </thead>
                          <tbody>
                              <tr style="display:none">
                                <td colspan="4"> Staff Code:  {{ sprintf("%04d", $employees->staff_code)}}</td>
                                {{-- <td></td>
                                <td></td>
                                <td></td> --}}
                                <td rowspan=""> Full Name: {{$employees->first_name.' '.$employees->last_name}}</td>
                              </tr>
                      @foreach ($loan_account_details as $item)
                        <tr>
                          <td>01</td>
                          <td> {{ date('j F, Y', strtotime($item->issue_date))}}  </td>
                          <td> {{ $item->first_name.' '.$item->last_name }} </td>
                          <td><dt> {{ $item->loan_amount }} </dt></td>
                          <td>{{$item->interest}}</td>
                          <td> {{$item->total_months}} </td>
                          <td> {{ date('j F, Y', strtotime($item->min_date))}}  </td>
                          <td> {{ date('j F, Y', strtotime($item->max_date))}}  </td>
                        </tr>
                      @endforeach

                          </tbody>
                        </table>
                      </div>
                      <!-- /.card-body -->
                    </div>

                  <div class="card card-outline card-success">
                      <div class="card-header">
                        <h3 class="card-title">Loan Adjustments</h3>
                        <button type="submit" id="loan-adjustment-download" class="btn btn-success float-right">Download Excel</button>
                      </div>
                      <!-- /.card-header -->
                      <div class="card-body table-responsive p-0" style="height: 300px;">
                        <table id="loan-adjustment" class="table table-striped table-head-fixed text-nowrap">
                          <thead>
                            <tr>
                              <th class="bg-success">SL</th>
                              <th class="bg-success">Date</th>
                              <th class="bg-success">Amount</th>
                              <th class="bg-success">Status</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr style="display:none">
                              <td colspan="4"> Staff Code:  {{ sprintf("%04d", $employees->staff_code)}}</td>
                              {{-- <td></td>
                              <td></td>
                              <td></td> --}}
                              <td rowspan=""> Full Name: {{$employees->first_name.' '.$employees->last_name}}</td>
                            </tr>
                            <?php $i=1;?>
                            @foreach ($loan_adjustments as $item)

                            <tr>
                            <td>{{$i++}}</td>
                              <td> {{ date('j F, Y', strtotime($item->pay_date,3)) }}  </td>
                              <td><dt> {{$item->payment}}  </dt></td>

                              @if ( strtoupper( $item->payment_type) == 'DUE')
                                <td class="text-danger"> {{strtoupper( $item->payment_type)}} </td>
                              @elseif(strtoupper( $item->payment_type) == 'PAID')
                                <td class="text-success"> {{strtoupper($item->payment_type) }} </td>
                              @endif

                            </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                      <!-- /.card-body -->
                    </div>

              <?php }else { ?>
                <div>
                   <p class="text-center"> No Data Found!</p>
                </div>
             <?php } ?>
              </div>

              <!-- /.tab-pane -->

              <div class="tab-pane" id="generalinformation">
              <form class="form-horizontal">
                    @csrf
                  <div class="form-group row">
                    <label for="inputStaffCode" class="col-sm-2 col-form-label">Staff Code</label>
                    <div class="col-sm-10">
                      <input type="number" class="form-control" id="staff_code" name="staff_code" placeholder="Staff Code" value="{{ sprintf("%04d", $employees->staff_code)}}">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="inputName" class="col-sm-2 col-form-label">First Name</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name" value="{{$employees->first_name}}">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="inputName" class="col-sm-2 col-form-label">Last Name</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name" value="{{$employees->last_name}}">
                    </div>
                  </div>


                  <div class="form-group row">
                    <label for="inputPosition" class="col-sm-2 col-form-label">Position</label>
                    <div class="col-sm-10">
                      <select name="position" id="position" class="form-control select2bs4">
                        @foreach ($positions as $position)
                          <option <?php echo ($employees->position == $position->position_name) ? "selected" : '' ?>  value="{{$position->position_name}}">{{$position->position_name}}</option>
                         @endforeach
                      </select>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="inputDepartment_code" class="col-sm-2 col-form-label">Department Code</label>
                    <div class="col-sm-10">
                      <select name="department_code" id="department_code" class="form-control select2bs4">
                        @foreach ($departments as $department)
                          <option <?php echo ($employees->department_code==$department->department_code) ? "selected" : '' ?> value="{{$department->department_code}}">{{$department->department_code}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="inputCategory" class="col-sm-2 col-form-label">Category</label>
                    <div class="col-sm-10">
                      <select name="category" id="category" class="form-control select2bs4">
                        @foreach ($categories as $category)
                          <option <?php echo ($employees->category == $category->category_name) ? "selected" : '' ?> value="{{$category->category_name}}">{{$category->category_name}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="inputLevel" class="col-sm-2 col-form-label">Level</label>
                    <div class="col-sm-10">

                      <select name="level" id="level" class="form-control select2bs4">
                          @foreach ($levels as $level)
                            <option <?php echo ($employees->level == $level->level_name ) ? "selected" : '' ?> value="{{$level->level_name}}">{{$level->level_name}}</option>
                          @endforeach
                      </select>

                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="inputBase" class="col-sm-2 col-form-label">Base</label>
                    <div class="col-sm-10">
                      <select name="base" id="base" class="form-control select2bs4">
                        @foreach ($bases as $base)
                          <option <?php echo ($employees->base == $base->base_name) ? "selected" : '' ?> value="{{$base->base_name}}">{{$base->base_name}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="inputWorkPlace" class="col-sm-2 col-form-label">Work Place</label>
                    <div class="col-sm-10">
                      <select name="work_place" id="work_place" class="form-control select2bs4">
                        @foreach ($work_places as $work_place)
                          <option <?php echo ($employees->work_place == $work_place->work_place_name) ? "selected" : '' ?> value="{{$work_place->work_place_name}}">{{$work_place->work_place_name}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="inputSubLocation" class="col-sm-2 col-form-label">Sub Location</label>
                    <div class="col-sm-10">
                      <select name="sub_location" id="sub_location" class="form-control select2bs4" style="width: 100%;">
                        @foreach ($sub_locations as $sub_location)
                          <option <?php echo ($employees->sub_location == $sub_location->sub_location_name) ? "selected" : '' ?> value="{{$sub_location->sub_location_name}}">{{$sub_location->sub_location_name}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>


                  <div class="form-group row">
                    <label for="basic_salary" class="col-sm-2 col-form-label">Basic Salary</label>
                    <div class="col-sm-10">
                      <input type="number" class="form-control" id="basic_salary" name="basic_salary" placeholder="Basic Salary" value="{{$employees->basic_salary}}">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="inputGrossSalary" class="col-sm-2 col-form-label">Gross Salary</label>
                    <div class="col-sm-10">
                      <input type="number" class="form-control" id="gross_salary" name="gross_salary" placeholder="Gross Salary" value="{{$employees->gross_salary}}">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="pf_amount" class="col-sm-2 col-form-label">PF Amount</label>
                    <div class="col-sm-10">
                      <input type="number" class="form-control" id="pf_amount" name="pf_amount" placeholder="PF Amount" value="{{$employees->pf_amount}}">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="joining_date" class="col-sm-2 col-form-label">Joining Date</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control employee_date" id="joining_date" name="joining_date" placeholder="Joining Date" value="{{$employees->joining_date}}">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="ending_date" class="col-sm-2 col-form-label">Ending Date</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control employee_date" id="ending_date" name="ending_date" placeholder="Ending Date" value="{{$employees->ending_date == '1970-01-01' ? '' : $employees->ending_date}}">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="ending_date" class="col-sm-2 col-form-label">Status</label>
                    <div class="col-sm-10">
                      <select name="status" id="status" class="form-control">
                        <option <?php echo ($employees->status == 1) ? "selected" : ""; ?> value="1">Active</option>
                        <option <?php echo ($employees->status == 0) ? "selected" : ""; ?> value="0">Deactive</option>
                      </select>
                    </div>
                  </div>

                  <div class="form-group row">
                    <div class="offset-sm-2 col-sm-10">

                      <button type="submit" id="employee-update" class="btn btn-success">Update</button>
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

  @endsection

 @section('customjs')
 <script src="http://www.jqueryscript.net/demo/jQuery-Plugin-To-Convert-HTML-Table-To-CSV-tabletoCSV/jquery.tabletoCSV.js"></script>

  <script>
  $( document ).ready(function() {

    // START DEPOSIT TABLE DATA DOWNLOAD CLICK FUNCTION
        $( "#pf-deposit-download" ).click(function() {
            $("#pf-deposit").tableToCSV();
        });
    // END DEPOSIT TABLE DATA DOWNLOAD CLICK FUNCTION

    // STRAT INTEREST TABLE DATA DOWNLOAD CLICK FUNCTION
    $( "#pf-interest-download" ).click(function() {
            $("#pf-interest").tableToCSV();
        });
    // END INTEREST TABLE DATA DOWNLOAD CLICK FUNCTION

    // STRAT YOUR LOAN AGAINST PF TABLE DATA DOWNLOAD CLICK FUNCTION
        $( "#loan-against-pf-download" ).click(function() {
            $("#loan-against-pf").tableToCSV();
        });
    // END YOUR LOAN AGAINST PF TABLE DATA DOWNLOAD CLICK FUNCTION

    // STRAT LOAN ADJUSMENT TABLE DATA DOWNLOAD CLICK FUNCTION
        $( "#loan-adjustment-download" ).click(function() {
            $("#loan-adjustment").tableToCSV();
        });
    // END LOAN ADJUSMENT PF TABLE DATA DOWNLOAD CLICK FUNCTION


    // START TABLE TO CSV CONVERT FUNCTION
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
// END TABLE TO CSV CONVERT FUNCTION

       //get the data
    $('#employee-update').click(function(e){
          $.ajaxSetup({
            headers: {
                      'X-CSRF-TOKEN': '<?php echo csrf_token() ?>'
                }
        });
      // console.log('hi');
       var staff_code = $('#staff_code').val();
      //  console.log(staff_code);
       var first_name = $('#first_name').val();
       var last_name = $('#last_name').val();
       var position = $('#position').val();
       var department_code = $('#department_code').val();
       var category = $('#category').val();
       var label = $('#label').val();
       var base = $('#base').val();
       var work_place = $('#work_place').val();
       var sub_location = $('#sub_location').val();
       var basic_salary = $('#basic_salary').val();
       var gross_salary = $('#gross_salary').val();
       var pf_amount = $('#pf_amount').val();
       var joining_date = $('#joining_date').val();
       var ending_date = $('#ending_date').val();
       var status = $('#status').val();
        if(staff_code == '' || first_name == '' || last_name == '' || position == ''
          || department_code == '' || category == '' ||  label == ''
          ||  base == '' ||  work_place == '' ||  sub_location == '' || basic_salary == ''
          || gross_salary == '' || pf_amount == '' || joining_date == '' || ending_date == '')
          {
            // Toast.fire({
            //   type: 'error',
            //   title: ' Please enter all fields to save the employee information'
            // });
            alert('Please enter all fields to save the employee information');
            console.log('empty');
          }
          else{

                $.ajax({
                  type: 'POST',
                  url: '../update-employee/'+staff_code,
                  // url:'./update-employee',
                  data: {
                      staff_code: staff_code,
                      first_name: first_name,
                      last_name: last_name,
                      position: position,
                      department_code: department_code,
                      category: category,
                      label: last_name,
                      base: base,
                      work_place: work_place,
                      sub_location: sub_location,
                      basic_salary: basic_salary,
                      gross_salary: gross_salary,
                      pf_amount: pf_amount,
                      joining_date: joining_date,
                      ending_date: ending_date,
                      status:status
                  },
                  dataType: 'text',
                  success: function (data) {
                    // alert(data);
                      alert('Employee information successfully update.');
                    console.log(data);
                    //console.log('hi');
                    // Toast.fire({
                    //   type: 'success',
                    //   title: ' Employee information successfully update.'
                    // });
                  }
                });
              }
        e.preventDefault();
     });
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    });
    $('.employee_date').datepicker({
      format: "yyyy-mm-dd",
      orientation: "bottom left"
    });
  });

  // $(".print-pdf-pf-deposit").on("click", function() {
  //       $("#search-grid").hide();
  //       $(".main-footer").hide();
  //       $('#title_data').hide();
  //       $('.print-button').hide();
  //       window.print();
  //       window.location = url;
  //   });
  </script>
 @endsection

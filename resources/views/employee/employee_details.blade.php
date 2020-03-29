

@extends('master')

@section('content')

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

<section class="content">
  <div class="card card-widget widget-user">
      <!-- Add the bg color to the header using any of the bg-* classes -->
      <div class="widget-user-header bg-success">
      <h3 class="widget-user-username"> {{$employees->first_name}} {{$employees->last_name}}</h3>
        <h5 class="widget-user-desc"> {{$employees->position}} </h5>
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
            <h5 class="description-header">{{$total_pf_amounts}}</h5>
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
                            <?php $i=1;?>
                            @foreach ($pf_deposits as $pf_deposit)
                            <tr>
                              <td> {{$i++}} </td>
                              <td> {{ date('j F, Y', strtotime($pf_deposit->deposit_date)) }} </td>
                              <td> {{$pf_deposit->own_pf}} </td>
                              <td> {{$pf_deposit->organization_pf}} </td>
                              <td> {{$pf_deposit->total_pf}} </td>
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
                <form class="form-horizontal" action="{{route('update-employee',$employees->staff_code)}}" method="post">

                  <div class="form-group row">
                    <label for="inputStaffCode" class="col-sm-2 col-form-label">Staff Code</label>
                    <div class="col-sm-10">
                      <input type="email" class="form-control" id="inputStaffCode" name="staff_code" placeholder="Staff Code" value="{{ sprintf("%04d", $employees->staff_code)}}">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="inputName" class="col-sm-2 col-form-label">First Name</label>
                    <div class="col-sm-10">
                      <input type="email" class="form-control" id="inputName" name="first_name" placeholder="First Name" value="{{$employees->first_name}}">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="inputName" class="col-sm-2 col-form-label">Last Name</label>
                    <div class="col-sm-10">
                      <input type="email" class="form-control" id="inputName" name="last_name" placeholder="Last Name" value="{{$employees->last_name}}">
                    </div>
                  </div>


                  <div class="form-group row">
                    <label for="inputPosition" class="col-sm-2 col-form-label">Position</label>
                    <div class="col-sm-10">
                      <select name="position" id="" class="form-control select2bs4">
                        @foreach ($positions as $position)
                          <option <?php echo ($position->position_name) ? "selected" : ""; ?>  value="{{$position->position_name}}">{{$position->position_name}}</option>
                         @endforeach
                      </select>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="inputDepartment_code" class="col-sm-2 col-form-label">Department Code</label>
                    <div class="col-sm-10">
                      <select name="department_code" id="" class="form-control select2bs4">
                        @foreach ($departments as $department)
                          <option <?php echo ($department->department_code) ? "selected" : ""; ?> value="{{$department->department_code}}">{{$department->department_code}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="inputCategory" class="col-sm-2 col-form-label">Category</label>
                    <div class="col-sm-10">
                      <select name="category" id="" class="form-control select2bs4">
                        @foreach ($categories as $category)
                          <option <?php echo ($category->category_name) ? "selected" : ""; ?> value="{{$category->category_name}}">{{$category->category_name}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="inputLevel" class="col-sm-2 col-form-label">Level</label>
                    <div class="col-sm-10">

                      <select name="level" id="" class="form-control select2bs4">
                          @foreach ($levels as $level)
                           <option <?php echo ($level->level_name) ? "selected" : ""; ?> value="{{$level->level_name}}">{{$level->level_name}}</option>
                          @endforeach
                      </select>

                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="inputBase" class="col-sm-2 col-form-label">Base</label>
                    <div class="col-sm-10">
                      <select name="base" id="" class="form-control select2bs4">
                        @foreach ($bases as $base)
                        <option <?php echo ($base->base_name) ? "selected" : ""; ?> value="{{$base->base_name}}">{{$base->base_name}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="inputWorkPlace" class="col-sm-2 col-form-label">Work Place</label>
                    <div class="col-sm-10">
                      <select name="work_place" id="" class="form-control select2bs4">
                        @foreach ($work_places as $work_place)
                          <option <?php echo ($work_place->work_place_name) ? "selected" : ""; ?> value="{{$work_place->work_place_name}}">{{$work_place->work_place_name}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="inputSubLocation" class="col-sm-2 col-form-label">Sub Location</label>
                    <div class="col-sm-10">
                      <select name="work_place" id="" class="form-control select2bs4" style="width: 100%;">
                        @foreach ($sub_locations as $sub_location)
                          <option <?php echo ($sub_location->sub_location_name) ? "selected" : ""; ?> value="{{$sub_location->sub_location_name}}">{{$sub_location->sub_location_name}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>

                  
                  <div class="form-group row">
                    <label for="inputBasicSalary" class="col-sm-2 col-form-label">Basic Salary</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputBasicSalary" name="basic_salary" placeholder="Basic Salary" value="{{$employees->basic_salary}}">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="inputGrossSalary" class="col-sm-2 col-form-label">Gross Salary</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputGrossSalary" name="gross_salary" placeholder="Gross Salary" value="{{$employees->gross_salary}}">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="inputPFAmount" class="col-sm-2 col-form-label">PF Amount</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputPFAmount" name="pf_amount" placeholder="PF Amount" value="{{$employees->pf_amount}}">
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
                      <input type="text" class="form-control employee_date" id="employee_date" name="ending_date" placeholder="Ending Date" value="{{$employees->ending_date}}">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="ending_date" class="col-sm-2 col-form-label">Status</label>
                    <div class="col-sm-10">
                      <select name="status" id="" class="form-control">
                        <option <?php echo ($employees->status == 1) ? "selected" : ""; ?> value="1">Active</option>
                        <option <?php echo ($employees->status == 0) ? "selected" : ""; ?> value="0">Deactive</option>
                      </select>
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
                      
                      <button type="submit" class="btn btn-success">Update</button>
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
  <script>
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

    $('.employee_date').datepicker({
      format: "yyyy-mm-dd",
      orientation: "bottom left"
    });


  </script>
 @endsection


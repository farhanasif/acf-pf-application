@extends('master')

@section('content')

<section class="content-header">
   <div class="container-fluid">
     <div class="row mb-2">
       <div class="col-sm-6">
         <h1>Edit Employee </h1>
       </div>
       <div class="col-sm-6">
         <ol class="breadcrumb float-sm-right">
           <li class="breadcrumb-item"><a href="#">Home</a></li>
           <li class="breadcrumb-item active"><a href="#">Employee</a></li>
           <li class="breadcrumb-item active"><a href="#">Edit Employee</a></li>
         </ol>
       </div>
     </div>
   </div><!-- /.container-fluid -->
 </section>



   <div class="card card-success card-outline">
        <div class="card-header">
          <h3 class="card-title">Edit Employee Information</h3>
        </div>
        @if ($message = Session::get('success'))
          <div class="alert alert-success alert-block">
           <button type="button" class="close" data-dismiss="alert">×</button>
           <strong>{{ $message }}</strong>
          </div>
          @endif

          @if ($errors->any())
        <div class="alert alert-warning">
          <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
          @endif

        <div class="card-body">

          <form class="form-horizontal form-label-left" action="{{route('update-employee',$employee->id)}}" method="post">
            @csrf
            <div class="form-group row">
              <label for="staff_code" class="col-form-label col-md-2 col-sm-3 label-align">Staff Code</label>
                <div class="col-md-3 col-sm-3 ">
                   <input type="text" class="form-control" name="staff_code" placeholder="Staff Code" > 
              </div>
              <div class="col-md-2 "></div>
              <label for="first_name" class="col-form-label col-md-2 col-sm-3 label-align">Fisrt Name</label>
              <div class="col-md-3 col-sm-3 ">
                 <input type="text" class="form-control" name="first_name" placeholder="First Name">
              </div>
            </div>
            
           <div class="form-group row">
           <label for="last_name" class="col-form-label col-md-2 col-sm-3 label-align">Last Name</label>
           <div class="col-md-3 col-sm-3 ">
              <input type="text" class="form-control" name="last_name" placeholder="Last Name">
           </div>
           <div class="col-md-2 "></div>
           <label for="position" class="col-form-label col-md-2 col-sm-3 label-align">Position</label>
           <div class="col-md-3 col-sm-3 ">
              {{-- <input type="text" class="form-control" name="position" placeholder="Position" value="{{$employee->staff_code}}"> --}}
              <select name="position" id="" class="form-control select2bs4">
                <option value="">--select--</option>
                <option value="liaison_manager">Liaison Manager</option>
                <option value="office_cleaner">Office Cleaner</option>
                <option value="senior_finance_officer">Senior Finance Officer</option>
                <option value="guest_house&office_cleaner">Guest House & Office Cleaner</option>
                <option value="driver">Driver</option>
                <option value="FSL_&_DRR_HoD">FSL & DRR HoD</option>
              </select>
           </div>
         </div>
  
         <div class="form-group row">
          <label for="department_code" class="col-form-label col-md-2 col-sm-3 label-align">Department Code</label>
          <div class="col-md-3 col-sm-3 ">
            <select name="department_code" id="" class="form-control select2bs4">
              <option value="">--select--</option>
              <option value="OPE">OPE</option>
              <option value="HRE">HRE</option>
              <option value="MHC">MHC</option>
              <option value="WAS">WAS</option>
              <option value="MHC">MHC</option>
              <option value="WAS">WAS</option>
            </select>
            {{-- <input type="text" class="form-control" name="department_code" placeholder="Department Code" value="{{$employee->staff_code}}"> --}}
          </div>
          <div class="col-md-2 "></div>
          <label for="category" class="col-form-label col-md-2 col-sm-3 label-align">Category</label>
          <div class="col-md-3 col-sm-3 ">
            <select name="category" id="" class="form-control select2bs4">
              <option value="">--select--</option>
              <option value="OPE">OPE</option>
              <option value="HRE">HRE</option>
              <option value="FIN">FIN</option>
              <option value="LOG">LOG</option>
              <option value="FSL">FSL</option>
            </select>
             {{-- <input type="text" class="form-control" name="category" placeholder="Category" value="{{$employee->staff_code}}"> --}}
          </div>
        </div>
  
       <div class="form-group row">
        <label for="level" class="col-form-label col-md-2 col-sm-3 label-align">Level</label>
        <div class="col-md-3 col-sm-3 ">
          <select name="level" id="" class="form-control select2bs4">
            <option value="">--select--</option>
            <option value="X1L4">X1L4</option>
            <option value="E1L4">E1L4</option>
            <option value="X3L2">X3L2</option>
            <option value="T3L3">T3L3</option>
          </select>
           {{-- <input type="text" class="form-control" name="level" placeholder="Level" value="{{$employee->staff_code}}"> --}}
        </div>
        <div class="col-md-2 "></div>
        <label for="base" class="col-form-label col-md-2 col-sm-3 label-align">Base</label>
       <div class="col-md-3 col-sm-3 ">
        <select name="base" id="" class="form-control select2bs4" style="width: 100%;">
          <option value="">--select--</option>
          <option value="base">base</option>
          <option value="Dhaka">Dhaka</option>
          <option value="cox'Cox's Bazar">cox'Cox's Bazar</option>
          <option value="Satkhira">Satkhira</option>
        </select>
          {{-- <input type="text" class="form-control" name="base" placeholder="Base" value="{{$employee->staff_code}}"> --}}
       </div>
      </div>
  
     <div class="form-group row">
      <label for="work_place" class="col-form-label col-md-2 col-sm-3 label-align">Work Place</label>
      <div class="col-md-3 col-sm-3 ">
        <select name="work_place" id="" class="form-control select2bs4" style="width: 100%;" >
          <option value="">--select--</option>
          <option value="work_place">work_place</option>
          <option value="Dhaka">Dhaka</option>
          <option value="cox'Cox's Bazar">cox'Cox's Bazar</option>
          <option value="Satkhira">Satkhira</option>
        </select>
         {{-- <input type="text" class="form-control" name="work_place" placeholder="Work Place" value="{{$employee->staff_code}}"> --}}
      </div>
  
      <div class="col-md-2 "></div>
  
      <label for="sub_location" class="col-form-label col-md-2 col-sm-3 label-align">Sub Location</label>
      <div class="col-md-3 col-sm-3 ">
        <select name="work_place" id="" class="form-control select2bs4" style="width: 100%;">
          <option value="">--select--</option>
          <option value="sub_location">sub_location</option>
          <option value="Gulshan">Gulshan</option>
          <option value="Mohakhali">Mohakhali</option>
          <option value="Mirpur">Mirpur</option>
        </select>
         {{-- <input type="text" class="form-control" name="sub_location" placeholder="Sub Location" value="{{$employee->staff_code}}"a> --}}
      </div>
    </div>
  
  
   <div class="form-group row">
    <label for="basic_salary" class="col-form-label col-md-2 col-sm-3 label-align">Basic Salary</label>
    <div class="col-md-3 col-sm-3 ">
       <input type="number" class="form-control" name="basic_salary" placeholder="Basic Salary">
    </div>
    <div class="col-md-2 "></div>
    <label for="gross_salary" class="col-form-label col-md-2 col-sm-3 label-align">Gross Salary</label>
   <div class="col-md-3 col-sm-3 ">
      <input type="number" class="form-control" name="gross_salary" placeholder="Gross Salary">
   </div>
  </div>
  
  <div class="form-group row">
  <label for="provident_fund" class="col-form-label col-md-2 col-sm-3 label-align">Provident Amount</label>
  <div class="col-md-3 col-sm-3 ">
     <input type="number" class="form-control" name="pf_fund" placeholder="Provident Fund">
  </div>
  <div class="col-md-2 "></div>
  
  <label for="joining_date" class="col-form-label col-md-2 col-sm-3 label-align">Joining Date</label>
  <div class="col-md-3 col-sm-3 ">
     <input type="date" class="form-control" name="joining_date" >
  </div>
  </div>
  
  <div class="form-group row">
  <label for="ending_date" class="col-form-label col-md-2 col-sm-3 label-align">Ending Date</label>
  <div class="col-md-3 col-sm-3 ">
     <input type="date" class="form-control" name="ending_date" >
  </div>
  </div>
  
    <div class="form-group row">
      <div class="col-md-2"></div>
      <div class="col-md-3 col-sm-3">
          <button  type="submit" class="btn btn-success ">Update</button>
            <a type="submit" class="btn btn-danger float-right" href="{{route('delete-employee',$employee->id)}}" onclick="ConfirmDelete()">Deactive</a>
      </div>
   </div>
  
       </form>

        </div>
      </div>
@endsection

<script>
  function ConfirmDelete()
  {
    var user = confirm("Are you sure you want to delete?");
    if (user)
        return true;
    else
      return false;
  }
</script>
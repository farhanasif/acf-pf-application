@extends('welcome')

@section('content')
   <div class="card card-success card-outline">
        <div class="card-header">
          <h3 class="card-title">Add Employee Information</h3>
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
          <!-- /.card -->
            <!-- Horizontal Form -->
           <form class="form-horizontal form-label-left" action="{{route('update-employee',$employee->id)}}" method="post">
             @csrf
          <div class="form-group row">
             <label for="staff_code" class="col-form-label col-md-2 col-sm-3 label-align">Staff Code</label>
             	<div class="col-md-6 col-sm-6 ">
             			    	 <!-- <input type="email" class="form-control"  placeholder="Enter email"> -->
             	   <select class="form-control" name="staff_code">
             	     <option value="">--select--</option>
             	      <option value="1">1</option>
             	       <option value="2">2</option>
             	   </select>
             </div>
          </div>

          <div class="form-group row">
          <label for="first_name" class="col-form-label col-md-2 col-sm-3 label-align">Fisrt Name</label>
          <div class="col-md-6 col-sm-6 ">
             <input type="text" class="form-control" name="first_name" placeholder="First Name" value="{{$employee->first_name}}">
          </div>
          </div>

          <div class="form-group row">
			    <label for="last_name" class="col-form-label col-md-2 col-sm-3 label-align">Last Name</label>
			    <div class="col-md-6 col-sm-6 ">
			    	 <input type="text" class="form-control" name="last_name" placeholder="Last Name" value="{{$employee->last_name}}">
			    </div>
			  </div>

			   <div class="form-group row">
			    <label for="position" class="col-form-label col-md-2 col-sm-3 label-align">Position</label>
			    <div class="col-md-6 col-sm-6 ">
			    	 <input type="text" class="form-control" name="position" placeholder="Position" value="{{$employee->position}}">
			    </div>
			  </div>

        <div class="form-group row">
         <label for="department_code" class="col-form-label col-md-2 col-sm-3 label-align">Department Code</label>
         <div class="col-md-6 col-sm-6 ">
            <input type="text" class="form-control" name="department_code" placeholder="Department Code" value="{{$employee->department_code}}">
         </div>
       </div>

       <div class="form-group row">
        <label for="category" class="col-form-label col-md-2 col-sm-3 label-align">Category</label>
        <div class="col-md-6 col-sm-6 ">
           <input type="text" class="form-control" name="category" placeholder="Category" value="{{$employee->category}}">
        </div>
      </div>

      <div class="form-group row">
       <label for="level" class="col-form-label col-md-2 col-sm-3 label-align">Level</label>
       <div class="col-md-6 col-sm-6 ">
          <input type="text" class="form-control" name="level" placeholder="Level" value="{{$employee->level}}">
       </div>
     </div>

     <div class="form-group row">
      <label for="base" class="col-form-label col-md-2 col-sm-3 label-align">Base</label>
      <div class="col-md-6 col-sm-6 ">
         <input type="text" class="form-control" name="base" placeholder="Base" value="{{$employee->base}}">
      </div>
    </div>

    <div class="form-group row">
     <label for="work_place" class="col-form-label col-md-2 col-sm-3 label-align">Work Place</label>
     <div class="col-md-6 col-sm-6 ">
        <input type="text" class="form-control" name="work_place" placeholder="Work Place" value="{{$employee->work_place}}">
     </div>
   </div>

   <div class="form-group row">
    <label for="sub_location" class="col-form-label col-md-2 col-sm-3 label-align">Sub Location</label>
    <div class="col-md-6 col-sm-6 ">
       <input type="text" class="form-control" name="sub_location" placeholder="Sub Location" value="{{$employee->sub_location}}">
    </div>
  </div>

  <div class="form-group row">
   <label for="basic_salary" class="col-form-label col-md-2 col-sm-3 label-align">Basic Salary</label>
   <div class="col-md-6 col-sm-6 ">
      <input type="number" class="form-control" name="basic_salary" placeholder="Basic Salary" value="{{$employee->basic_salary}}">
   </div>
 </div>


 <div class="form-group row">
  <label for="gross_salary" class="col-form-label col-md-2 col-sm-3 label-align">Gross Salary</label>
  <div class="col-md-6 col-sm-6 ">
     <input type="number" class="form-control" name="gross_salary" placeholder="Gross Salary" value="{{$employee->gross_salary}}">
  </div>
</div>

<div class="form-group row">
 <label for="provident_fund" class="col-form-label col-md-2 col-sm-3 label-align">Provident Amount</label>
 <div class="col-md-6 col-sm-6 ">
    <input type="number" class="form-control" name="pf_amount" placeholder="Provident Fund" value="{{$employee->pf_amount}}">
 </div>
</div>

<div class="form-group row">
 <label for="joining_date" class="col-form-label col-md-2 col-sm-3 label-align">Joining Date</label>
 <div class="col-md-6 col-sm-6 ">
    <input type="date" class="form-control" name="joining_date" value="{{$employee->joining_date}}" >
 </div>
</div>

<div class="form-group row">
 <label for="ending_date" class="col-form-label col-md-2 col-sm-3 label-align">Ending Date</label>
 <div class="col-md-6 col-sm-6 ">
    <input type="date" class="form-control" name="ending_date" value="{{$employee->ending_date}}" >
 </div>
</div>

    <div class="form-group row">
    <label for="submit" class="col-form-label col-md-2 col-sm-3 label-align"></label>
    <div class="col-md-6 col-sm-6 text-center ">
      <button  type="submit" class="btn btn-success ">Update</button>
    </div>
    </div>

			</form>
			            <!-- /.card -->
        </div>
      </div>
@endsection

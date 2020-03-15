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
                   <input type="text" class="form-control" name="staff_code" placeholder="Staff Code" value="{{ sprintf("%04d", $employee->staff_code)}}"> 
              </div>
              <div class="col-md-2 "></div>

              <label for="level" class="col-form-label col-md-2 col-sm-3 label-align">Level</label>
              <div class="col-md-3 col-sm-3 ">
                <select name="level" id="" class="form-control select2bs4">
                  @foreach ($levels as $level)
                  <option <?php echo ($level->level_name) ? "selected" : ""; ?> value="{{$level->level_name}}">{{$level->level_name}}</option>
                  @endforeach
                </select>
              </div>
            </div>
            
           <div class="form-group row">
            <label for="first_name" class="col-form-label col-md-2 col-sm-3 label-align">Fisrt Name</label>
              <div class="col-md-3 col-sm-3 ">
                 <input type="text" class="form-control" name="first_name" placeholder="First Name" value="{{$employee->first_name}}">
              </div>

           <div class="col-md-2 "></div>
           <label for="department_code" class="col-form-label col-md-2 col-sm-3 label-align">Department Code</label>
           <div class="col-md-3 col-sm-3 ">
             <select name="department_code" id="" class="form-control select2bs4">
               @foreach ($departments as $department)
               <option <?php echo ($department->department_code) ? "selected" : ""; ?> value="{{$department->department_code}}">{{$department->department_code}}</option>
               @endforeach
             </select>
           </div>
          </div>

          <div class="form-group row">
           <label for="last_name" class="col-form-label col-md-2 col-sm-3 label-align">Last Name</label>
           <div class="col-md-3 col-sm-3 ">
              <input type="text" class="form-control" name="last_name" placeholder="Last Name" value="{{$employee->last_name}}">
           </div>
            <div class="col-md-2 "></div>
           <label for="category" class="col-form-label col-md-2 col-sm-3 label-align">Category</label>
           <div class="col-md-3 col-sm-3 ">
             <select name="category" id="" class="form-control select2bs4">
               @foreach ($categories as $category)
               <option <?php echo ($category->category_name) ? "selected" : ""; ?> value="{{$category->category_name}}">{{$category->category_name}}</option>
               @endforeach
             </select>
           </div>
          </div>
         
  
         <div class="form-group row">
          <label for="position" class="col-form-label col-md-2 col-sm-3 label-align">Position</label>
          <div class="col-md-3 col-sm-3 ">
             <select name="position" id="" class="form-control select2bs4">
               @foreach ($positions as $position)
                 <option <?php echo ($position->position_name) ? "selected" : ""; ?>  value="{{$position->position_name}}">{{$position->position_name}}</option>
                @endforeach
             </select>
          </div> 

          <div class="col-md-2 "></div>

          <label for="base" class="col-form-label col-md-2 col-sm-3 label-align">Base</label>
          <div class="col-md-3 col-sm-3 ">
           <select name="base" id="" class="form-control select2bs4" style="width: 100%;">
             @foreach ($bases as $base)
             <option <?php echo ($base->base_name) ? "selected" : ""; ?> value="{{$base->base_name}}">{{$base->base_name}}</option>
             @endforeach
           </select>
          </div>

        </div>
  
       <div class="form-group row">
        <div class="col-md-2 "></div>

      </div>
  
     <div class="form-group row">
      <label for="work_place" class="col-form-label col-md-2 col-sm-3 label-align">Work Place</label>
      <div class="col-md-3 col-sm-3 ">
        <select name="work_place" id="" class="form-control select2bs4" style="width: 100%;" >
          @foreach ($work_places as $work_place)
          <option <?php echo ($work_place->work_place_name) ? "selected" : ""; ?> value="{{$work_place->work_place_name}}">{{$work_place->work_place_name}}</option>
          @endforeach
        </select>
      </div>
  
      <div class="col-md-2 "></div>
  
      <label for="sub_location" class="col-form-label col-md-2 col-sm-3 label-align">Sub Location</label>
      <div class="col-md-3 col-sm-3 ">
        <select name="work_place" id="" class="form-control select2bs4" style="width: 100%;">
          @foreach ($sub_locations as $sub_location)
            <option <?php echo ($sub_location->sub_location_name) ? "selected" : ""; ?> value="{{$sub_location->sub_location_name}}">{{$sub_location->sub_location_name}}</option>
          @endforeach
        </select>
      </div>
    </div>
  
  
    <div class="form-group row">
        <label for="basic_salary" class="col-form-label col-md-2 col-sm-3 label-align">Basic Salary</label>
        <div class="col-md-3 col-sm-3 ">
          <input type="number" class="form-control" name="basic_salary" placeholder="Basic Salary"  value="{{$employee->basic_salary}}">
        </div>
      <div class="col-md-2 "></div>
        <label for="gross_salary" class="col-form-label col-md-2 col-sm-3 label-align">Gross Salary</label>
        <div class="col-md-3 col-sm-3 ">
            <input type="number" class="form-control" name="gross_salary" placeholder="Gross Salary" value="{{$employee->gross_salary}}">
        </div>
    </div>
  
    <div class="form-group row">
      <label for="provident_fund" class="col-form-label col-md-2 col-sm-3 label-align">Provident Amount</label>
        <div class="col-md-3 col-sm-3 ">
          <input type="number" class="form-control" name="pf_amount" placeholder="Provident Fund" value="{{$employee->pf_amount}}">
        </div>
      <div class="col-md-2 "></div>
      <label for="joining_date" class="col-form-label col-md-2 col-sm-3 label-align">Joining Date</label>
        <div class="col-md-3 col-sm-3 ">
          <input type="date" class="form-control" name="joining_date" value="{{$employee->joining_date}}">
        </div>
    </div>
  
  <div class="form-group row">
    <label for="ending_date" class="col-form-label col-md-2 col-sm-3 label-align">Ending Date</label>
    <div class="col-md-3 col-sm-3 ">
      <input type="date" class="form-control" name="ending_date" value="{{$employee->ending_date}}">
    </div>
    <div class="col-md-2 "></div>
    <label for="ending_date" class="col-form-label col-md-2 col-sm-3 label-align">Status</label>
    <div class="col-md-3 col-sm-3 ">
      <select name="status" id="" class="form-control">
        <option <?php echo ($employee->status == 1) ? "selected" : ""; ?> value="1">Active</option>
        <option <?php echo ($employee->status == 0) ? "selected" : ""; ?> value="0">Deactive</option>
      </select>
    </div>
  </div>
  
    <div class="form-group row">
      <div class="col-md-2"></div>
      <div class="col-md-3 col-sm-3">
          <button  type="submit" class="btn btn-success ">Update</button>
          {{-- <a type="submit" class="btn btn-danger float-right" href="javascript:void(0)">Deactive</a> --}}
      </div>
   </div>
  
       </form>
       {{-- <div class="form-group row">
        <div class="col-md-2"></div>
        <div class="col-md-3 col-sm-3">
              <a type="submit" class="btn btn-danger float-right" href="{{route('delete-employee',$employee->id)}}" onclick="ConfirmDelete()">Deactive</a>
        </div>
     </div> --}}

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
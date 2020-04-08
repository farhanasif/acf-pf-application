
@extends('master')

@section('content')

<section class="content-header">
   <div class="container-fluid">
     <div class="row mb-2">
       <div class="col-sm-6">
         <h1>Add Employee </h1>
       </div>
       <div class="col-sm-6">
         <ol class="breadcrumb float-sm-right">
           <li class="breadcrumb-item"><a href="#">Home</a></li>
           <li class="breadcrumb-item active"><a href="#">Employee</a></li>
           <li class="breadcrumb-item active"><a href="#">Add Employee</a></li>
         </ol>
       </div>
     </div>
   </div><!-- /.container-fluid -->
 </section>

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
           <form class="form-horizontal form-label-left" action="{{url('/save-employee')}}" method="post">
              @csrf
            <div class="form-group row">
              <label for="staff_code" class="col-form-label col-md-2 col-sm-2 label-align">Staff Code</label>
                <div class="col-md-4 col-sm-3 ">
                   <input type="text" class="form-control" name="staff_code" placeholder="Staff Code" > 
              </div>

              <label for="level" class="col-form-label col-md-2 col-sm-3 label-align">Level</label>
              <div class="col-md-4 col-sm-3 ">
                <select name="level" id="" class="form-control select2bs4">
                  <option value="">--select--</option>

                  @foreach ($levels as $level)
                    <option value="{{$level->level_name}}">{{$level->level_name}}</option>
                  @endforeach
                </select>
              </div>
            </div>
            
           <div class="form-group row">
            <label for="first_name" class="col-form-label col-md-2 col-sm-2 label-align ">Fisrt Name</label>
            <div class="col-md-4 col-sm-3 ">
               <input type="text" class="form-control" name="first_name" placeholder="First Name">
            </div>
           {{-- <div class="col-md-2 "></div> --}}
              <label for="department_code" class="col-form-label col-md-2 col-sm-3 label-align">Department Code</label>
              <div class="col-md-4 col-sm-3 ">
                <select name="department_code" id="" class="form-control select2bs4">
                  <option value="">--select--</option>

                  @foreach ($departments as $department)
                    <option value="{{$department->department_code}}">{{$department->department_code}}</option>
                  @endforeach

                  {{-- <option value="HRE">HRE</option>
                  <option value="MHC">MHC</option>
                  <option value="WAS">WAS</option>
                  <option value="MHC">MHC</option>
                  <option value="WAS">WAS</option> --}}
                </select>
              </div>
         </div>
  
         <div class="form-group row">
              <label for="last_name" class="col-form-label col-md-2 col-sm-3 label-align">Last Name</label>
              <div class="col-md-4 col-sm-3 ">
                 <input type="text" class="form-control" name="last_name" placeholder="Last Name">
              </div>
         
          <label for="category" class="col-form-label col-md-2 col-sm-3 label-align">Category</label>
          <div class="col-md-4 col-sm-3 ">
            <select name="category" id="" class="form-control select2bs4">
              <option value="">--select--</option>
                  @foreach ($categories as $category)
                    <option value="{{$category->category_name}}">{{$category->category_name}}</option>
                  @endforeach
            </select>
          </div>
        </div>
  
       <div class="form-group row">
        <label for="position" class="col-form-label col-md-2 col-sm-3 label-align">Position</label>
        <div class="col-md-4 col-sm-3 ">
           {{-- <input type="text" class="form-control" name="position" placeholder="Position" value="{{$employee->staff_code}}"> --}}
           <select name="position" id="" class="form-control select2bs4">
             <option value="">--select--</option>
             @foreach ($positions as $position)
             <option value="{{$position->position_name}}">{{$position->position_name}}</option>
            @endforeach
           </select>
        </div>
      
        <label for="base" class="col-form-label col-md-2 col-sm-3 label-align">Base</label>
       <div class="col-md-4 col-sm-3 ">
        <select name="base" id="" class="form-control select2bs4" style="width: 100%;">
          <option value="">--select--</option>
          @foreach ($bases as $base)
          <option value="{{$base->base_name}}">{{$base->base_name}}</option>
         @endforeach
        </select>
          {{-- <input type="text" class="form-control" name="base" placeholder="Base" value="{{$employee->staff_code}}"> --}}
       </div>
      </div>
  
     <div class="form-group row">
      <label for="work_place" class="col-form-label col-md-2 col-sm-3 label-align">Work Place</label>
      <div class="col-md-4 col-sm-3 ">
        <select name="work_place" id="" class="form-control select2bs4" style="width: 100%;" >
          <option value="">--select--</option>
          @foreach ($work_places as $work_place)
          <option value="{{$work_place->work_place_name}}">{{$work_place->work_place_name}}</option>
         @endforeach
        </select>
         {{-- <input type="text" class="form-control" name="work_place" placeholder="Work Place" value="{{$employee->staff_code}}"> --}}
      </div>
  
      <label for="sub_location" class="col-form-label col-md-2 col-sm-3 label-align">Sub Location</label>
      <div class="col-md-4 col-sm-3 ">
        <select name="work_place" id="" class="form-control select2bs4" style="width: 100%;">
          <option value="">--select--</option>
          @foreach ($sub_locations as $sub_location)
          <option value="{{$sub_location->sub_location_name}}">{{$sub_location->sub_location_name}}</option>
         @endforeach
        </select>
         {{-- <input type="text" class="form-control" name="sub_location" placeholder="Sub Location" value="{{$employee->staff_code}}"a> --}}
      </div>
    </div>
  
  
   <div class="form-group row">
    <label for="basic_salary" class="col-form-label col-md-2 col-sm-3 label-align">Basic Salary</label>
    <div class="col-md-4 col-sm-3 ">
       <input type="number" class="form-control" name="basic_salary" placeholder="Basic Salary">
    </div>
    
    <label for="gross_salary" class="col-form-label col-md-2 col-sm-3 label-align">Gross Salary</label>
   <div class="col-md-4 col-sm-3 ">
      <input type="number" class="form-control" name="gross_salary" placeholder="Gross Salary">
   </div>
  </div>
  
  <div class="form-group row">
  <label for="provident_fund" class="col-form-label col-md-2 col-sm-3 label-align">Provident Amount</label>
  <div class="col-md-4 col-sm-3 ">
     <input type="number" class="form-control" name="pf_amount" placeholder="Provident Fund">
  </div>
 
  
  <label for="joining_date" class="col-form-label col-md-2 col-sm-3 label-align">Joining Date</label>
  <div class="col-md-4 col-sm-3 ">
     <input type="date" class="form-control" name="joining_date">
  </div>
  </div>
  
  <div class="form-group row">
  <label for="ending_date" class="col-form-label col-md-2 col-sm-3 label-align">Ending Date</label>
  <div class="col-md-4 col-sm-3 ">
     <input type="date" class="form-control" name="ending_date" >
  </div>
  </div>
  
     <div class="form-group row">
       <div class="col-md-2"></div>
       <div class="col-md-3 col-sm-3">
           <button  type="submit" class="btn btn-success">Submit</button>
       <a type="submit" class="btn btn-info ml-3" href="{{route('all-employee')}}">Back</a>
       </div>
    </div>
  
       </form>
			            <!-- /.card -->
        </div>
      </div>
@endsection

@section('customjs')
    <script>

    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
    
    </script>
@endsection

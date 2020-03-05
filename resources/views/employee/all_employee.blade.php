@extends('master')

@section('content')

<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>All Employee </h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active"><a href="#">Employee</a></li>
          <li class="breadcrumb-item active"><a href="#">All Employee</a></li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>


<section class="content">
  <div class="card card-success card-outline">
    <div class="card-header">
      <div class="row">
        <div class="col-sm-6">
          <h3 class="card-title">All Employees Information</h3>
        </div>

        <div class="col-md-6">
            <a href="" class="btn btn-success" data-toggle="modal" data-target="#modal-default">Batch Upload</a> 
            <a href="{{url('download_excel/employee/employee.xlsx')}}" class="btn btn-success">Download Sample Excel</a> 
            <a href="{{route('add-employee')}}" class="btn btn-primary"><i class="fas fa-plus"></i> Add Employee</a>
        </div>
        <div class="col-md-6 offset-3 mt-2">
          @if ($message = Session::get('success'))
              <div class="alert alert-success alert-block">
              <button type="button" class="close" data-dismiss="alert">×</button>
              <strong>{{ $message }}</strong>
              </div>
          @endif

          @if ($message = Session::get('danger'))
            <div class="alert alert-danger alert-block">
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
      </div>
      </div>

    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <table id="example1" class="table table-bordered table-striped">
        <thead>

        <tr>
          <th>SL NO</th>
          <th>Staff Code</th>
          <th>Name</th>
          <th>Position</th>
          <th>Department Code</th>
          <th>Category</th>
          <th>Level</th>
          <th>Base</th>
          <th>Work Place</th>
          <th>Sub Location</th>
          <th>Basic Salary</th>
          <th>Gross Salary</th>
          <th>Provident Amount</th>
          <th>Joining Date</th>
          <th>Ending Date</th>
          {{-- <th>Action</th> --}}
        </tr>
        </thead>
        <tbody>
     <?php $i=1;?>
      @foreach($employees as $employee)
        <tr>
          <td>{{ $i++ }}</td>

          <?php 
          if($employee->status == 0)
          {
          ?>
          <td class="bg-danger text-bold">
            <a href="{{route('edit-employee',$employee->id)}}">{{$employee->staff_code}}</a>
          </td>
      <?php 
          }
          else {
              ?>
            <td class="bg-success text-bold">
              <a href="{{route('edit-employee',$employee->id)}}">{{$employee->staff_code}}</a>
            </td>
            <?php 
          }
       ?>
          <td>
            <a href="{{route('edit-employee',$employee->id)}}">
            {{$employee->first_name}} {{$employee->last_name}}
          </td>
          <td>{{$employee->position}}</td>
          <td>{{$employee->department_code}}</td>
          <td>{{$employee->category}}</td>
          <td>{{$employee->level}}</td>
          <td>{{$employee->base}}</td>
          <td>{{$employee->work_place}}</td>
          <td>{{$employee->sub_location}}</td>
          <td>{{$employee->basic_salary}}</td>
          <td>{{$employee->gross_salary}}</td>
          <td>{{$employee->pf_amount}}</td>
          <td>{{$employee->joining_date}}</td>
          <td>{{$employee->ending_date}}</td>
          {{-- <td >
              <a href="{{route('edit-employee',$employee->id)}}" class="btn btn-warning"><i class="fas fa-edit"></i></a>
              <a href="{{route('delete-employee',$employee->id)}}" onclick="ConfirmDelete()" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
          </td> --}}
        </tr>
      @endforeach
      </tbody>
      </table>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->

</section>


<!-- START EMPLOYEE BATCH UPLOAD MODAL -->
<div class="modal fade" id="modal-default">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Employee Bacth Upload</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{route('save-employee-batch-upload')}}" method="post" enctype="multipart/form-data">
          @csrf
          <input type="file" name="file" class="form-control">
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Upload</button>
          </div>
        </form>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- END EMPLOYEE BATCH UPLOAD MODAL -->

@endsection


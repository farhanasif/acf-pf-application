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
      <h3 class="card-title">All Employees Information</h3>
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
          <td>
            <a href="{{route('edit-employee',$employee->id)}}">{{$employee->staff_code}}</a>
          </td>
          <td>{{$employee->first_name}} {{$employee->last_name}}</td>
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
@endsection

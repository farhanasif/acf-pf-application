@extends('master')
@section('customcss')

<style>
  tr.selected td {
      background-color:coral !important;
  }
  .selected {
      background-color: coral;
  }
  .first-col {
      text-align: center; background-color: #212529; color: #fff;
  }
  .general-col {
      text-align: center; background-color: #bee5eb; color: #000;
  }
</style>
@endsection
@section('content')

<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>All Employees Information</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
          <li class="breadcrumb-item active"><a href="javascript:void(0)">Employee</a></li>
          <li class="breadcrumb-item active"><a href="javascript:void(0)">All Employees Information</a></li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<section class="content">
  <div class="card card-success card-outline">
    <div class="card-header">
          <h3 class="card-title">All Employees Information</h3>

        <div class="float-sm-right">
          <button type="submit" id="all-employee-download" class="btn btn-success"  onclick="exportToExcel('all-employee','all-employee')">Download Excel</button>
          <a href="" class="btn btn-success" data-toggle="modal" data-target="#modal-default">Batch Upload</a>
          <a href="{{url('download_excel/employee/employee.xlsx')}}" class="btn btn-success">Download Sample Excel</a>
          <a href="{{route('add-employee')}}" class="btn btn-success"><i class="fas fa-plus"></i> Add Employee</a>
        </div>

        @include('message')

    </div>

    <div class="card-header card-secondary">
      <div class="card-header">
        <h3 class="card-title">Filters</h3>
        </div>
      <form role="form" action="{{route('all-employee')}}" method="POST">
        @csrf
        <div class="row">

          <div class="col-md-3 col-sm-6">
            <div class="form-group">
            <label>Staff Code</label>
            <select class="custom-select select2bs4 " id="staff_code" name="staff_code">
                <option value="-1">--select--</option>

                @foreach ($all_employees as $employee)
                  <option value="{{ sprintf("%04d", $employee->staff_code)}}"> {{ sprintf("%04d", $employee->staff_code)}} </option>
                @endforeach

            </select>
            </div>
          </div>

            <div class="col-md-3 col-sm-6">
                <!-- select -->
                <div class="form-group">
                <label>Name</label>
                <select class="custom-select select2bs4" id="name" name="name">
                    <option value="-1">--select--</option>
                      @foreach ($all_employees as $employee)
                        <option value="{{ sprintf("%04d", $employee->staff_code)}}"> {{$employee->first_name}} {{$employee->last_name}} </option>
                      @endforeach

                </select>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="form-group">
                <label>Position</label>
                <select class="custom-select select2bs4" id="position" name="position">
                  <option value="-1">--select--</option>
                  @foreach ($positions as $position)
                      <option value="{{$position->position_name}}">{{$position->position_name}}</option>
                  @endforeach

                </select>
                </div>
            </div>

            <div class="col-md-3 col-sm-6">
                <!-- select -->
                <div class="form-group">
                <label>Department Code</label>
                <select class="custom-select select2bs4" id="department_code" name="department_code">
                    <option value="-1">--select--</option>

                    @foreach ($departments as $department)
                      <option value="{{$department->department_code}}"> {{$department->department_code}} </option>
                    @endforeach

                </select>
                </div>
            </div>
            </div>

            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="form-group">
                    <label>Category</label>
                    <select class="custom-select select2bs4" id="category" name="category">
                      <option value="-1">--select--</option>
                      @foreach ($categories as $category)
                          <option value="{{$category->category_name}}">{{$category->category_name}}</option>
                      @endforeach

                    </select>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6">
                    <!-- select -->
                    <div class="form-group">
                    <label>Level</label>
                    <select class="custom-select select2bs4" id="level" name="level">
                        <option value="-1">--select--</option>

                        @foreach ($levels as $row)
                          <option value="{{$row->level_name}}"> {{$row->level_name}} </option>
                        @endforeach

                    </select>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="form-group">
                    <label>Base</label>
                    <select class="custom-select select2bs4" id="base" name="base">
                        <option value="-1">--select--</option>

                        @foreach ($bases as $row)
                         <option value="{{$row->base_name}}"> {{$row->base_name}} </option>
                        @endforeach

                    </select>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6">
                    <!-- select -->
                    <div class="form-group">
                    <label>Work Place</label>
                    <select class="custom-select select2bs4" id="work_place" name="work_place">
                        <option value="-1">--select--</option>

                        @foreach ($work_places as $row)
                          <option value="{{$row->work_place_name}}"> {{$row->work_place_name}}</option>
                        @endforeach

                    </select>
                    </div>
                </div>
            </div>

            <div class="mb-5">
              <button type="submit" id="search" class="btn btn-success">Generate</button>
            </div>
     </form>
    </div>
    <!-- /.card-header -->

     <div class="card-header">
      <div class="card-body table-responsive p-0" style="height: 500px;">
        <table id="all-employee" class="table table-bordered table-striped table-head-fixed text-nowrap">
          <thead>

          <tr>
            <th class="bg-success "> SL NO </th>
            <th class="bg-success fixed-column"> Staff Code </th>
            <th class="bg-success"> Name </th>
            <th class="bg-success"> Position </th>
            <th class="bg-success"> Department Code </th>
            <th class="bg-success"> Category </th>
            <th class="bg-success"> Level </th>
            <th class="bg-success"> Base </th>
            <th class="bg-success"> Work Place </th>
            <th class="bg-success"> Sub Location </th>
            <th class="bg-success"> Basic Salary </th>
            <th class="bg-success"> Gross Salary </th>
            <th class="bg-success"> Provident Amount </th>
            <th class="bg-success"> Joining Date </th>
            <th class="bg-success"> Ending Date </th>
            {{-- <th>Action</th> --}}
          </tr>
          </thead>
          <tbody>
        <?php $i=1;?>
          @foreach($employees as $employee)
            <tr>
              <td>{{ $i++ }}</td>

          @if ($employee->ending_date != null)
              <td class="bg-danger text-bold fixed-column">
                <a href="{{route('employee-details',$employee->staff_code)}}">
                  {{ sprintf("%04d", $employee->staff_code)}}
                </a>
              </td>
          @else 
              <td class="bg-success text-bold fixed-column">
                <a href="{{route('employee-details',$employee->staff_code)}}">
                  {{sprintf("%04d", $employee->staff_code)}}
                </a>
              </td>
          @endif
            <td class="text-bold">
              <a href="{{route('employee-details',$employee->staff_code)}}">
                {{$employee->first_name}} {{$employee->last_name}}
              </a>
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
          </tr>
          @endforeach
         </tbody>
        </table>
      </div>
     </div>
    <!-- /.card-body -->

    <div class="card-footer">
      <div class="float-right">
       </div>
    </div>
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

  @section('customjs')
  <script src="http://www.jqueryscript.net/demo/jQuery-Plugin-To-Convert-HTML-Table-To-CSV-tabletoCSV/jquery.tabletoCSV.js"></script>

  <script>

   $(document).ready(function(){
    $("tr").click(function() {
            console.log('clicked');
            $(this).addClass('selected').siblings().removeClass("selected");
    });


      $('.select2bs4').select2({
        theme: 'bootstrap4',
      });
    });

    </script>

    <script>
      function exportToExcel(tableID, filename){
        //  console.log(staff_code);
      var downloadLink;
      var dataType = 'application/vnd.ms-excel';
      var header = "<h2 style='text-align:center;'>Name : Arif Khan</h2><h2 style='text-align:center;'>Staff Code: 1111</h2>";
      var tableSelect = document.getElementById(tableID);
      var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
      // console.log(header);
      // Specify file name
      filename = filename?filename+'.xls':'excel_data.xls';
  
      // Create download link element
      downloadLink = document.createElement("a");
  
      document.body.appendChild(downloadLink);
  
      if(navigator.msSaveOrOpenBlob){
          var blob = new Blob(['\ufeff', tableHTML], {
              type: dataType
          });
          navigator.msSaveOrOpenBlob( blob, filename);
      }else{
          // Create a link to the file
          downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
  
          // Setting the file name
          downloadLink.download = filename;
  
          //triggering the function
          downloadLink.click();
      }
  }
    </script>
  @endsection




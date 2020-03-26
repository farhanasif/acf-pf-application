@extends('master')
@section('customcss') 

  <style>
    tfoot input {
        width: 100%;
        /* padding: 6px; */
        /* box-sizing: border-box; */
    }
     th input {
        width: 90%;
    }

    /* tfoot{
      display: table-header-group;
    } */
  </style>

  <link rel="stylesheet" href="{{asset('/')}}theme/plugins/datatables-fixedcolumns/css/fixedColumns.bootstrap4.min.css">
@endsection
@section('content')

<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>All Employee Information</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
          <li class="breadcrumb-item active"><a href="javascript:void(0)">Employee</a></li>
          <li class="breadcrumb-item active"><a href="javascript:void(0)">All Employee Information</a></li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<section class="content">
  <div class="card card-success card-outline">
    <div class="card-header">
          <h3 class="card-title">All Employee Information</h3>

        <div class="float-sm-right">
          <a href="" class="btn btn-success" data-toggle="modal" data-target="#modal-default">Batch Upload</a> 
          <a href="{{url('download_excel/employee/employee.xlsx')}}" class="btn btn-success">Download Sample Excel</a> 
          <a href="{{route('add-employee')}}" class="btn btn-success"><i class="fas fa-plus"></i> Add Employee</a>
        </div>


        <div class="col-md-6 offset-3 mt-2">
          @if ($message = Session::get('success'))
              <div class="alert alert-success alert-block text-center">
              <button type="button" class="close" data-dismiss="alert">×</button>
              <strong>{{ $message }}</strong>
              </div>
          @endif

          @if ($message = Session::get('danger'))
            <div class="alert alert-danger alert-block text-center">
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
    <!-- /.card-header -->
    <div class="card-body">
      {{-- <form role="form">
        <div class="row">

          <div class="col-sm-3">
            <div class="form-group">
            <label>Staff Code</label>
            <select class="custom-select select2bs4 " id="staff_code" name="staff_code">
                <option value="">--select--</option>

                @foreach ($employees as $employee)
                  <option value="{{ sprintf("%04d", $employee->staff_code)}}"> {{ sprintf("%04d", $employee->staff_code)}} </option>
                @endforeach
              
            </select>
            </div>
          </div>

            <div class="col-sm-3">
                <!-- select -->
                <div class="form-group">
                <label>Name</label>
                <select class="custom-select select2bs4" id="first_name" name="first_name">
                    <option value="">--select--</option>
                      @foreach ($employees as $employee)
                        <option value="{{$employee->first_name}} {{$employee->last_name}}"> {{$employee->first_name}} {{$employee->last_name}} </option>
                      @endforeach
                    
                </select>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                <label>Position</label>
                <select class="custom-select select2bs4" id="position" name="position">
                    <option value="">--select--</option>

                    @foreach ($employees as $employee)
                       <option value="{{$employee->position}}"> {{$employee->position}} </option>
                    @endforeach

                </select>
                </div>
            </div>

            <div class="col-sm-3">
                <!-- select -->
                <div class="form-group">
                <label>Department Code</label>
                <select class="custom-select select2bs4" id="department_code" name="department_code">
                    <option value="">--select--</option>

                    @foreach ($employees as $employee)
                      <option value="{{$employee->department_code}}"> {{$employee->department_code}} </option>
                    @endforeach

                </select>
                </div>
            </div>
            </div>

            <div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                    <label>Category</label>
                    <select class="custom-select select2bs4" id="category" name="category">
                        <option value="">--select--</option>

                        @foreach ($employees as $employee)
                          <option value="{{$employee->category}}"> {{$employee->category}} </option>
                        @endforeach

                    </select>
                    </div>
                </div>

                <div class="col-sm-3">
                    <!-- select -->
                    <div class="form-group">
                    <label>Level</label>
                    <select class="custom-select select2bs4" id="level" name="level">
                        <option value="">--select--</option>

                        @foreach ($employees as $employee)
                          <option value="{{$employee->level}}"> {{$employee->level}} </option>
                        @endforeach

                    </select>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                    <label>Base</label>
                    <select class="custom-select select2bs4" id="base" name="base">
                        <option value="">--select--</option>

                        @foreach ($employees as $employee)
                         <option value="{{$employee->base}}"> {{$employee->base}} </option>
                        @endforeach

                    </select>
                    </div>
                </div>

                <div class="col-sm-3">
                    <!-- select -->
                    <div class="form-group">
                    <label>Work Place</label>
                    <select class="custom-select select2bs4" id="work_place" name="work_place">
                        <option value="">--select--</option>

                        @foreach ($employees as $employee)
                          <option value="{{$employee->work_place}}"> {{$employee->work_place}}</option>
                        @endforeach

                    </select>
                    </div>
                </div>
            </div>

            <div class="mb-5">
              <button type="submit" id="search" class="btn btn-success">Search</button>
              <button type="submit" id="reset" class="btn btn-info float-sm-right">Reset</button>
            </div>
     </form> --}}
       
      <table id="all-employee" class="table table-bordered table-striped">
        <thead>

        <tr class="bg-success">
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
              <a href="{{route('employee-details',$employee->staff_code)}}">
                {{ sprintf("%04d", $employee->staff_code)}}
              </a>
            </td>
        <?php 
            }
            else { 
        ?>
              <td class="bg-success text-bold">
                <a href="{{route('employee-details',$employee->staff_code)}}">
                  {{sprintf("%04d", $employee->staff_code)}}
                </a>
              </td>
        <?php } ?>
          <td>
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
          {{-- <td >
              <a href="{{route('edit-employee',$employee->id)}}" class="btn btn-warning"><i class="fas fa-edit"></i></a>
              <a href="{{route('delete-employee',$employee->id)}}" onclick="ConfirmDelete()" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
          </td> --}}
        </tr>
        @endforeach
       </tbody>

        <tfoot>
          <tr>
            <th style="display:none;"></th>
            <th>Staff Code</th>
            <th>Name</th>
            <th>Position</th>
            <th>Department Code</th>
            <th>Category</th>
            <th>Level</th>
            <th>Base</th>
            <th>Work Place</th>
            <th>Sub Location</th>
            <th style="display:none;"></th>
            <th style="display:none;"></th>
            <th style="display:none;"></th>
            <th style="display:none;"></th>
            <th style="display:none;"></th>
          </tr>
        </tfoot>

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
 
  @section('customjs')  
      <script>

   $(document).ready(function(){

// ---------------------START TOP HEADING SEARCHING -------------------
    // $('#all-employee thead tr').clone(true).appendTo( '#all-employee thead' );
    // $('#all-employee thead tr:eq(1) th').each( function (i) {
    //     var title = $(this).text();
    //     $(this).html( '<input type="text" class="form-control" placeholder=" '+title+'" />' );
 
    //     $( 'input', this ).on( 'keyup change', function () {
    //         if ( table.column(i).search() !== this.value ) {
    //             table
    //                 .column(i)
    //                 .search( this.value )
    //                 .draw();
    //         }
    //     } );
    // } );
 
    // var table = $('#all-employee').DataTable( {
    //     orderCellsTop: true,
    //     fixedHeader: true,
    //     scrollX:'50vh',
    //     scrollY:'50vh',
    //     fixedColumns: true,
    //     fixedColumns:   {
    //         leftColumns: 2
    //     }
    // } );
// ---------------------END TOP HEADING SEARCHING -------------------



// ---------------------START BOTTOM SEARCHING -------------------
    $('#all-employee tfoot th').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text"  class="form-control" placeholder="'+title+'" />' );
    } );
 
    // DataTable
    // var table = $('#all-employee').DataTable();
    
    var table = $('#all-employee').DataTable({
          "info": true,
          "autoWidth": false,
          scrollX:'50vh', 
          scrollY:'50vh',
          scrollCollapse: true,
          fixedColumns: true,
          fixedColumns:   {
            leftColumns: 2
        }
      });
 
    // Apply the search
    table.columns().every( function () {
        var that = this;
 
        $( 'input', this.footer() ).on( 'keyup change clear', function () {
            if ( that.search() !== this.value ) {
                that
                    .search( this.value )
                    .draw();
            }
        } );
    } );
// ---------------------END BOTTOM SEARCHING -------------------
    

// ---------------------START DROPDOWN SEARCHING -------------------

    // $('#all-employee').DataTable( {

    //             scrollX:'50vh', 
    //       scrollY:'50vh',
    //       scrollCollapse: true,
    //       fixedColumns: true,
    //       fixedColumns:   {
    //         leftColumns: 2
    //     },

    //     initComplete: function () {
    //         this.api().columns().every( function () {
    //             var column = this;
    //             var select = $('<select class="select2bs4" style="width:120px;" ><option value=""></option></select>')
    //                 .appendTo( $(column.footer()).empty() )
    //                 .on( 'change', function () {
    //                     var val = $.fn.dataTable.util.escapeRegex(
    //                         $(this).val()
    //                     );
 
    //                     column
    //                         .search( val ? '^'+val+'$' : '', true, false )
    //                         .draw();
    //                 } );
 
    //             column.data().unique().sort().each( function ( d, j ) {
    //                 select.append( '<option value="'+d+'">'+d+'</option>' )
    //             } );
    //         } );
    //     }
    // } );

// ---------------------END DROPDOWN SEARCHING -------------------




    //START CUSTOM SEARCH 
    // fill_datatable();
    
    // function fill_datatable(staff_code = '', first_name = '', category = '', level = '', base ='',work_place = '',position = '',department_code = '')
    // {
    //     var dataTable = $('#all-employee').DataTable({
    //         processing: true,
    //         serverSide: true,
    //         ajax:{
    //             url: "{{ route('custom-search-employee') }}",
    //             method:post,
    //             data:{
    //               staff_code:staff_code, 
    //               first_name:first_name,
    //               category:category, 
    //               level:level,
    //               base:base, 
    //               work_place:work_place,
    //               position:position, 
    //               department_code:department_code
    //               }
    //         },
    //         columns: [
    //             {
    //                 data:'staff_code',
    //                 name:'staff_code'
    //             },
    //             {
    //                 data:'first_name',
    //                 name:'first_name'
    //             },
    //             {
    //                 data:'category',
    //                 name:'category'
    //             },
    //             {
    //                 data:'level',
    //                 name:'level'
    //             },
    //             {
    //                 data:'base',
    //                 name:'base'
    //             },
    //             {
    //                 data:'position',
    //                 name:'position'
    //             },

    //             {
    //                 data:'department_code',
    //                 name:'department_code'
    //             }
    //         ]
    //     });
    // }

    // $('#search').click(function(){
    //     var staff_code = $('#staff_code').val();
    //     var first_name = $('#first_name').val();
    //     var category = $('#category').val();
    //     var level = $('#level').val();
    //     var base = $('#base').val();
    //     var position = $('#position').val();
    //     var department_code = $('#department_code').val();

    //     if(staff_code != '' &&  first_name != '' &&  category != '' &&  level != '' &&  base != '' &&  position != '' &&  department_code != '')
    //     {
    //         $('#all-employee').DataTable().destroy();
    //         fill_datatable(staff_code, first_name,category,level,base,position,department_code);
    //     }

    //     else if(staff_code != '')
    //     {
    //       $('#all-employee').DataTable().destroy();
    //         fill_datatable(staff_code);
    //     }

    //     else if(first_name != '')
    //     {
    //       $('#all-employee').DataTable().destroy();
    //         fill_datatable(first_name);
    //     }

    //     else if(category != '')
    //     {
    //       $('#all-employee').DataTable().destroy();
    //         fill_datatable(category);
    //     }

    //     else if(level != '')
    //     {
    //       $('#all-employee').DataTable().destroy();
    //         fill_datatable(category);
    //     }

    //     else if(base != '')
    //     {
    //       $('#all-employee').DataTable().destroy();
    //         fill_datatable(base);
    //     }

    //     else if(position != '')
    //     {
    //       $('#all-employee').DataTable().destroy();
    //         fill_datatable(position);
    //     }

    //     else if(department_code != '')
    //     {
    //       $('#all-employee').DataTable().destroy();
    //         fill_datatable(department_code);
    //     }

    //     else
    //     {
    //         alert('Select Both filter option');
    //     }
    // });

    // $('#reset').click(function(){
    //     $('#filter_gender').val('');
    //     $('#filter_country').val('');
    //     $('#all-employee').DataTable().destroy();
    //     fill_datatable();
    // });

    //END CUSTOM SEARCH 

      // $('#all-employee').DataTable({
      //     "info": true,
      //     "autoWidth": false,
      //     scrollX:'50vh', 
      //     scrollY:'50vh',
      //     scrollCollapse: true,
      //     fixedColumns: true,
      //     fixedColumns:   {
      //       leftColumns: 2
      //   }
      // });

      $('.select2bs4').select2({
        theme: 'bootstrap4',
      })

    });
  
    </script>
    <script src="{{ asset('theme/plugins/datatables-fixedcolumns/js/dataTables.fixedColumns.min.js') }}"></script>

  @endsection

 


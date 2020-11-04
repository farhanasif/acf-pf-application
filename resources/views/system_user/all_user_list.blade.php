
@extends('master')

@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>All User Role Information </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active"><a href="#">User Rolet</a></li>
                        <li class="breadcrumb-item active"><a href="#">All User Role Information</a></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">

        <div class="card card-success card-outline">
            <div class="card-header">
                <h3 class="card-title">All User Role Information</h3>
                <div class="float-right">
                    <button type="submit" id="all-user-role-download" class="btn btn-success">Download Excel</button>
                    <a href="{{url('new/system/user')}}" class="btn btn-success"><i class="fas fa-plus"></i> Add User Role</a>
                </div>
                @include('message')

            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="all-user-role" class="table table-bordered table-striped">
                    <thead>
                    <tr class="bg-success">
                        <th style="width: 5px;">SL NO</th>
                        <th style="width: 15px;">Name</th>
                        <th style="width: 5px;">Staff Code</th>
                        <th style="width: 15px;">Email</th>
                        <th style="width: 5px;">User Type</th>
                        <th style="width: 20px;">Role</th>
                        <th style="width: 20px;">Mobile</th>
                        <th style="width: 20px">Designation</th>
                        <th style="width: 5px;">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i = 1;?>
                    @foreach ($users as $user_role)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$user_role->name}}</td>
                            <td>{{$user_role->staff_code}}</td>
                            <td>{{$user_role->email}}</td>
                            <td>{{$user_role->user_type}}</td>
                            <td>
                                @if($user_role->role=='sub-admin')
                                    <button class="btn btn-success btn-xs"><i class="fa fa-check-circle"></i>sub-admin</button>
                                @elseif($user_role->role=='editor')
                                    <button class="btn btn-warning btn-xs"><i class="fa fa-check-circle"></i> editor</button>
                                @else
                                    <button class="btn btn-info btn-xs"><i class="fa fa-check-circle"></i>modaretor</button>
                                @endif
                            </td>
                            <td>{{$user_role->mobile}}</td>
                            <td>{{$user_role->designation}}</td>
                            <td>
{{--                                @php--}}
{{--                                    $auth_user_permissions = auth('system_admin')->user()->permissions--}}
{{--                                    ->pluck('name')->toArray();--}}
{{--                                    $hasViewPermission = in_array('view',$auth_user_permissions);--}}
{{--                                    $hasDeletePermission = in_array('delete',$auth_user_permissions);--}}
{{--                                @endphp--}}
{{--                                @if($hasViewPermission)--}}
                                <a href="{{route('edit.system.user',$user_role->id)}}" class="btn btn-info btn-xs"><i class="fas fa-edit"></i></a>
{{--                                @endif--}}
{{--                                @if($hasDeletePermission)--}}
                                <button id="{{$user_role->id}}" class="btn btn-danger btn-xs delete_system_user"><i class="fas fa-trash-alt "></i></button>
{{--                                @endif    --}}
                            </td>
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

@section('customjs')
    <script src="http://www.jqueryscript.net/demo/jQuery-Plugin-To-Convert-HTML-Table-To-CSV-tabletoCSV/jquery.tabletoCSV.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8.11.5/dist/sweetalert2.js"></script>
    <script>

        $(document).ready( function(){

            // START USER ROLE TABLE DATA DOWNLOAD CLICK FUNCTION
            $( "#all-user-role-download" ).click(function() {
                $("#all-user-role").tableToCSV();
            });
            // END USER ROLE TABLE DATA DOWNLOAD CLICK FUNCTION

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

            $('#all-user-role').DataTable({
                "info": true,
                "autoWidth": false,
                scrollX:'50vh',
                scrollY:'50vh',
            });
        });
     //Delete
        $('.delete_system_user').click(function () {
            var id = $(this).attr('id');
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then(function(result){
                if (result.value) {
                    // delet by ajax
                    var url = "{{url('delete/system/user')}}";
                    $.ajax({
                        /*config part*/
                        url:url+"/"+id,
                        type:"GET",
                        dataType:"json",
                        /*Config part*/
                        beforeSend:function () {
                            Swal.fire({
                                title: 'Deleting Data.......',
                                html:"<i class='fa fa-spinner fa-spin' style='font-size: 24px'></i>",
                                allowOutsideClick:false,
                                showCancelButton: false,
                                showConfirmButton: false
                            });
                        },
                        success:function (response) {
                            Swal.close();
                            if(response==="success"){
                                Swal.fire({
                                    title: 'Success',
                                    text: "You Have Succefully Deleted The System User",
                                    type: 'success',
                                    confirmButtonText: 'OK'
                                }).then(function(result){
                                    if (result.value) {
                                        window.location.reload();
                                    }
                                });
                            }
                            console.log(response);
                        },
                        error:function (error) {
                            Swal.fire({
                                title: 'Error',
                                text:'Something Went Wrong',
                                type:'error',
                                showConfirmButton: true
                            });
                            console.log(error)
                        }
                    })
                }
            });
        });

    </script>
@endsection
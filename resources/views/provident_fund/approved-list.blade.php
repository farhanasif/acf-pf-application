
@extends('master')
@section('customcss')

@endsection
@section('stylesheet')
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@8.10.0/dist/sweetalert2.css" rel="stylesheet">
@endsection
@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>All PF Deposit Information</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">PF Deposit</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">All PF Deposit Information</a></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">

        <div class="card card-success card-outline">
            <div class="card-header">
                <h3 class="card-title">All PF Deposit Information</h3>
                <div class="float-sm-right">
                    <button type="submit" id="all-pf-deposit-download" onclick="exportToExcel('all-pf-deposit','all-pf-deposit')" class="btn btn-success">Download Excel</button>
                    {{-- <a href="{{route('pf-deposit-export')}}" class="btn btn-success"> Download Excel</a> --}}
                    <a href="" class="btn btn-success" data-toggle="modal" data-target="#pf-deposit">Batch Upload</a>
                    <a href="{{url('download_excel/pf_deposit/pf-deposit.xlsx')}}" class="btn btn-success">Download Sample Excel</a>
                    <a href="{{route('add-provident-fund')}}" class="btn btn-success"><i class="fas fa-plus"></i> Add PF Deposit</a>
                </div>

                @include('message')

            </div>
            <div class="float-sm-left">
                <button class="btn btn-danger btn-sm" id="delete_all"><i class="fa fa-trash"></i> Delete</button>
                <button class="btn btn-success btn-sm" id="active_all"><i class="fa fa-check"></i> Approved?</button>
                <button class="btn btn-warning btn-sm" id="deactivate_all"><i class="fa fa-exclamation-circle"></i> Inpproved?</button>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0" style="height: 500px;">
                <br>
                <table id="all-pf-deposit" class="table table-bordered table-striped table-head-fixed text-nowrap">
                    <thead>
                    <tr>
                        <th style="width: 5px;" class="bg-success">NO</th>
{{--                        <th style="width: 10px;" class="bg-success">Deposit Date</th>--}}
                        <th style="width: 5px;" class="bg-success">Staff Code</th>
                        <th style="width: 5px;" class="bg-success">Old Own and Org PF</th>
                        {{-- <th style="width: 5px;" class="bg-success">Old Org PF Deposit</th> --}}
                        <th style="width: 5px;" class="bg-success">Change Own and Org PF</th>
                        {{-- <th style="width: 5px;" class="bg-success">Change Org PF Deposit</th> --}}
                        <th style="width: 5px;" class="bg-success">Old Total PF</th>
                        <th style="width: 5px;" class="bg-success">Change Total PF</th>
                        <th style="width: 5px;" class="bg-success">Status</th>
                        <th style="width: 5px;" class="bg-success">Action</th>
                    </tr>
                    </thead>
                    <tbody>
<!--                    --><?php //$i=1;?>
                    @foreach($provident_funds as $provident_fund)
                        <tr>
                            <td><input type="checkbox" name="deposite_ids[]" value="{{ $provident_fund->id }}"></td>
{{--                            <td>{{$provident_fund->deposit_date}}</td>--}}
                            <td>{{ sprintf("%04d", $provident_fund->staff_code)}}</td>
                            <td>{{$provident_fund->old_own_pf}} | {{$provident_fund->old_organization_pf}}</td>
                            {{-- <td>{{$provident_fund->old_organization_pf}}</td> --}}
                            <td> {{ $provident_fund->own_pf }} | {{ $provident_fund->organisation_pf }} </td>
                            {{-- <td> {{ $provident_fund->organisation_pf }} </td> --}}
                            <td>{{ $provident_fund->old_total_pf}}</td>
                            <td>{{ $provident_fund->total_pf }}</td>

                            <td>
                                @if ($provident_fund->status==1)
                                <button class="btn btn-success btn-xs">Approved</button>
                                @else
                                <button class="btn btn-warning btn-xs">Inapproved</button>

                                @endif
                            </td>
                            <td>
{{--                                <a href="#" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>--}}
                                <button type="button" onclick="deletesDeposit('.$provident_fund->id.')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button>
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

    <!-- START PF DEPOSIT BATCH UPLOAD MODAL -->
    <div class="modal fade" id="pf-deposit">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">PF Deposit Bacth Upload</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('save-pf-deposit-batch')}}" method="post" enctype="multipart/form-data">
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
    <!-- END PF DEPOSIT BATCH UPLOAD MODAL -->
@endsection

@section('customjs')
    <script src="http://www.jqueryscript.net/demo/jQuery-Plugin-To-Convert-HTML-Table-To-CSV-tabletoCSV/jquery.tabletoCSV.js"></script>
    <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8.10.0/dist/sweetalert2.js"></script>
    <script>

        $(document).ready(function(){

            $('.select2bs4').select2({
                theme: 'bootstrap4',
            });

            // START ALL EMPLOYEE TABLE DATA DOWNLOAD CLICK FUNCTION
            $( "#all-pf-deposit-download" ).click(function() {
                $("#all-pf-deposit").tableToCSV();
            });
// END ALL EMPLOYEE TABLE DATA DOWNLOAD CLICK FUNCTION

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

//$('#all-pf-deposit').DataTable({
            // "info": true,
            // "autoWidth": false,
            // scrollX:'50vh',
            // scrollY:'50vh',
            //scrollCollapse: true,
            //fixedColumns: {
            // leftColumns: 2
            //}
            //});
        });

       $(function () {
        $('#active_all').click(function () {
            var ids = [];
            // get all selected Deposit id
            $.each($("input[name='deposite_ids[]']:checked"), function(){
                ids.push($(this).val());
            });
            //alert(ids);
            if (ids.length!==0) {
                var url = "{{ url('activate/all/pf-deposite') }}";
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You want to approve?",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, Approve'
                }).then(function(result) {
                    if (result.value) {
                        $.ajax({
                            url: url,
                            type: 'POST',
                            data: {"deposite_ids": ids, "_token": "{{ csrf_token() }}"},
                            dataType: "json",
                            beforeSend:function () {
                                Swal.fire({
                                    title: 'Approving Deposite.......',
                                    showConfirmButton: false,
                                    html: '<i class="fa fa-spinner fa-spin" style="font-size:24px"></i>',
                                    allowOutsideClick: false
                                });
                            },
                            success:function (response) {
                                Swal.close();
                                console.log(response);
                                if (response==="success"){
                                    Swal.fire({
                                        title: 'Successfully Activated',
                                        type: 'success',
                                        confirmButtonColor: '#3085d6',
                                        confirmButtonText: 'Ok',
                                        allowOutsideClick: false
                                    }).then(function(result) {
                                        if (result.value) {
                                            window.location.reload();
                                        }
                                    });
                                }
                            },
                            error:function (error) {
                                Swal.close();
                                console.log(error);
                            }
                        })
                    }
                });
            }else{
                Swal.fire(
                    'Error',
                    'Select The Deposite First!',
                    'error'
                )
            }
        });

        // deactivate all selected Deposit
        $('#deactivate_all').click(function () {
            var ids = [];
            // get all selected Deposit id
            $.each($("input[name='deposite_ids[]']:checked"), function(){
                ids.push($(this).val());
            });
            if (ids.length!==0) {
                var url = "{{ url('deactivate/all/pf-deposite') }}";
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You want to Deactivate?",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, Deactivate'
                }).then(function(result) {
                    if (result.value) {
                        $.ajax({
                            url: url,
                            type: 'POST',
                            data: {"deposite_ids": ids, "_token": "{{ csrf_token() }}"},
                            dataType: "json",
                            beforeSend:function () {
                                Swal.fire({
                                    title: 'Deactivating Deposite.......',
                                    showConfirmButton: false,
                                    html: '<i class="fa fa-spinner fa-spin" style="font-size:24px"></i>',
                                    allowOutsideClick: false
                                });
                            },
                            success:function (response) {
                                Swal.close();
                                console.log(response);
                                if (response==="success"){
                                    Swal.fire({
                                        title: 'Successfully Deactivated',
                                        type: 'success',
                                        confirmButtonColor: '#3085d6',
                                        confirmButtonText: 'Ok',
                                        allowOutsideClick: false
                                    }).then(function(result) {
                                        if (result.value) {
                                            window.location.reload();
                                        }
                                    });
                                }
                            },
                            error:function (error) {
                                Swal.close();
                                console.log(error);
                            }
                        })
                    }
                });
            }else{
                Swal.fire(
                    'Error',
                    'Select The Deposite First!',
                    'error'
                )
            }
        });

           // delete all selected Deposit id
           $('#delete_all').click(function () {
               var ids = [];
               // get all selected user id
               $.each($("input[name='deposite_ids[]']:checked"), function(){
                   ids.push($(this).val());
               });
               if (ids.length!==0) {
                   var url = "{{ url('delete/pf-deposite') }}";
                   Swal.fire({
                       title: 'Are you sure?',
                       text: "You want to delete?",
                       type: 'warning',
                       showCancelButton: true,
                       confirmButtonColor: '#3085d6',
                       cancelButtonColor: '#d33',
                       confirmButtonText: 'Yes, Delete it!'
                   }).then(function(result) {
                       if (result.value) {
                           $.ajax({
                               url: url,
                               type: 'POST',
                               data: {"deposite_ids": ids, "_token": "{{ csrf_token() }}"},
                               dataType: "json",
                               beforeSend:function () {
                                   Swal.fire({
                                       title: 'Deleting Data.......',
                                       showConfirmButton: false,
                                       html: '<i class="fa fa-spinner fa-spin" style="font-size:24px"></i>',
                                       allowOutsideClick: false
                                   });
                               },
                               success:function (response) {
                                   Swal.close();
                                   console.log(response);
                                   if (response==="success"){
                                       Swal.fire({
                                           title: 'Successfully Deleted',
                                           type: 'success',
                                           confirmButtonColor: '#3085d6',
                                           confirmButtonText: 'Ok'
                                       }).then(function(result) {
                                           if (result.value) {
                                               window.location.reload();
                                           }
                                       });
                                   }
                               },
                               error:function (error) {
                                   Swal.close();
                                   console.log(error);
                               }
                           })
                       }
                   });
               }else{
                   Swal.fire(
                       'Error',
                       'Select The Deposite First!',
                       'error'
                   )
               }
           });

       });

        function deletesDeposit(id){
            Swal.fire({
                title: 'Are you sure?',
                text: "You want to delete?",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Delete it!'
            }).then(function(result) {
                if (result.value) {
                    var url = "{{url('/delete/pf-deposite/')}}"+"/"+id;
                    $.ajax({
                        url:url,
                        type:'GET',
                        contentType:false,
                        processData:false,
                        beforeSend:function () {
                            Swal.fire({
                                title: 'Deleting Data.......',
                                showConfirmButton: false,
                                html: '<i class="fa fa-spinner fa-spin" style="font-size:24px"></i>',
                                allowOutsideClick: false
                            });
                        },
                        success:function (response) {
                            Swal.close();
                            console.log(response);
                            if (response==="success"){
                                Swal.fire({
                                    title: 'Successfully Deleted',
                                    type: 'success',
                                    confirmButtonColor: '#3085d6',
                                    confirmButtonText: 'Ok'
                                }).then(function(result) {
                                    if (result.value) {
                                        window.location.reload();
                                    }
                                });
                            }
                        },
                        error:function (error) {
                            Swal.close();
                            console.log(error);
                        }
                    })
                }
            });
        }

    </script>
@endsection

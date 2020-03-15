
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AAH | Provident Fund App</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

     @include('includes.header')
     @yield('customcss')

</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-dark navbar-success">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="javascript:void(0);" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="javascript:void(0);" class="nav-link">Contact</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-user"></i>
          <span class="badge badge-danger navbar-badge">3</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="{{ asset('theme/dist/img/user1-128x128.jpg')}}" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  {{ Auth::user()->name }}
                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">{{ Auth::user()->email }}</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> Administrator</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <!-- <a href="{{ url('/logout') }}" class="dropdown-item dropdown-footer">LogOut</a> -->
            <a class="dropdown-item" href="{{ route('logout') }}"
               onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
            </a>
          
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->



@if(Auth::guest())
    @include('includes.sidenavbar_root') 
@elseif(Auth::user()->role==0)
    @include('includes.sidenavbar')
@elseif(Auth::user()->role==1)
    @include('includes.sidenavbar_user')     
@endif
  <!-- Main Sidebar Container -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">


    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
  @yield('content')
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@include('includes.main_footer')

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

@include('includes.footer')

@yield('customjs')


{{-- <script>
  $(function () {
    // $("#example1").DataTable();
    $('#example1').DataTable({
      //    "paging": true,
      //   // "lengthChange": false,
      // // "searching": false,
      //   "ordering": true,
      // "info": true,
      // "autoWidth": false,
      // scrollX:'50vh',
      // scrollY:'50vh',
      // scrollCollapse: true,
        "info": true,
        "autoWidth": false,
        scrollX:'50vh', 
        scrollY:'50vh',
        scrollCollapse: true,
    });

    $('.input-daterange').datepicker({});
    
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

  });
</script> --}}

{{-- <script>

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

  var table;
  $(function () {
    table = $("#example1").DataTable({
        "info": true,
        "autoWidth": false,
        scrollX:'50vh',
        scrollY:'50vh',
        scrollCollapse: true,
        fixedColumns:   {
            leftColumns: 1,
            // rightColumns: 1
        }
    });
    
    $( "#generate" ).click(function() {
        from_date = $('#from_date').val();
        to_date = $('#to_date').val();
        console.log("data");
        $.ajax({
            type: 'GET',
            url: './get-fund-data',
            data: {
                from_date: from_date,
                to_date: to_date
            },
            dataType: 'json',
            success: function (data) {
                console.log(data);
                table.destroy();
                $("#example1 thead").empty();
                $("#example1 tbody").empty();
                $("#example1 thead").append('<tr>'+
                    '<th>Third Part</th>'+
                    '<th>First Name</th>'+
                    '<th>Last Name</th>'+
                    '<th>Category</th>'+
                    '<th>Level</th>'+
                    '<th>Entry Date</th>'+
                    '<th>Contract<br />Start Date</th>'+
                    '<th>End Date</th>'+
                    '<th>Workplace</th>'+
                    '<th>Month<br />of Payment</th>'+
                    '<th>Basic Salary</th>'+
                    '<th>Gross Salary</th>'+
                    '<th>Employee</th>'+
                    '<th>ACF</th>'+
                    '<th>Total</th>'+
                '</tr>');
                $.each(data, function(index, element) {
                $("#example1 tbody").append("<tr>"
                        +"<td>"+element.staff_code+"</td>"
                        +"<td>"+element.first_name+"</td>"
                        +"<td>"+element.last_name+"</td>"
                        +"<td>"+element.category+"</td>"
                        +"<td>"+element.level+"</td>"
                        +"<td>"+element.joining_date+"</td>"
                        +"<td>"+element.joining_date+"</td>"
                        +"<td>"+element.ending_date+"</td>"
                        +"<td>"+element.work_place+"</td>"
                        +"<td>"+element.PaymentMonth+"</td>"
                        +"<td>"+element.basic_salary+"</td>"
                        +"<td>"+element.gross_salary+"</td>"
                        +"<td>"+element.own_pf+"</td>"
                        +"<td>"+element.organization_pf+"</td>"
                        +"<td>"+element.total_pf+"</td>"
                        +"</tr>");
                });
                table = $('#example1').DataTable({
                    "info": true,
                    "autoWidth": false,
                    scrollX:'50vh',
                    scrollY:'50vh',
                    scrollCollapse: true,
                });
            }
        });
        alert( "Handler for .click() called. - "+from_date );
    });
    $( "#download" ).click(function() {
        from_date = $('#from_date').val();
        to_date = $('#to_date').val();
        //
        alert( "Handler for download .click() called." );
    });
  });
</script> --}}

</body>
</html>

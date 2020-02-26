
@extends('master')

@section('content')

<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>All Provident Fund </h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active"><a href="#">Provident</a></li>
          <li class="breadcrumb-item active"><a href="#">All Provident Fund</a></li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>
<section class="content">

  <div class="card card-success card-outline">
    <div class="card-header">
      <h3 class="card-title">All Provident Fund Information</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th>SL NO</th>
          <th>Deposit Date</th>
          <th>Staff Code</th>
          <th>Own Provident Fund</th>
          <th>Organization Provident Fund</th>
          <th>Total Provident Fund</th>
          <th>Action</th>
        </tr>
        </thead>
        <tbody>
          <?php $i=1;?>
          @foreach($provident_funds as $provident_fund)
        <tr>
          <td>{{$i++}}</td>
          <td>{{$provident_fund->deposit_date}}</td>
          <td>{{$provident_fund->staff_code}}</td>
          <td>{{$provident_fund->own_pf}}</td>
          <td>{{$provident_fund->organization_pf}}</td>
          <td>{{$provident_fund->total_pf}}</td>
          <td class="row">
              <a href="{{route('edit-provident-fund',$provident_fund->id)}}" class="btn btn-warning"><i class="fas fa-edit"></i></a>
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

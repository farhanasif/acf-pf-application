@extends('welcome')
@section('content')
<section class="content">

  <div class="card card-success card-outline">
   <div class="row">
    <div class="card-header">
        <h3 class="card-title">All Provident Fund Information</h3>
      </div>
      <div>
          <input type="date" class="form-control">
      </div>
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
          <td>
              <a href="#" class="btn btn-warning"><i class="fas fa-edit"></i></a>
          </td>
        </tr>
        @endforeach

        </tfoot>
      </table>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->

</section>
@endsection

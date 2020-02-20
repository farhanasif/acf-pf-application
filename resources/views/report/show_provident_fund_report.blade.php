@extends('master')
@section('content')
<section class="content">

  <div class="card card-success card-outline">
   <div class="row">
    {{-- <div class="card-header">
        <h3 class="card-title">All Provident Fund Information</h3>
      </div> --}}
      <!-- /.card-header -->
      <div class="card-body">
        <div class="row">
          <div class="col-md-3">
            <div class="form-group input-daterange">
              {{-- <label>Months</label> --}}
              {{-- <select class="form-control select2" style="width: 100%;">
                <option selected="selected">--select--</option>
                <option>January</option>
                <option>February</option>
                <option>March</option>
                <option>April</option>
                <option>May</option>
                <option>June</option>
                <option>Julay</option>
              </select> --}}

              <input type="text" name="from_date" class="form-control" placeholder="From Date">
            </div>
          </div>

          <div class="col-md-3">
            <div class="form-group input-daterange">
              {{-- <label>Year</label>
              <select class="form-control" style="width: 100%;">
                <option selected="selected">--select--</option>
                <option>2020</option>
                <option>2019</option>
                <option>2018</option>
                <option>2017</option>
                <option>2016</option>
                <option>2015</option>
                <option>2014</option>
              </select> --}}
              <input type="text" name="from_date" class="form-control"  placeholder="To Date">
            </div>
          </div>
          <div class="col-md-1">
            <div class="form-group">
             <input type="submit" class="form-control btn btn-success">
            </div>
          </div>
          <div class="col-md-1">
            {{-- <div class="form-group">
             <input type="submit" class="form-control btn btn-default" value="Refresh">
            </div> --}}
          </div>
          <div class="col-md-1"></div>

          <div class="col-md-3 float-right">
            <div class="form-group ">
              {{-- <label>Download</label>
              <select class="form-control select2" style="width: 100%;">
                <option selected="selected">--select--</option>
                <option>CSV</option>
                <option>XLSX</option>
                <option>XLS</option>
                <option>PDF</option>
              </select> --}}


            </div>
          </div>
        </div>
      </div>
      <!-- /.card-body -->
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

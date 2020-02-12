@extends('welcome')

@section('content')
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
          <th>First Name</th>
          <th>Last Name</th>
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
          <th>Provident Percentage</th>
          <th>Joining Date</th>
          <th>Ending Date</th>
          <th>Status</th>
          <th>Created By</th>
          <th>Updated By</th>
          <th>Action</th>
        </tr>
        </thead>
        <tbody>

        <tr>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td >
              <a href="#" class="btn btn-warning"><i class="fas fa-edit"></i></a>
              <a href="#" onclick="ConfirmDelete()" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
          </td>
        </tr>

        </tfoot>
      </table>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->

</section>
@endsection

<script>
    function ConfirmDelete()
    {
      var user = confirm("Are you sure you want to delete?");
      if (user)
          return true;
      else
        return false;
    }
</script>

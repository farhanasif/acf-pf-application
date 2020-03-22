@extends('master')

@section('content')

<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>All Category Information </h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active"><a href="#">Category</a></li>
          <li class="breadcrumb-item active"><a href="#">All Category Information</a></li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>


<section class="content">
  <div class="card card-success card-outline">
    <div class="card-header">
      <div class="row">
        <div class="col-sm-6">
          <h3 class="card-title">All Category Information</h3>
        </div>
        <div class="col-md-6 ">
            <a href="{{route('add-category')}}" class="btn btn-success float-right"><i class="fas fa-plus"></i> Add Category</a>
        </div>
      </div>

      <div class="col-md-6 offset-3 mt-2">
          @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
              <button type="button" class="close" data-dismiss="alert">×</button>
              <strong>{{ $message }}</strong>
            </div>
          @endif
  
          @if ($message = Session::get('danger'))
            <div class="alert alert-danger alert-block">
              <button type="button" class="close" data-dismiss="alert">×</button>
              <strong>{{ $message }}</strong>
            </div>
          @endif
      </div>

    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="all-category" class="table table-bordered table-striped">
          <thead>
            <tr class="bg-success">
              <th>SL NO</th>
              <th>Category Name</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
              <?php $i=1;?>
              @foreach ($categories as $category)
              <tr>
                <td>{{ $i++}}</td>
                <td>{{$category->category_name}}</td>
                <td>
                      <a href="{{route('edit-category',$category->id)}}" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                      <a href="{{route('delete-category',$category->id)}}" class="btn btn-danger"><i class="fas fa-trash"></i></a>
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
<script>

  $(document).ready( function(){
    $('#all-category').DataTable({
          "info": true,
          "autoWidth": false,
          scrollX:'50vh', 
          scrollY:'50vh',
    });
  });

</script>
@endsection
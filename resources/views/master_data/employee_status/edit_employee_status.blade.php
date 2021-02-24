@extends('master')

@section('content')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Edit Employee Status Information</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active"><a href="#">Employee Status</a></li>
          <li class="breadcrumb-item active"><a href="#">Edit Employee Status Information</a></li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>


   <div class="card card-success card-outline">
        <div class="card-header">
          <h3 class="card-title">Edit Employee Status Information</h3>
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

        <div class="card-body">
          <!-- /.card -->
            <!-- Horizontal Form -->
        <form class="form-horizontal form-label-left" action="{{route('update-employee-status',$employee_status->id)}}" method="post">
             @csrf
            <div class="form-group row">
              <label for="name" class="col-form-label col-md-3 col-sm-4 label-align">Status Name</label>
              <div class="col-md-6 col-sm-6 ">
              <input type="text" class="form-control" name="status_name" placeholder="Status Name" value="{{$employee_status->status_name}}">
              </div>
            </div>
              
            <div class="form-group row">
              <label for="name" class="col-form-label col-md-3 col-sm-4 label-align">Description</label>
              <div class="col-md-6 col-sm-6 ">
                <textarea name="description" class="form-control" id="" cols="30" rows="3" placeholder="Description">{{$employee_status->description}}</textarea>
              </div>
            </div>

            <div class="form-group row">
                <label for="email" class="col-form-label col-md-3 col-sm-4 label-align"></label>
                <div class="col-md-6 col-sm-6">
                    <button  type="submit" class="btn btn-success ">Update</button>
                    <a href="{{route('all-employee-status')}}" class="btn btn-info ml-2">Back</a>
                </div>
            </div>

			</form>
			            <!-- /.card -->
        </div>
      </div>
@endsection

@extends('master')

@section('content')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Edit Duration Information</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active"><a href="#">Duration</a></li>
          <li class="breadcrumb-item active"><a href="#">Edit Duration Information</a></li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>


   <div class="card card-success card-outline">
        <div class="card-header">
          <h3 class="card-title">Edit Duration Information</h3>
        </div>

          <div class="col-md-5 text-center offset-3 mt-2">
                @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
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
        <form class="form-horizontal form-label-left" action="{{route('update-duration',$duration->id)}}" method="post">
             @csrf
			   <div class="form-group row">
			    <label for="name" class="col-form-label col-md-3 col-sm-4 label-align">Name</label>
			    <div class="col-md-6 col-sm-6 ">
                <input type="text" class="form-control" name="name" placeholder="Name" value="{{$duration->name}}">
			    </div>
              </div>
              
              <div class="form-group row">
			    <label for="department_code" class="col-form-label col-md-3 col-sm-4 label-align">Duration</label>
			    <div class="col-md-6 col-sm-6 ">
			    	 <input type="text" class="form-control" name="duration" placeholder="Duration" value="{{$duration->duration}}">
			    </div>
              </div>

            <div class="form-group row">
                <label for="email" class="col-form-label col-md-3 col-sm-4 label-align"></label>
                <div class="col-md-6 col-sm-6">
                    <button  type="submit" class="btn btn-success ">Update</button>
                    <a href="{{route('all-duration')}}" class="btn btn-info ml-3">Back</a>
                </div>
            </div>

			</form>
			            <!-- /.card -->
        </div>
      </div>
@endsection

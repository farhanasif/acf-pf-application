@extends('master')

@section('content')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Edit Time Schedule</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active"><a href="#">Time Schedule</a></li>
          <li class="breadcrumb-item active"><a href="#">Edit Time Schedule</a></li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

   <div class="card card-success card-outline">
        <div class="card-header">
          <h3 class="card-title">Edit Time Schedule</h3>
        </div>

        <div class="col-md-5 offset-3 mt-2">
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
        <form class="form-horizontal form-label-left " action="{{route('update-time-schedule',$time_schedule->id)}}" method="post">
             @csrf
            <div class="form-group row">
              <label for="name" class="col-form-label col-md-3 col-sm-4 label-align">Start Date</label>
              <div class="col-md-6 col-sm-6 ">
                <input type="date" name="start_date" class="form-control">
              </div>
            </div>
              
            <div class="form-group row ">
              <label for="name" class="col-form-label col-md-3 col-sm-4 label-align">Ending Date</label>
              <div class="col-md-6 col-sm-6 ">
                <input type="date" name="ending_date" class="form-control">
              </div>
            </div>

            <div class="form-group row">
                <label for="email" class="col-form-label col-md-3 col-sm-4 label-align"></label>
                <div class="col-md-6 col-sm-6">
                    <button  type="submit" class="btn btn-success ">Update</button>
                    <a href="{{route('all-time-schedule')}}" class="btn btn-info ml-2">Back</a>
                </div>
            </div>

			</form>
			            <!-- /.card -->
        </div>
      </div>
@endsection

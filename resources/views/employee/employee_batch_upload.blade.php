@extends('master')

@section('content')

<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Employee Batch Upload </h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active"><a href="#">Employee</a></li>
          <li class="breadcrumb-item active"><a href="#">Employee Batch Upload</a></li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>
   <div class="card card-success card-outline">
        <div class="card-header">
          <h3 class="card-title">Employee Batch Upload</h3>
        </div>

        <div class="col-md-6 offset-3 mt-2">
          @if ($message = Session::get('success'))
          <div class="alert alert-success alert-block">
          <button type="button" class="close" data-dismiss="alert">×</button>
          <strong>{{ $message }}</strong>
          </div>
          @endif
    
          @if ($message = Session::get('error'))
          <div class="alert alert-danger alert-block">
          <button type="button" class="close" data-dismiss="alert">×</button>
          <strong>{{ $message }}</strong>
          </div>
          @endif
        </div>


        <div class="card-body">
             <form action="{{route('save-employee-batch-upload')}}" method="post" enctype="multipart/form-data">
              @csrf
              <div class="form-group row">
                <input type="file" name="file">
                <div class="col-md-6 col-sm-6 ">
                    <button class="btn btn-success col-md-5 col-sm-5">Employee Batch Upload</button>
                </div>
              </div>

             </form>
        </div>
      </div>
@endsection

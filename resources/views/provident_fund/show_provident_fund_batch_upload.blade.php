@extends('welcome')

@section('content')
   <div class="card card-success card-outline">
        <div class="card-header">
          <h3 class="card-title">Upload User Information</h3>
        </div>

        @if ($message = Session::get('success'))
          <div class="alert alert-success alert-block">
           <button type="button" class="close" data-dismiss="alert">×</button>
           <strong>{{ $message }}</strong>
          </div>
          @endif

        @if ($message = Session::get('error'))
          <div class="alert alert-success alert-block">
           <button type="button" class="close" data-dismiss="alert">×</button>
           <strong>{{ $message }}</strong>
          </div>
          @endif

        <div class="card-body">
             <form action="{{route('save-provident-fund-batch-upload')}}" method="post" enctype="multipart/form-data">
              @csrf
          <div class="form-group row">
              <input type="file" name="file">
           <div class="col-md-6 col-sm-6 ">
              <button class="btn btn-success col-md-6">Upload Provident Fund Batch</button>
           </div>
         </div>

             </form>
        </div>
      </div>
@endsection

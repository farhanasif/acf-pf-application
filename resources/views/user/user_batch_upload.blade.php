@extends('welcome')

@section('content')
   <div class="card card-success card-outline">
        <div class="card-header">
          <h3 class="card-title">Upload Employee Information</h3>
        </div>
        <div class="card-body">
             <form action="{{ url('/user-batch-upload') }}" method="POST" enctype="multipart/form-data">
              @csrf
          <div class="form-group row">
              <input type="file" name="file">
           <div class="col-md-6 col-sm-6 ">
              <button class="btn btn-success col-md-4">Upload User Batch</button>
           </div>
         </div>

             </form>
        </div>
      </div>
@endsection

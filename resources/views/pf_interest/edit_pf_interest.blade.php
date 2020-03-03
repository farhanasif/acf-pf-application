@extends('master')

@section('content')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Edit PF Interest Information</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
          <li class="breadcrumb-item active"><a href="javascript:void(0)">PF Interest</a></li>
          <li class="breadcrumb-item active"><a href="javascript:void(0)">Edit PF Interest Information</a></li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>


   <div class="card card-success card-outline">
        <div class="card-header">
          <h3 class="card-title">Edit PF Interest Information</h3>
        </div>

        <div class="col-md-6 offset-3 mt-2">
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
        <form class="form-horizontal form-label-left" action="{{route('update-pf-interest',$pf_interest->id)}}" method="post">
             @csrf

            <div class="form-group row">
                <label for="name" class="col-form-label col-md-3 col-sm-4 label-align">Interest Date</label>
                <div class="col-md-6 col-sm-6 ">
                  <input type="date" class="form-control" name="interest_date" placeholder="Interest Date">
                </div>
            </div>

            <div class="form-group row">
                <label for="name" class="col-form-label col-md-3 col-sm-4 label-align">Interest Source</label>
                <div class="col-md-6 col-sm-6 ">
                <input type="text" class="form-control" name="interest_source" placeholder="Interest Source" value="{{$pf_interest->interest_source}}">
                </div>
            </div>

            <div class="form-group row">
                <label for="name" class="col-form-label col-md-3 col-sm-4 label-align">Staff Code</label>
                <div class="col-md-6 col-sm-6 ">
                  <select name="staff_code" id="" class="form-control select2bs4">
                      <option value="">--select--</option>
                      @foreach ($employees as $employee)
                        <option <?php echo ($employee->staff_code) ? "selected" : ""; ?>   value="{{$employee->staff_code}}">{{$employee->staff_code}}</option>
                      @endforeach
                  </select>
                </div>
              </div>

            <div class="form-group row">
                <label for="name" class="col-form-label col-md-3 col-sm-4 label-align">Own</label>
                <div class="col-md-6 col-sm-6 ">
                  <input type="text" class="form-control" name="own" placeholder="Own" value="{{$pf_interest->own}}">
                </div>
            </div>

            
            <div class="form-group row">
                <label for="name" class="col-form-label col-md-3 col-sm-4 label-align">Organization</label>
                <div class="col-md-6 col-sm-6 ">
                  <input type="text" class="form-control" name="organization" placeholder="Organization" value="{{$pf_interest->organization}}">
                </div>
            </div>

            <div class="form-group row">
                <label for="email" class="col-form-label col-md-3 col-sm-4 label-align"></label>
                <div class="col-md-6 col-sm-6">
                    <button  type="submit" class="btn btn-success ">Update</button>
                    <a href="{{route('all-pf-interest')}}" class="btn btn-info ml-2">Back</a>
                </div>
            </div>

			</form>
			            <!-- /.card -->
        </div>
      </div>
@endsection

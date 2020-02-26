@extends('master')

@section('content')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Add Provident Fund </h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
          <li class="breadcrumb-item active"><a href="javascript:void(0);">Provident</a></li>
          <li class="breadcrumb-item active"><a href="javascript:void(0);">Add Provident Fund</a></li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>


   <div class="card card-success card-outline">
        <div class="card-header">
          <h3 class="card-title">Add Provident Fund Information</h3>
        </div>
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

        <div class="card-body">
          <!-- /.card -->
            <!-- Horizontal Form -->
           <form class="form-horizontal form-label-left" action="{{url('/save-provident-fund')}}" method="post">
             @csrf
          <div class="form-group row">
  			    <label for="deposit_date" class="col-form-label col-md-3 col-sm-3 label-align">Deposit Date</label>
  			       <div class="col-md-6 col-sm-6 ">
  			    	       <input type="date" class="form-control" name="deposit_date">
  			        </div>
			     </div> 

			  <div class="form-group row">
			    <label for="staff_code" class="col-form-label col-md-3 col-sm-3 label-align">Staff Code</label>
			    <div class="col-md-6 col-sm-6 ">
            {{-- <input type="text" class="form-control" name="staff_code" placeholder="Staff Code"> --}}
	            <select class="form-control select2bs4" name="staff_code">
                <option value="">--select--</option>
                @foreach ($provident_funds as $provident_fund)
                <option <?php echo ($provident_fund== '--select--') ? "selected" : "--select--"; ?> value="{{$provident_fund->staff_code}}">{{$provident_fund->staff_code}}</option>
                @endforeach

	            </select>
          </div>
          
			  </div>
			   <div class="form-group row">
			    <label for="own_pf" class="col-form-label col-md-3 col-sm-4 label-align">Own Provident</label>
			    <div class="col-md-6 col-sm-6 ">
			    	 <input type="number" class="form-control" name="own_pf" placeholder="Own Provident">
			    </div>
			  </div>
        <div class="form-group row">
         <label for="organization_pf" class="col-form-label col-md-3 col-sm-4 label-align">Organization Provident</label>
         <div class="col-md-6 col-sm-6 ">
            <input type="number" class="form-control" name="organization_pf" placeholder="Organization Provident">
         </div>
       </div>

    <div class="form-group row">
    <label for="email" class="col-form-label col-md-3 col-sm-4 label-align"></label>
    <div class="col-md-6 col-sm-6 text-center ">
      <button  type="submit" class="btn btn-success ">Submit</button>
    </div>
    </div>

			</form>
			            <!-- /.card -->
        </div>
      </div>
@endsection

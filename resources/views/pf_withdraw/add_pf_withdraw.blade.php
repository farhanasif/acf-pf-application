@extends('master')

@section('content')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Add PF Withdraw Information</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
          <li class="breadcrumb-item active"><a href="javascript:void(0)">PF Withdraw</a></li>
          <li class="breadcrumb-item active"><a href="javascript:void(0)">Add PF Withdraw Information</a></li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

    <div class="row">
        <div class="col"></div>
        <div class="col-md-10">
            <div class="card card-success card-outline">
                <div class="card-header">
                  <h3 class="card-title">Add PF Withdraw Information</h3>
                </div>

                    @include('message')

                <div class="card-body">
                  <!-- /.card -->
                    <!-- Horizontal Form -->
                    <form class="form-horizontal form-label-left" action="{{route('save-pf-withdraw')}}" method="post">
                     @csrf
                        <div class="row">
                            <div class="col-md-10 offset-1">
                                <div class="form-group row">
                                    <label for="name" class="col-form-label col-md-4 label-align">Staff Code</label>
                                    <div class="col-md-7">
                                      <select name="staff_code" id="" class="form-control select2bs4">
                                          <option value="">--select--</option>
                                          @foreach ($employees as $employee)
                                            <option value="{{$employee->staff_code}}">{{$employee->staff_code}}</option>
                                          @endforeach
                                      </select>
                                      @if($errors->has('staff_code'))
                                      <strong class="text-danger">{{ $errors->first('staff_code') }}</strong>
                                      @endif
                                    </div>
                                  </div>

                                <div class="form-group row">
                                  <label for="name" class="col-form-label col-md-4 label-align">Received Amount</label>
                                  <div class="col-md-7">
                                    <input type="text" class="form-control" name="received_amount" placeholder="Received Amount">
                                    @if($errors->has('received_amount'))
                                    <strong class="text-danger">{{ $errors->first('received_amount') }}</strong>
                                    @endif
                                  </div>
                                </div>

                                <div class="form-group row">
                                    <label for="name" class="col-form-label col-md-4  label-align">Received Date</label>
                                    <div class="col-md-7">
                                      <input type="text" class="form-control" name="received_date" id="received_date" placeholder="Received Date">
                                      @if($errors->has('received_date'))
                                      <strong class="text-danger">{{ $errors->first('received_date') }}</strong>
                                      @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="name" class="col-form-label col-md-4 label-align">Received By</label>
                                    <div class="col-md-7">
                                      <input type="text" class="form-control" name="received_by" placeholder="Received By">
                                      @if($errors->has('received_by'))
                                      <strong class="text-danger">{{ $errors->first('received_by') }}</strong>
                                      @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="name" class="col-form-label col-md-4 label-align">Received In</label>
                                    <div class="col-md-7">
                                      <input type="text" class="form-control" name="received_in" placeholder="Received In">
                                      @if($errors->has('received_in'))
                                      <strong class="text-danger">{{ $errors->first('received_in') }}</strong>
                                      @endif
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label for="name" class="col-form-label col-md-4 label-align">Authorization Signatory</label>
                                    <div class="col-md-7">
                                      <input type="text" class="form-control" name="authorization_signatory" placeholder="Authorization Signatory">
                                      @if($errors->has('authorization_signatory'))
                                        <strong class="text-danger">{{ $errors->first('authorization_signatory') }}</strong>
                                      @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="name" class="col-form-label col-md-4 label-align">Description</label>
                                    <div class="col-md-7">
                                      <textarea name="description" id="" cols="5" rows="3" class="form-control" placeholder="Description"></textarea>
                                      @if($errors->has('description'))
                                        <strong class="text-danger">{{ $errors->first('description') }}</strong>
                                      @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="email" class="col-form-label col-md-4 label-align"></label>
                                    <div class="col-md-7">
                                        <button  type="submit" class="btn btn-success ">Submit</button>
                                        <a href="{{route('all-pf-withdraw')}}" class="btn btn-info ml-2">Back</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                                <!-- /.card -->
                </div>
              </div>
        </div>
        <div class="col"></div>
    </div>

@endsection
@section('customjs')
    <script>

    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

    $( "#received_date" ).datepicker({
          dateFormat: "YYYY-MM-DD HH:mm:ss",
          orientation: "bottom left"
     });

    </script>
@endsection

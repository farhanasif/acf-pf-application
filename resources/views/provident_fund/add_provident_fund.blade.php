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

<div class="row">
    <div class="col"></div>
    <div class="col-md-10">
        <div class="card card-success card-outline">
            <div class="card-header">
              <h3 class="card-title">Add Provident Fund Information</h3>
            </div>

            @include('message')

            <div class="card-body">
              <!-- /.card -->
                <!-- Horizontal Form -->
               <form class="form-horizontal form-label-left" action="{{url('/save-provident-fund')}}" method="post">
                 @csrf
                  <div class="row">
                      <div class="col-md-10 offset-1">
                        <div class="form-group row">
                            <label for="deposit_date" class="col-form-label col-md-3 label-align">Deposit Date</label>
                               <div class="col-md-8">
                                  <input type="text" class="form-control" id="deposit_date" name="deposit_date" placeholder="Deposite Date">
                                  @if($errors->has('deposit_date'))
                                      <strong class="text-danger">{{ $errors->first('deposit_date') }}</strong>
                                  @endif
                              </div>
                      </div>

                        <div class="form-group row">
                          <label for="staff_code" class="col-form-label col-md-3 label-align">Staff Code</label>
                          <div class="col-md-8">
                              <select class="form-control select2bs4" name="staff_code">
                                  <option value="">--select--</option>
                                  @foreach ($provident_funds as $provident_fund)
                                      <option  value="{{$provident_fund->staff_code}}">{{ sprintf("%04d", $provident_fund->staff_code)}}</option>
                                  @endforeach
                              </select>
                              @if($errors->has('staff_code'))
                                  <strong class="text-danger">{{ $errors->first('staff_code') }}</strong>
                              @endif
                          </div>
                        </div>

                      <div class="form-group row">
                          <label for="own_pf" class="col-form-label col-md-3 label-align">Own Provident</label>
                          <div class="col-md-8">
                              <input type="number" class="form-control" name="own_pf" placeholder="Own Provident">
                              @if($errors->has('own_pf'))
                                  <strong class="text-danger">{{ $errors->first('own_pf') }}</strong>
                              @endif
                          </div>
                      </div>

                      <div class="form-group row">
                          <label for="organization_pf" class="col-form-label col-md-3 label-align">Organization Provident</label>
                          <div class="col-md-8">
                              <input type="number" class="form-control" name="organization_pf" placeholder="Organization Provident">
                              @if($errors->has('organization_pf'))
                                  <strong class="text-danger">{{ $errors->first('organization_pf') }}</strong>
                              @endif
                          </div>
                      </div>

                      <div class="form-group row">
                          <label for="email" class="col-form-label col-md-3 label-align"></label>
                          <div class="col-md-8">
                              <button  type="submit" class="btn btn-success ">Submit</button>
                              <a href="{{route('all-provident-fund')}}" class="btn btn-info">Back</a>
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

    $( "#deposit_date" ).datepicker({
          dateFormat: "YYYY-MM-DD HH:mm:ss",
          orientation: "bottom left"
     });


    </script>
@endsection

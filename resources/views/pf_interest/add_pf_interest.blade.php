@extends('master')

@section('content')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Add PF Interest Information</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
          <li class="breadcrumb-item active"><a href="javascript:void(0)">PF Interest</a></li>
          <li class="breadcrumb-item active"><a href="javascript:void(0)">Add PF Interest Information</a></li>
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
                  <h3 class="card-title">Add PF Interest Information</h3>
                </div>

                @include('message')

                <div class="card-body">
                  <!-- /.card -->
                    <!-- Horizontal Form -->
                    <form class="form-horizontal form-label-left" action="{{route('save-pf-interest')}}" method="post">
                     @csrf
                     <div class="row">
                         <div class="col-md-10 offset-1">
                            <div class="form-group row">
                                <label for="name" class="col-form-label col-md-3 label-align">Interest Date</label>
                                <div class="col-md-8">
                                  <input type="text" class="form-control" name="interest_date" id="interest_date" placeholder="Interest Date" placeholder="Interest Date">
                                  @if($errors->has('interest_date'))
                                  <strong class="text-danger">{{ $errors->first('interest_date') }}</strong>
                                  @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-form-label col-md-3 label-align">Interest Source</label>
                                <div class="col-md-8">
                                  <input type="text" class="form-control" name="interest_source" placeholder="Interest Source">
                                  @if($errors->has('interest_source'))
                                  <strong class="text-danger">{{ $errors->first('interest_source') }}</strong>
                                  @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-form-label col-md-3 label-align">Staff Code</label>
                                <div class="col-md-8">
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
                                <label for="name" class="col-form-label col-md-3 label-align">Own</label>
                                <div class="col-md-8">
                                  <input type="text" class="form-control" name="own" placeholder="Own">
                                  @if($errors->has('own'))
                                  <strong class="text-danger">{{ $errors->first('own') }}</strong>
                                  @endif
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="name" class="col-form-label col-md-3 label-align">Organization</label>
                                <div class="col-md-8">
                                  <input type="text" class="form-control" name="organization" placeholder="Organization">
                                  @if($errors->has('organization'))
                                  <strong class="text-danger">{{ $errors->first('organization') }}</strong>
                                  @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-form-label col-md-3 label-align"></label>
                                <div class="col-md-8">
                                    <button  type="submit" class="btn btn-success ">Submit</button>
                                    <a href="{{route('all-pf-interest')}}" class="btn btn-info ml-2">Back</a>
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

    $( "#interest_date" ).datepicker({
          dateFormat: "YYYY-MM-DD HH:mm:ss",
          orientation: "bottom left"
     });

    </script>
@endsection

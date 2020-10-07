@extends('master')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
              <div class="row mb-2">
                  <div class="col-sm-6">
                    <h1>Edit Provident Fund </h1>
                  </div>
                  <div class="col-sm-6">
                      <ol class="breadcrumb float-sm-right">
                          <li class="breadcrumb-item"><a href="#">Home</a></li>
                          <li class="breadcrumb-item active"><a href="#">Provident</a></li>
                          <li class="breadcrumb-item active"><a href="#">Edit Provident Fund</a></li>
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
                  <h3 class="card-title">Edit Provident Fund Information</h3>
                </div>

                @include('message')

                <div class="card-body">
                  <!-- /.card -->
                    <!-- Horizontal Form -->
              <form class="form-horizontal form-label-left" action="{{url('/update-provident-fund',$provident_fund->id)}}" method="post">
                     @csrf

                    <div class="row">
                        <div class="col-md-10 offset-1">
                            <div class="form-group row">
                                <label for="staff_code" class="col-form-label col-md-3 label-align">Staff Code</label>
                                <div class="col-md-8 ">
                                    <select class="form-control" name="staff_code">
                                        @foreach ($all_employees as $all_employee)
                                            <option value="{{$all_employee->staff_code}}" @if($all_employee->staff_code == $provident_fund->staff_code) selected @endif>{{ sprintf("%04d", $all_employee->staff_code)}}</option>
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
                                  <input type="number" class="form-control" name="own_pf" placeholder="Own Provident" value="{{$provident_fund->own_pf}}">
                                  @if($errors->has('own_pf'))
                                  <strong class="text-danger">{{ $errors->first('own_pf') }}</strong>
                                  @endif
                                </div>
                             </div>

                            <div class="form-group row">
                              <label for="organization_pf" class="col-form-label col-md-3 label-align">Organization Provident</label>
                              <div class="col-md-8">
                                  <input type="number" class="form-control" name="organization_pf" placeholder="Organization Provident" value="{{$provident_fund->organization_pf}}">
                                  @if($errors->has('organization_pf'))
                                    <strong class="text-danger">{{ $errors->first('organization_pf') }}</strong>
                                  @endif
                              </div>
                            </div>

                            <div class="form-group row">
                              <label for="email" class="col-form-label col-md-3 label-align"></label>
                              <div class="col-md-8">
                                <button  type="submit" class="btn btn-success ">Submit</button>
                                <a href="{{route('all-provident-fund')}}" class="btn btn-info ml-2">Back</a>
                              </div>
                            </div>

                        </div>
                    </div>
                  <input type="hidden" value="{{$provident_fund->organization_pf}}" name="old_organization_pf">
                  <input type="hidden" value="{{$provident_fund->own_pf}}" name="old_own_pf">

              </form>
               <!-- /.card -->
                </div>
              </div>
        </div>
        <div class="col"></div>
    </div>
@endsection

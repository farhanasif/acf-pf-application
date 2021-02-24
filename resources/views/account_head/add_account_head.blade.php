@extends('master')

@section('content')
    <section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Add Account Head Information</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Account Head</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Add Account Head Information</a></li>
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
                  <h3 class="card-title">Add Account Head Information</h3>
                </div>

                    @include('message')

                <div class="card-body">
                  <!-- /.card -->
                    <!-- Horizontal Form -->
                <form class="form-horizontal form-label-left" action="{{route('save-account-head')}}" method="post">
                     @csrf
                        <div class="row">
                            <div class="col-md-10 offset-1">
                                <div class="form-group row">
                                    <label for="name" class="col-form-label col-md-3 label-align">Account Head</label>
                                    <div class="col-md-8">
                                         <input type="text" class="form-control" name="account_head" placeholder="Account Head">
                                         @if($errors->has('account_head'))
                                         <strong class="text-danger">{{ $errors->first('account_head') }}</strong>
                                         @endif
                                    </div>
                                  </div>

                                  <div class="form-group row">
                                    <label for="department_code" class="col-form-label col-md-3 label-align">Account Code</label>
                                    <div class="col-md-8">
                                         <input type="number" class="form-control" name="account_code" placeholder="Account Code">
                                         @if($errors->has('account_code'))
                                         <strong class="text-danger">{{ $errors->first('account_code') }}</strong>
                                         @endif
                                    </div>
                                  </div>

                                  <div class="form-group row">
                                    <label for="department_code" class="col-form-label col-md-3 label-align">Account Type</label>
                                    <div class="col-md-8">
                                        <select name="account_type" id="" class="form-control">
                                            <option value="">--select</option>
                                            <option value="ASSET">ASSET</option>
                                            <option value="LIABILITY">LIABILITY</option>
                                            <option value="INCOME">INCOME</option>
                                            <option value="EXPENSE">EXPENSE</option>
                                        </select>
                                        @if($errors->has('account_type'))
                                        <strong class="text-danger">{{ $errors->first('account_type') }}</strong>
                                        @endif
                                    </div>
                                  </div>

                                <div class="form-group row">
                                    <label for="email" class="col-form-label col-md-3 label-align"></label>
                                    <div class="col-md-8">
                                        <button  type="submit" class="btn btn-success ">Submit</button>
                                    <a href="{{route('all-account-head')}}" type="submit" class="btn btn-info ml-3">Back</a>
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

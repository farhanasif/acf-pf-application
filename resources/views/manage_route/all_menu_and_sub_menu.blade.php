
@extends('master')
@section('customcss')

@endsection
@section('content')

<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>User Mangement</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
          <li class="breadcrumb-item active"><a href="javascript:void(0)"> User Mangement </a></li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>
<section class="content">

  <div class="card card-success card-outline">
    <div class="card-header">
        <h3 class="card-title">User Mangement</h3><br>

        @include('message')

            {{-- <div class="float-sm-right">
            <a href="" class="btn btn-success">Download Sample Excel</a>
            </div> --}}

    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <form action=" {{ route('store-user-management') }} " method="POST">
            @csrf
            <div class="form-group row">
                <div class="col-md-2"></div>
                <label class="col-md-2" for=""> Select Role</label>
                <div class="col-md-6">
                    <select name="role_name" id="" class="form-control">
                        <option value="">--select--</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role->value }}"> {{ $role->role_name }} </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <table id="pf-interest" class="table table-bordered table-striped">
                <thead>
                <tr class="bg-success">
                <th>SL NO</th>
                <th>Menu</th>
                <th>Sub Menu</th>
                </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                @foreach ($all_menu as $row)
                <tr>
                    <td style="width: 10%"> {{$i++}} </td>
                    <td style="width: 30%">

                        <input type="checkbox" id="menu" name="menu[]" value=" {{ $row->id }} ">
                        {{ $row->name }}

                    </td>
                    <td style="width: 60%">

                        <?php  $sub_menu = DB::select("SELECT *  FROM sub_menu WHERE menu_id = $row->id"); ?>

                            @foreach ($sub_menu as $item)
                                <input type="checkbox" id="sub_menu" name="sub_menu[]" value=" {{ $item->id }} ">
                                {{ $item->sub_menu_name }} &nbsp &nbsp
                            @endforeach

                    </td>
                </tr>
                @endforeach

                </tbody>
            </table>
            <div class=" row">
                {{-- <button type="button" class="btn btn-info btn-block col-md-3">Reset</button>
                &nbsp
                <button type="submit" class="btn btn-info btn-block btn-lg col-md-3">Confirm</button> --}}
                <div class="float-sm-right">
                    <button type="button" class="btn btn-default">Reset</button>
                &nbsp
                <button type="submit" class="btn btn-success float-sm-right">Confirm</button>
                </div>
            </div>
        </form>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->

</section>
@endsection

@section('customjs')

  <script>

   $(document).ready( function(){

    $( "#pf-interest-download" ).click(function() {
          $("#pf-interest").tableToCSV();
      });

   });

    </script>
@endsection

@extends('master')
@section('content')
<section>
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Loan Details</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="javascript:void()">Home</a></li>
            <li class="breadcrumb-item active">Loan Details</li>
          </ol>
        </div>
      </div>
      </div><!-- /.container-fluid -->
    </section>
    <section class="content">
      <div class="card card-success card-outline">
        <div class="card-header">
          <h3 class="card-title">Loan Amount Details</h3>
        </div>
        <div class="card-body">
          <div class="card-body table-responsive p-0" style="">
            <table class="table table-striped table-head-fixed text-nowrap" id="loanTable">
              <thead>
                <tr >
                  <th class="bg-success">ID</th>
                  <th class="bg-success">Date</th>
                  <th class="bg-success">Name</th>
                  <th class="bg-success">Amount</th>
                  <th class="bg-success">Interest</th>
                  <th class="bg-success">Months</th>
                  <th class="bg-success">Start Month</th>
                  <th class="bg-success">End Month</th>
                </tr>
              </thead>
              <tbody>
               <?php $ci = 1; ?>
                @foreach ($data as $item)
                <tr>
                  <td><?php 
                      if($ci < 10) echo '0'.$ci++;
                      else echo $ci;
                   ?></td>
                  <td> {{ date('j F, Y', strtotime($item->issue_date)) ? date('j F, Y', strtotime($item->issue_date)) : 'Nill' }}  </td>
                  <td><a href="{{ url('/employee-details',$item->staff_code) }}">{{ $item->first_name.' '.$item->last_name ? $item->first_name.' '.$item->last_name : 'Nill'}} </a></td>
                  <td class="center"><dt> {{ $item->loan_amount ? number_format($item->loan_amount) : 'Nill' }} </dt></td>
                  <td class="center">{{$item->interest ? $item->interest :'Nill'}}</td>
                  <td class="center"> {{$item->total_months ? $item->total_months : 'Nill' }} </td>
                  <td> {{ date('j F, Y', strtotime($item->loan_start_date)) ? date('j F, Y', strtotime($item->loan_start_date)) : 'Nill' }}  </td>
                  <td> {{ date('j F, Y', strtotime($item->loan_end_date)) ? date('j F, Y', strtotime($item->loan_end_date)) : 'Nill' }}  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            </div><!-- /.card-body -->
          </div>
        </div>
        </div><!-- /.card-body -->
      </section>
    </section>
    @endsection
    @section('customjs')
    <script>
    $(document).ready(function() {
    $('#loanTable').DataTable();
    } );
    </script>
    @endsection
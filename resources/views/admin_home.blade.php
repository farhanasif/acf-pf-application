@extends('master')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <?php $dt = new DateTime('now', new DateTimezone('Asia/Dhaka'))?>
            <h1>{{$dt->format('F j, Y, g:i a')}}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
              <li class="breadcrumb-item active"><a href="javascript:void(0)">Admin Dashboard</a></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

 <section class="content">
  <div class="container-fluid">
    <!-- Info boxes -->
    <div class="row">
      <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box">
          <span class="info-box-icon bg-info elevation-1"><i class="fas fa-money-check"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">PF Ledger Amount</span>
            <span class="info-box-number">
              {{number_format($employee_contribution + $employer_contribution)}} TK
            </span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
          <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-money-check"></i></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Employee Contribution</span>
            <span class="info-box-number">{{number_format($employee_contribution)}} TK</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->

      <!-- fix for small devices only -->
      <div class="clearfix hidden-md-up"></div>

      <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
          <span class="info-box-icon bg-success elevation-1"><i class="fas fa-money-check"></i></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Employer Contribution</span>
          <span class="info-box-number">{{number_format($employer_contribution)}} TK</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
          <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Employee</span>
          <span class="info-box-number">{{$total_employees}}</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h5 class="card-title">Monthly Recap Report</h5>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-8">
                <p class="text-center">
                  <strong>Transaction: Aug, 2017 - Feb, 2020</strong>
                </p>

                <div class="chart">
                  <!-- Sales Chart Canvas -->
                  <canvas id="salesChart" height="180" style="height: 180px;"></canvas>
                </div>
                <!-- /.chart-responsive -->
              </div>
              <!-- /.col -->
              <div class="col-md-4">
                <p class="text-center">
                  <strong>Goal Completion</strong>
                </p>

                <div class="progress-group">
                  Employee Under PF
                  <span class="float-right">
                    <b>
                     @foreach ($total_employee_under_loan as $item)
                         {{$item->total_pf_staff}}
                     @endforeach
                    </b>
                    /
                    {{$total_employees}}
                  </span>
                  <div class="progress progress-sm">
                    <div class="progress-bar bg-primary" style="width: 80%"></div>
                  </div>
                </div>
                <!-- /.progress-group -->

                <div class="progress-group">
                  Employee Under Loan
                <span class="float-right">
                  <b>
                   @foreach ($total_loans as $item)
                    {{$item->total_loan}}
                   @endforeach
                  </b>
                   /{{$total_employees}}
                </span>
                  <div class="progress progress-sm">
                    <div class="progress-bar bg-danger" style="width: 75%"></div>
                  </div>
                </div>

                <!-- /.progress-group -->
                <div class="progress-group">
                  <span class="progress-text">Total Investment</span>
                  <span class="float-right">
                    @foreach ($total_investments as $investment)
                    {{$investment->total_investment_amount ? number_format($investment->total_investment_amount) : 0}} TK
                    @endforeach
                  </span>
                  <div class="progress progress-sm">
                    <div class="progress-bar bg-success" style="width: 60%"></div>
                  </div>
                </div>
                <!-- /.progress-group -->
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
          <!-- ./card-body -->
          <div class="card-footer">
            <div class="row">
              <div class="col-sm-3 col-6">
                <div class="description-block border-right">
                  {{-- <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> 40%</span> --}}
                  <h5 class="description-header">{{number_format($total_balance_in_account_from_pf_deposit + $total_balance_in_account_from_transaction)}} TK</h5>
                  <span class="description-text">TOTAL BALANCE IN ACCOUNT</span>
                </div>
                <!-- /.description-block -->
              </div>
              <!-- /.col -->
              <div class="col-sm-3 col-6">
                <div class="description-block border-right">
                  {{-- <span class="description-percentage text-warning"><i class="fas fa-caret-left"></i> 20%</span> --}}
                  <h5 class="description-header">
                    @foreach ($total_investments as $investment)
                        {{$investment->total_investment_amount ? number_format($investment->total_investment_amount) : 0}} TK
                    @endforeach
                  </h5>
                  <span class="description-text">TOTAL INVESTMENT</span>
                </div>
                <!-- /.description-block -->
              </div>
              <!-- /.col -->
              <div class="col-sm-3 col-6">
                <div class="description-block border-right">
                  {{-- <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> 20%</span> --}}
                  <h5 class="description-header">

                    @foreach ($total_loans as $item)
                        {{ number_format($item->total_loan_amount)}} TK
                    @endforeach
                  </h5>
                  <span class="description-text">TOTAL LOAN AMOUNT</span>
                </div>
                <!-- /.description-block -->
              </div>
              <!-- /.col -->
              <div class="col-sm-3 col-6">
                <div class="description-block">
                  {{-- <span class="description-percentage text-danger"><i class="fas fa-caret-down"></i> 18%</span> --}}
                  <h5 class="description-header">1200</h5>
                  <span class="description-text">TOTAL RECONCILIATION</span>
                </div>
                <!-- /.description-block -->
              </div>
            </div>
            <!-- /.row -->
          </div>
          <!-- /.card-footer -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- Main row -->

    <!-- /.row -->
  </div><!--/. container-fluid -->
</section>
<!-- /.content -->

@endsection

@section('customjs')
  <script src="{{asset('theme/dist/js/pages/dashboard2.js')}}"></script>
@endsection

@extends('master')
@section('customcss')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')

<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Loan Installment Details</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="javascript:void()">Home</a></li>
          <li class="breadcrumb-item active">Loan Installment Details</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<section class="content">
  @if ($message = Session::get('success'))
      <div class="alert alert-success alert-block text-center">
      <button type="button" class="close" data-dismiss="alert">×</button>
      <strong>{{ $message }}</strong>
      </div>
  @endif
  @if ($message = Session::get('danger'))
  <div class="alert alert-danger alert-block text-center">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>{{ $message }}</strong>
  </div>
  @endif
  <div class="card card-widget widget-user">
      <!-- Add the bg color to the header using any of the bg-* classes -->
      <div class="widget-user-header bg-success">
      <h3 class="widget-user-username"> {{ $loan_account_details[0]->first_name.' '.$loan_account_details[0]->last_name}}</h3>
        <h5 class="widget-user-desc"> {{$loan_account_details[0]->position}} </h5>
      </div>
      <div class="widget-user-image">
        <img class="img-circle elevation-2" src="{{ asset('theme/dist/img/person-icon.png') }}" alt="User Avatar">
      </div>
      <div class="card-footer">
        <div class="row">
          <div class="col-sm-2 border-right">
            <div class="description-block">
              <h5 class="description-header">
              {{ ceil($loan_account_details[0]->monthly_installment  + $loan_account_details[0]->monthly_interest) }}Tk. / Per Month
              </h5>
              <span class="description-text">Loan Installment Amount (with Interest)</span>
            </div>
            <!-- /.description-block -->
          </div>
          <!-- /.col -->
          <div class="col-sm-3 border-right">
            <div class="description-block">
            <h5 class="description-header">
               {{ceil( $loan_account_details[0]->monthly_installment) }}Tk. / Per Month
            </h5>
              <span class="description-text">Loan Installment Amount (without interest)</span>
            </div>
            <!-- /.description-block -->
          </div>

          <div class="col-sm-3 border-right">
            <div class="description-block">
            <h5 class="description-header">
                {{ ceil($loan_account_details[0]->interest) }}Tk.
            </h5>
              <span class="description-text">Total Interest Amount</span>
            </div>
            <!-- /.description-block -->
          </div>

          <!-- /.col -->
          <div class="col-sm-2 border-right">
            <div class="description-block">

              <?php $total_loan = 0; foreach ($loan_account_details as $item) {
                $total_loan += $item->loan_amount;
                } ?>
                <h5 class="description-header"> 
                  <?php echo $total_loan.'Tk.'; ?>
                </h5>

              <span class="description-text">Loan Amount (Total)</span>
            </div>
            <!-- /.description-block -->
          </div>
          <!-- /.col -->

          <!-- /.col -->
          <div class="col-sm-2">
            <div class="description-block">
              <h5 class="description-header">
                @foreach ($total_and_maximum_pf as $item)
                  {{number_format($item->total_pf_amount)}}Tk.
                @endforeach
              </h5>
              <span class="description-text">TOTAL DEPOSITE AMOUNT</span>
            </div>
            <!-- /.description-block -->
          </div>
          <!-- /.col -->

        </div>
        <!-- /.row -->
      </div>
    </div>

      <div class="card card-success card-outline">
        <div class="card-header">
          <h3 class="card-title">Loan Amount Details</h3>
          <button type="submit" id="loan-amount-details-download" class="btn btn-success float-right">Download Excel</button>
        </div>
        <div class="card-body">
          <div class="card-body table-responsive p-0" style="">
            <table class="table table-striped table-head-fixed text-nowrap" id="loan-amount-details">
              <thead>
                <tr>
                  <th class="bg-success">SL</th>
                  <th class="bg-success">Date</th>
                  <th class="bg-success">Loan</th>
                  <th class="bg-success">Interest</th>
                  <th class="bg-success">Remaining</th>
                  <th class="bg-success">Status</th>
                  <th class="bg-success">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php $i=1;$remaning_amount = $total_loan;?>
                @foreach ($loan_adjustments as $item)

                <?php 
                  $remaning_amount -= $loan_account_details[0]->monthly_installment;
                ?>

                <tr>
                <td>{{$i++}}</td>
                  <td> {{ date('j F, Y', strtotime($item->pay_date,3)) }}  </td>
                  <td><dt> {{$item->monthly_installment}}  </dt></td>
                  <td><dt> {{$item->monthly_interest}}</dt></td>
                  <td><?php print_r(ceil($remaning_amount)."/-"); ?></td>

                      @if ( strtoupper( $item->payment_type) == 'DUE')
                        <td class="text-danger"> {{strtoupper( $item->payment_type)}} </td>
                      @elseif(strtoupper( $item->payment_type) == 'PAID')
                        <td class="text-success"> {{strtoupper($item->payment_type) }} </td>
                        
                      @endif
                  
                  @if ( strtoupper( $item->payment_type) == 'DUE')
                   <td><button  id ="{{$item->id}}" data-id="{{$item->id}}" class="btn btn-warning" data-toggle="modal" data-target="#modal-loan-installment" onclick="showId(this);" style="font-weight: 600;">Adjust</button></td>
                  @elseif(strtoupper( $item->payment_type) == 'PAID')
                    <td><button class="btn btn-info" style="font-weight: 600;">PAID</button></td>
                  @endif
             
                </tr>

                @endforeach
              </tbody>
            </table>
            </div><!-- /.card-body -->
          </div>
        </div>
        </div><!-- /.card-body -->
<!-- /.card -->

                    <!-- START EMPLOYEE BATCH UPLOAD MODAL -->
    <div class="modal fade" id="modal-loan-installment">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Monthly Loan Installment</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <div class="card-footer">
              <div class="row" style="box-shadow: 2px 3px 3px green;">
                <div class="col-sm-6 border-right" style="background: #28a745;color: white;">
                  <div class="description-block">
                  <h5 class="description-header">
                     {{ceil( $loan_account_details[0]->monthly_installment) }}Tk. / Per Month
                  </h5>
                    <span class="description-text">Loan Installment Amount (without interest)</span>
                  </div>
                  <!-- /.description-block -->
                </div>

                <div class="col-sm-6" style="background: #28a745;color: white;">
                  <div class="description-block">
                    <h5 class="description-header">
                    {{ ceil($loan_account_details[0]->monthly_interest) }}Tk.
                    </h5>
                    <span class="description-text">Monthly Interest Amount</span>
                  </div>
                  <!-- /.description-block -->
                </div>
              </div>

          <div class="modal-body">
            <form action="{{route('save-loan-insatllment')}}" method="post" enctype="multipart/form-data">
              @csrf
              <input type="hidden" name="staff_code" class="form-control" value="{{ $loan_account_details[0]->staff_code }}">
              <input type="hidden" name="monthly_installment" class="form-control" value="{{ $loan_account_details[0]->monthly_installment }}">
              <input type="hidden" name="monthly_interest" class="form-control" value="{{ $loan_account_details[0]->monthly_interest }}">
              <input type="hidden" name="installment_id" id = "installment_id" class="form-control" value="">

              <div class="form-group row">
              <label for="acount_head" class="col-form-label col-md-12 col-sm-12">Account Head for monthly installment</label>
              <div class="col-md-12 col-sm-12">
                <select name="account_head_for_monthly_installment" id="account_head_for_monthly_installment" class="form-control select2bs4">
                   <option value="">--select--</option>
                    @foreach ($accounts as $val)
                      <option value="{{ $val->id }}">{{ $val->account_head }}</option>
                    @endforeach
                </select>
              </div>
              </div>
              <div class="form-group row">
              <label for="acount_head" class="col-form-label col-md-12 col-sm-12">Account Head for monthly interest</label>
              <div class="col-md-12 col-sm-12">
                <select name="account_head_for_monthly_interest" id="account_head" class="form-control select2bs4">
                   <option value="">--select--</option>
                    @foreach ($accounts as $val)
                      <option value="{{ $val->id }}">{{ $val->account_head }}</option>
                    @endforeach
                </select>
              </div>
              </div>

             <div class="form-group row">
              <label for="acount_head" class="col-form-label col-md-12 col-sm-12">Date of Adjustment</label>
              <div class="col-md-12 col-sm-12">
                 <input type="text" name="date_of_adjusment" id="adjustment_date" class="form-control">
              </div>
              </div>
              <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- END EMPLOYEE BATCH UPLOAD MODAL -->
</section>
@endsection

@section('customjs')
<script src="http://www.jqueryscript.net/demo/jQuery-Plugin-To-Convert-HTML-Table-To-CSV-tabletoCSV/jquery.tabletoCSV.js"></script>

<script>
function showId(button) {
  var id = button.id;
  console.log(id);
  document.getElementById("installment_id").value = id;
}
$(document).ready(function() {

   // START ALL LOANS TABLE DATA DOWNLOAD CLICK FUNCTION
   $( "#loan-amount-details-download" ).click(function() {
          $("#loan-amount-details").tableToCSV();
      });
  // END ALL LOANS TABLE DATA DOWNLOAD CLICK FUNCTION

  // START TABLE TO CSV CONVERT FUNCTION
  var tableToExcel = (function() {
        var uri = 'data:application/vnd.ms-excel;base64,',
            template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>',
            base64 = function(s) {
            return window.btoa(unescape(encodeURIComponent(s)))
            },
            format = function(s, c) {
            return s.replace(/{(\w+)}/g, function(m, p) {
                return c[p];
            })
            }
        return function(table, name) {
            if (!table.nodeType)
            table = document.getElementById(table)
            var ctx = {
            worksheet: name || 'Worksheet',
            table: table.innerHTML
            }
            var HeaderName = 'Download-ExcelFile';
            var ua = window.navigator.userAgent;
            var msieEdge = ua.indexOf("Edge");
            var msie = ua.indexOf("MSIE ");
            if (msieEdge > 0 || msie > 0) {
            if (window.navigator.msSaveBlob) {
                var dataContent = new Blob([base64(format(template, ctx))], {
                type: "application/csv;charset=utf-8;"
                });
                var fileName = "excel.xls";
                navigator.msSaveBlob(dataContent, fileName);
            }
            return;
            }
            window.open('data:application/vnd.ms-excel,' + encodeURIComponent(format(template, ctx)));
        }
        })()
    // END TABLE TO CSV CONVERT FUNCTION


    $(function() { 
       $( "#adjustment_date" ).datepicker();
    });
  });
</script>

@endsection
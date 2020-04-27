@extends('master')

@section('content')
            <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Bank Reconciliation</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Bank Reconciliation</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- general form elements disabled -->
        <div class="card card-secondary">
            <div class="card-header">
                <h3 class="card-title">Select month to continue</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form role="form">
                    <div class="row">
                        <div class="col-sm-6">
                            <!-- select -->
                            <div class="form-group">
                                <label>Select Month</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="far fa-calendar-alt"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control float-right" id="from_date">
                                </div>
                                {{-- <input type="text" class="form-control" placeholder="yyyy-mm-dd" id="from_date"> --}}
                            </div>
                        </div>
                    </div>

                </form>
            </div>
            <!-- /.card-body -->
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="submit" id="generate" class="btn btn-success">Generate</button>
                <button type="submit" id="download" class="btn btn-info">Download</button>
                <button type="submit" id="addnewtransaction" class="btn btn-outline-success float-right" data-toggle="modal" data-target="#modal-default">Add a
                    new Transaction</button>
            </div>
            <!-- /.card-footer -->
        </div>
        <!-- /.card -->
        <!-- Default box -->
        <div class="card card-success card-outline">
            <div class="card-header">
                <h3 class="card-title">Bank Reconciliation</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <br />
                <div style="overflow-x: auto;">
                    <table id="bankrecon" class="table table-bordered table-striped table-sm">
                        <thead>
                            <tr>
                                <th style="text-align: center;">Date</th>
                                <th style="text-align: center;">Voucher No</th>
                                <th style="text-align: center;">Description</th>
                                <th style="text-align: center;">Cheque No</th>
                                <th style="text-align: center;">Amount</th>
                                <th style="text-align: center;">Account Head</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
        <div class="card card-success card-outline">
            <div class="card-header">
                <h3 class="card-title">Bank Book</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <br />
                <div style="overflow-x: auto;">
                    <table id="bankbook" class="table table-bordered table-striped table-sm">
                        <thead>
                            <tr>
                                <th style="text-align: center;">Date</th>
                                <th style="text-align: center;">Voucher No</th>
                                <th style="text-align: center;">Description</th>
                                <th style="text-align: center;">Cheque No</th>
                                <th style="text-align: center;">Amount</th>
                                <th style="text-align: center;">Account Head</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </section>
            <!-- /.content -->
  
        <!-- /.content-wrapper--modal-for-entry -->
        <div class="modal fade" id="modal-default">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Add a transaction to bank book</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form role="form">
                  <div class="row">
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Transaction date</label>
                        <input type="text" class="form-control" id="transactionDate" placeholder="Enter ...">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Effective Date</label>
                        <input type="text" class="form-control" id="effectiveDate" placeholder="Enter ...">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Description</label>
                        <input type="text" class="form-control" id="description" placeholder="Enter ...">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Account head</label>
                        <select class="custom-select" id="account_head">
                          <option value="0">Select...</option>
                          {{-- <option value="2">Cash In Bank</option>
                          <option value="3">PF Settlement</option>
                          <option value="4">Deposit Amount</option> --}}
                          @foreach ($account_heads as $account_head)
                            <option value="{{ $account_head->id }}">{{ $account_head->account_head }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Voucher No</label>
                        <input type="text" class="form-control" id="voucherno" placeholder="Enter ...">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Cheque No</label>
                        <input type="text" class="form-control" id="chequeno" placeholder="Enter ...">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Amount</label>
                        <input type="number" class="form-control" id="amount" placeholder="000">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Type</label>
                        <select class="custom-select" id="transaction_type">
                          <option value="IN">CASH IN</option>
                          <option value="OUT">CASH OUT</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                  <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Transaction Type</label>
                        <select class="custom-select" id="transaction_type">
                          <option value="R">Bank Reconciliation</option>
                          <option value="B">Bank Book</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
              <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal" id="closeTransaction">Close</button>
                <button type="button" class="btn btn-primary" id="saveTransaction">Save changes</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
    @endsection

    @section('customjs')
    <script>
        const Toast = Swal.mixin({
              toast: true,
              position: 'top-end',
              showConfirmButton: false,
              timer: 4000
        });

        $(function () {
            $("#bankrecon thead").empty();
            $("#bankrecon tbody").empty();

            $("#bankbook thead").empty();
            $("#bankbook tbody").empty();


            $('#from_date').datepicker({
                //format: "yyyy-mm-dd",
                orientation: "bottom left",
                format: "yyyy-mm",
                startView: "months", 
                minViewMode: "months"
            });

            $('#transactionDate').datepicker({
                format: "yyyy-mm-dd",
                orientation: "bottom left"
            });

            $('#effectiveDate').datepicker({
                format: "yyyy-mm-dd",
                orientation: "bottom left"
            });

            $('#saveTransaction').click(function() {

              //get the data
              var transactionDate = $('#transactionDate').val();
              var effectiveDate = $('#transactionDate').val();
              var description = $('#description').val();
              var account_head = $('#account_head').val();
              var voucherno = $('#voucherno').val();
              var chequeno = $('#chequeno').val();
              var amount = $('#amount').val();
              var type = $('#transaction_type').val();

              if(description == '' || transactionDate == '' || effectiveDate == '' || amount == '' || amount == '0' || account_head == '0'){
                Toast.fire({
                  type: 'error',
                  title: ' Please enter all fields to save the transaction'
                });
              }
              
              else{
                
                //save the transaction
                $.ajax({
                  type: 'GET',
                  url: './save-monthly-bank-book',
                  data: {
                      transactionDate: transactionDate,
                      effectiveDate: effectiveDate,
                      description: description,
                      account_head: account_head,
                      voucherno: voucherno,
                      chequeno: chequeno,
                      amount: amount,
                      type: type
                  },
                  dataType: 'text',
                  success: function (data) {
                    console.log(data);
                    table.destroy();
                    generate_book();
                    $('#modal-default').modal('hide');
                
                    Toast.fire({
                      type: 'success',
                      title: ' Transaction successfully saved in Bank Book.'
                    });
                  }
                });
              }

              
            });


                

            $('#closeTransaction').click(function() {
              generate_book();
              $('#modal-default').modal('hide');
              //toastr.success('Transaction successfully saved in Bank Book.')
              Toast.fire({
                type: 'info',
                title: ' Transaction closed.'
              })
            });

            $('#generate').click(function() {
              generate_book();
            });
        });

        function generate_book(){
          from_date = $('#from_date').val();

          if(from_date == '' || from_date == undefined){
            Toast.fire({
              type: 'error',
              title: ' Please enter a date to calculate bank book for that month.'
            });
          }
          else{
            //--------------GENERATE BANK RECONCILIATION--------------//
            $.ajax({
              type: 'GET',
              url: './monthy-bank-book',
              data: {
                  from_date: from_date,
              },
              dataType: 'json',
              success: function (data) {
                console.log(data);
                
                $("#bankrecon thead").empty();
                $("#bankrecon tbody").empty();
                $("#bankrecon thead").append('<tr>'+
                    '<th style="text-align: center;">Date</th>'+
                    '<th style="text-align: center;">Voucher No</th>'+
                    '<th style="text-align: center;">Description</th>'+
                    '<th style="text-align: center;">Cheque No</th>'+
                    '<th style="text-align: center;">Amount</th>'+
                    '<th style="text-align: center;">Account Head</th>'+
                '</tr>');

                $.each(data, function(index, element) {

                  if(element.description == 'TOTAL'){
                    $("#bankrecon tbody").append("<tr class=\"table-info\">"
                      +"<td style=\"text-align: center;\">"+element.transaction_date+"</td>"
                      +"<td style=\"text-align: center;\">"+element.voucher_no+"</td>"
                      +"<td style=\"text-align: center;font-weight: bold;\">"+element.description+"</td>"
                      +"<td style=\"text-align: center;\">"+element.cheque_no+"</td>"
                      +"<td style=\"text-align: right;font-weight: bold;\">"+numberWithCommas(element.amount)+"</td>"
                      +"<td style=\"text-align: center;\">"+element.account_head+"</td>"
                      +"</tr>");
                  }
                  else{
                    $("#bankrecon tbody").append("<tr>"
                      +"<td style=\"text-align: center;\">"+element.transaction_date+"</td>"
                      +"<td style=\"text-align: center;\">"+element.voucher_no+"</td>"
                      +"<td style=\"text-align: center;\">"+element.description+"</td>"
                      +"<td style=\"text-align: center;\">"+element.cheque_no+"</td>"
                      +"<td class=\"table-danger\" style=\"text-align: right;\">"+numberWithCommas(element.amount)+"</td>"
                      +"<td style=\"text-align: center;\">"+element.account_head+"</td>"
                      +"</tr>");
                  }
                });
              }
            });
            //--------------GENERATE BANK RECONCILIATION--------------//

            //--------------GENERATE BANK BOOK--------------//
            $.ajax({
              type: 'GET',
              url: './monthly-bank-book-excel',
              data: {
                  from_date: from_date,
              },
              dataType: 'json',
              success: function (data) {
                console.log(data);
                
                $("#bankbook thead").empty();
                $("#bankbook tbody").empty();
                $("#bankbook thead").append('<tr>'+
                    '<th style="text-align: center;">Date</th>'+
                    '<th style="text-align: center;">Voucher No</th>'+
                    '<th style="text-align: center;">Description</th>'+
                    '<th style="text-align: center;">Cheque No</th>'+
                    '<th style="text-align: center;">Amount</th>'+
                    '<th style="text-align: center;">Account Head</th>'+
                '</tr>');
                var total = 0;
                $.each(data, function(index, element) {
                  
                    total += parseFloat(element.amount);

                    $("#bankbook tbody").append("<tr>"
                      +"<td style=\"text-align: center;\">"+element.transaction_date+"</td>"
                      +"<td style=\"text-align: center;\">"+element.voucher_no+"</td>"
                      +"<td style=\"text-align: center;\">"+element.description+"</td>"
                      +"<td style=\"text-align: center;\">"+element.cheque_no+"</td>"
                      +"<td class=\"table-danger\" style=\"text-align: right;\">"+numberWithCommas(element.amount)+"</td>"
                      +"<td style=\"text-align: center;\">"+element.account_head+"</td>"
                      +"</tr>");
    
                });

                $("#bankbook tbody").append("<tr class=\"table-info\">"
                      +"<td style=\"text-align: center;\"></td>"
                      +"<td style=\"text-align: center;\"></td>"
                      +"<td style=\"text-align: center;font-weight: bold;\">Total</td>"
                      +"<td style=\"text-align: center;\"></td>"
                      +"<td style=\"text-align: right;font-weight: bold;\">"+numberWithCommas(total)+"</td>"
                      +"<td style=\"text-align: center;\"></td>"
                      +"</tr>");
              }
            });
            //--------------GENERATE BANK BOOK--------------//
          }
        }


        function numberWithCommas(number) {
          if(number == 0 || number == undefined){
            return '0.00';
          }
          else{
            const fixedNumber = Number.parseFloat(number).toFixed(2);
            return String(fixedNumber).replace(/\B(?=(\d{3})+(?!\d))/g, ",");
          }
        }
    </script>

    @endsection

@extends('master')
@section('customcss')
<link rel="stylesheet" href="{{ asset('css/spin.css') }}">
@endsection

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Bank Transactions</h1>
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

            <button type="submit" id="addnewtransaction" class="btn btn-outline-success float-right" data-toggle="modal"
                data-target="#modal-default">Add a
                new Transaction</button>
        </div>
        <div class="example-spinner" id="spinner"></div>
        <!-- /.card-footer -->
    </div>

    <div class="card card-success card-outline">
        <div class="card-header">
            <h3 class="card-title">Difference : </h3>
            <h3 class="card-title" id="differenceVal">0</h3>
        </div>
        <!-- /.card-header -->
    </div>
    <!-- /.card BANK RECONCILIATION -->
    <!-- Default box -->
    <div class="card card-success card-outline">
        <div class="card-header">
            <h3 class="card-title">Bank Reconciliation</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
                    <i class="fas fa-minus"></i></button>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <button type="button" class="btn btn-success btn-sm" id="endofmonthButton" data-toggle="modal"
                data-target="#modal-endofmonth">Enter End of Month Balance</button>
            <button type="button" class="btn btn-warning btn-sm" id="chkDiff">Check Difference</button>
            <br />
            <br />
            <div style="overflow-x: auto;">
                <table id="bankrecon" class="table table-bordered table-striped table-sm">
                    <thead>
                        <tr>
                            <th style="text-align: center;">Date</th>
                            <th style="text-align: center;">Voucher No</th>
                            <th style="text-align: center;">Voucher Type</th>
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
    <!-- /.card BANK BOOK -->
    <div class="card card-success card-outline">
        <div class="card-header">
            <h3 class="card-title">Bank Book in Excel</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
                    <i class="fas fa-minus"></i></button>
            </div>
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
                            <th style="text-align: center;">Action</th>
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
                                    <!-- {{-- <option value="2">Cash In Bank</option>
                          <option value="3">PF Settlement</option>
                          <option value="4">Deposit Amount</option> --}} -->
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
                                <select class="custom-select" id="bank_transaction_type">
                                    <option value="R">Bank Reconciliation</option>
                                    <option value="B">Bank Book</option>
                                    <option value="BOTH">Bank Book with Reconciliation</option>
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

<!-- /.content-wrapper--modal-for-entry -->
<div class="modal fade" id="modal-endofmonth">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Enter End fo Month Balance</h4>
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
                                <label>Amount</label>
                                <input type="number" pattern="^[1-9]\d*$" class="form-control" id="amountEndOfMonth"
                                    placeholder="000">
                            </div>
                        </div>
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal" id="closeTransaction">Close</button>
                <button type="button" class="btn btn-primary" id="saveEndOfMonth">Save End of Month</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
</div>

<!-- Modal -->
<div class="modal fade" id="contributionModal" tabindex="-1" aria-labelledby="contributionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="contributionModalLabel">Update</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <div class="row">
                <div class="col-sm-6">
                    <!-- text input -->
                    <div class="form-group">
                        <label>Voucher No</label>
                        <input type="text" class="form-control" id="contribution_voucherno" placeholder="Enter ...">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Transaction date</label>
                        <input type="text" class="form-control" id="contribution_transactionDate" placeholder="Enter ...">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <!-- text input -->
                    <div class="form-group">
                        <label>Amount</label>
                        <input type="text" class="form-control" id="contribution_amount" >
                    </div>
                </div>
                <div class="col-sm-6">
                    <!-- text input -->
                    <div class="form-group">
                        <label>Description</label>
                        <input type="text" readonly class="form-control-plaintext" id="contribution_description" >
                    </div>
                    <input type="hidden" value="0" id="contributionIndex"/>
                </div>
            </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="updateContributionBtn">Save changes</button>
            </div>
        </div>
    </div>
</div>


@endsection

@section('customjs')
<script>
    var differenceVal = 0;
    var grcontotal = 0;
    var gbbtotal = 0;

    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 5000
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
        $('#contribution_transactionDate').datepicker({
            format: "yyyy-mm-dd",
            orientation: "bottom left"
        });
        $('#effectiveDate').datepicker({
            format: "yyyy-mm-dd",
            orientation: "bottom left"
        });
        $('#saveTransaction').click(function () {
            //get the data
            var transactionDate = $('#transactionDate').val();
            var effectiveDate = $('#effectiveDate').val();
            var description = $('#description').val();
            var account_head = $('#account_head').val();
            var voucherno = $('#voucherno').val();
            var chequeno = $('#chequeno').val();
            var amount = $('#amount').val();
            var type = $('#transaction_type').val();
            var bank_transaction_type = $('#bank_transaction_type').val();

            if (description == '' || transactionDate == '' || effectiveDate == '' || amount == '' ||
                amount == '0' || account_head == '0') {
                Toast.fire({
                    type: 'error',
                    title: ' Please enter all fields to save the transaction'
                });
            } else {

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
                        type: type,
                        bank_transaction_type: bank_transaction_type
                    },
                    dataType: 'text',
                    success: function (data) {

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

        $('#updateContributionBtn').click(function () {
            //get the data
            var transactionDate = $('#contribution_transactionDate').val();
            var description = $('#contribution_description').val();
            var voucher_no = $('#contribution_voucherno').val();
            var amount = $('#contribution_amount').val();
            var index = $('#contributionIndex').val();

            if (transactionDate == '' || voucher_no == '') {
                Toast.fire({
                    type: 'error',
                    title: ' Please enter all fields to save \n the Contribution information'
                });
            } else {

                //save the transaction
                $.ajax({
                    type: 'GET',
                    url: './update_contribution',
                    data: {
                        transactionDate: transactionDate,
                        description: description,
                        voucher_no: voucher_no,
                        amount: amount,
                        index : index,
                    },
                    dataType: 'text',
                    success: function (data) {
                        console.log(data);

                        if (data == 'success') {
                            generate_book();
                            $('#contributionModal').modal('hide');

                            Toast.fire({
                                type: 'success',
                                title: ' Contribution successfully saved.'
                            });
                        } else {
                            Toast.fire({
                                type: 'error',
                                title: data
                            });
                        }

                    }
                });
            }

        });

        $('#saveEndOfMonth').click(function () {
            amount = $('#amountEndOfMonth').val();
            from_date = $('#from_date').val();
            if (from_date == '' || from_date == undefined) {
                Toast.fire({
                    type: 'error',
                    title: ' Please enter a date and generate to enter End of Month Balance'
                });
                return;
            }

            if (amount == '' || amount == undefined) {
                Toast.fire({
                    type: 'error',
                    title: 'Please enter a valid amount'
                });
                return;
            }

            //save the transaction
            $.ajax({
                type: 'GET',
                url: './save-end-of-month',
                data: {
                    transactionDate: from_date,
                    amount: amount,
                },
                dataType: 'text',
                success: function (data) {
                    console.log(data);

                    if (data == 'success') {
                        generate_book();
                        $('#modal-endofmonth').modal('hide');

                        Toast.fire({
                            type: 'success',
                            title: ' Transaction successfully saved in Bank Book.'
                        });
                    } else {
                        Toast.fire({
                            type: 'error',
                            title: data
                        });
                    }

                }
            });


        });

        $('#chkDiff').click(function () {
            from_date = $('#from_date').val();
            if (from_date == '' || from_date == undefined) {
                Toast.fire({
                    type: 'error',
                    title: ' Please enter a date and generate to enter End of Month Balance'
                });
                return;
            }

            if (grcontotal > 0 && gbbtotal > 0) {
                if (grcontotal > gbbtotal) {
                    differenceVal = parseFloat(grcontotal) - parseFloat(gbbtotal);
                    $('#differenceVal').text(numberWithCommas(differenceVal));
                } else {
                    differenceVal = parseFloat(gbbtotal) - parseFloat(grcontotal);
                    $('#differenceVal').text(numberWithCommas(differenceVal));
                }
            }
            console.log('done');
        });

        $('#closeTransaction').click(function () {
            generate_book();
            $('#modal-default').modal('hide');
            //toastr.success('Transaction successfully saved in Bank Book.')
            Toast.fire({
                type: 'info',
                title: ' Transaction closed.'
            })
        });
        $('#generate').click(function () {
            generate_book();
        });
        $('#download').click(function () {
            //$('#spinner').removeClass('spinner');

        })
    });


    function generate_book() {
        from_date = $('#from_date').val();
        //$('#spinner').addClass('spinner');
        $('#generate').attr('disabled', true);
        $('#generate').addClass('loading-bar');
        if (from_date == '' || from_date == undefined) {
            Toast.fire({
                type: 'error',
                title: ' Please enter a date to calculate bank book for that month.'
            });
        } else {
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
                    $("#bankrecon thead").append('<tr>' +
                        '<th style="text-align: center;">Date</th>' +
                        '<th style="text-align: center;">Voucher No</th>' +
                        '<th style="text-align: center;">Voucher Type</th>' +
                        '<th style="text-align: center;">Description</th>' +
                        '<th style="text-align: center;">Cheque No</th>' +
                        '<th style="text-align: center;">Amount</th>' +
                        '<th style="text-align: center;">Account Head</th>' +
                        '</tr>');
                    var rcontotal = 0;
                    $.each(data, function (index, element) {
                        if (element.amount == undefined || element.amount == '') {} else
                            rcontotal += parseFloat(element.amount);
                        $("#bankrecon tbody").append("<tr>" +
                            "<td style=\"text-align: center;\">" + element.transaction_date +
                            "</td>" +
                            "<td style=\"text-align: center;\">" + element.voucher_no +
                            "</td>" +
                            "<td style=\"text-align: center;\">" + element.type + "</td>" +
                            "<td style=\"text-align: center;\">" + element.description +
                            "</td>" +
                            "<td style=\"text-align: center;\">" + element.cheque_no + "</td>" +
                            "<td class=\"table-danger\" style=\"text-align: right;\">" +
                            numberWithCommas(element.amount) + "</td>" +
                            "<td style=\"text-align: center;\">" + element.account_head +
                            "</td>" +
                            "</tr>");
                    });
                    $("#bankrecon tbody").append("<tr class=\"table-info\">" +
                        "<td style=\"text-align: center;\"></td>" +
                        "<td style=\"text-align: center;\"></td>" +
                        "<td style=\"text-align: center;\"></td>" +
                        "<td style=\"text-align: center;font-weight: bold;\">Total</td>" +
                        "<td style=\"text-align: center;\"></td>" +
                        "<td style=\"text-align: right;font-weight: bold;\">" + numberWithCommas(
                            rcontotal) + "</td>" +
                        "<td style=\"text-align: center;\"></td>" +
                        "</tr>");

                    grcontotal = rcontotal;
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
                    $('#generate').attr('disabled', false);
                    $('#generate').removeClass('loading-bar');
                    $("#bankbook thead").empty();
                    $("#bankbook tbody").empty();
                    $("#bankbook thead").append('<tr>' +
                        '<th style="text-align: center;">Date</th>' +
                        '<th style="text-align: center;">Voucher No</th>' +
                        '<th style="text-align: center;">Voucher Type</th>' +
                        '<th style="text-align: center;">Description</th>' +
                        '<th style="text-align: center;">Cheque No</th>' +
                        '<th style="text-align: center;">Amount</th>' +
                        '<th style="text-align: center;">Account Head</th>' +
                        '<th style="text-align: center;">Action</th>' +
                        '</tr>');
                    var total = 0;
                    var type = '';
                    $.each(data, function (index, element) {
                        if (element.amount > 0) {
                            type = 'Received'
                        } else {
                            type = ''
                        }

                        if (element.amount == undefined || element.amount == '') {} else total +=
                            parseFloat(element.amount);

                        if (element.account_head == undefined || element.account_head == '') {
                            //provide no add option to reconciliation
                            if (index < 1) {
                                $("#bankbook tbody").append("<tr>" +
                                    "<td style=\"text-align: center;\">" + element
                                    .transaction_date + "</td>" +
                                    "<td style=\"text-align: center;\">" + element.voucher_no +
                                    "</td>" +
                                    "<td style=\"text-align: center;\">" + element
                                    .voucher_type + "</td>" +
                                    "<td style=\"text-align: center;\">" + element.description +
                                    "</td>" +
                                    "<td style=\"text-align: center;\">" + element.cheque_no +
                                    "</td>" +
                                    "<td class=\"table-danger\" style=\"text-align: right;\">" +
                                    numberWithCommas(element.amount) + "</td>" +
                                    "<td style=\"text-align: center;\">" + element
                                    .account_head + "</td>" +
                                    "<td style=\"text-align: center;\"></td>" +
                                    "</tr>");
                            } else {
                                $("#bankbook tbody").append("<tr>" +
                                    "<td style=\"text-align: center;\" id=\"bankbook_transactionDate_" +
                                    index + "\">" + element.transaction_date +
                                    "</td>" +
                                    "<td style=\"text-align: center;\" id=\"bankbook_voucherNo_" +
                                    index + "\">" + element.voucher_no + "</td>" +
                                    "<td style=\"text-align: center;\">" + element
                                    .voucher_type + "</td>" +
                                    "<td style=\"text-align: center;\">" + element.description +
                                    "</td>" +
                                    "<td style=\"text-align: center;\">" + element.cheque_no +
                                    "</td>" +
                                    "<td class=\"table-danger\" style=\"text-align: right;\">" +
                                    numberWithCommas(element.amount) + "</td>" +
                                    "<td style=\"text-align: center;\">" + element
                                    .account_head + "</td>" +
                                    "<td style=\"text-align: center;\" onClick=\"updateToReconciliation('" +
                                    element.description + "'," + element.amount + "," + index +
                                    ")\"><span class=\"badge badge-primary\">UPDATE</span></td>" +
                                    "</tr>");
                            }

                        } else {
                            $("#bankbook tbody").append("<tr>" +
                                "<td style=\"text-align: center;\">" + element
                                .transaction_date + "</td>" +
                                "<td style=\"text-align: center;\">" + element.voucher_no +
                                "</td>" +
                                "<td style=\"text-align: center;\">" + element.voucher_type +
                                "</td>" +
                                "<td style=\"text-align: center;\">" + element.description +
                                "</td>" +
                                "<td style=\"text-align: center;\">" + element.cheque_no +
                                "</td>" +
                                "<td class=\"table-danger\" style=\"text-align: right;\">" +
                                numberWithCommas(element.amount) + "</td>" +
                                "<td style=\"text-align: center;\">" + element.account_head +
                                "</td>" +
                                "<td style=\"text-align: center;\" onClick=\"addToReconciliation('" +
                                element.id +
                                "')\"><span class=\"badge badge-warning\">ADD</span></td>" +
                                "</tr>");
                        }


                    });
                    $("#bankbook tbody").append("<tr class=\"table-info\">" +
                        "<td style=\"text-align: center;\"></td>" +
                        "<td style=\"text-align: center;\"></td>" +
                        "<td style=\"text-align: center;\"></td>" +
                        "<td style=\"text-align: center;font-weight: bold;\">Total</td>" +
                        "<td style=\"text-align: center;\"></td>" +
                        "<td style=\"text-align: right;font-weight: bold;\">" + numberWithCommas(
                        total) + "</td>" +
                        "<td style=\"text-align: center;\"></td>" +
                        "</tr>");
                    //remove spinner
                    gbbtotal = total;
                }
            });
            //--------------GENERATE BANK BOOK--------------//
        }
    }

    function addToReconciliation(id) {
        console.log(id);
        from_date = $('#from_date').val();
        if (from_date == '' || from_date == undefined) {
            Toast.fire({
                type: 'error',
                title: ' Please enter a date to calculate bank book for that month.'
            });
            return;
        }

        //add to reconciliation
        $.ajax({
            type: 'GET',
            url: './add_to_reconciliation',
            data: {
                transactionDate: from_date,
                id: id,
            },
            dataType: 'text',
            success: function (data) {
                console.log(data);

                if (data == 'success') {
                    generate_book();

                    Toast.fire({
                        type: 'success',
                        title: ' Transaction successfully added in Bank Reconciliation.'
                    });
                } else {
                    Toast.fire({
                        type: 'info',
                        title: data
                    });
                }
            }
        });

    }

    function updateToReconciliation(description, amount, index) {
        console.log(description, amount, index);
        $('#contributionModalLabel').text(description);
        $('#contribution_amount').val(amount);
        $('#contribution_description').val(description);
        $('#contributionModal').modal('show');
        $('#contributionIndex').val(index);
    }

    function numberWithCommas(number) {
        if (number == 0 || number == undefined) {
            return '0.00';
        } else {
            const fixedNumber = Number.parseFloat(number).toFixed(2);
            return String(fixedNumber).replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }
    }

</script>

@endsection

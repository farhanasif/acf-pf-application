<!DOCTYPE html>
<html>
  <title>&nbsp;</title>
  <head>
    <meta charset="UTF-8">
    <title>&nbsp;</title>
    <!-- <link rel="stylesheet"  type="text/css"  href="print.css" media="print" /> -->
    <!-- <style type="text/css" media="all"> @import "print.css";</style> -->
    <link rel="stylesheet" type="text/css" media="all" href="{{ URL::to('css/report_print.css') }}" />

  </head>
  <body>
    <button class="print-button">Print Page</button>
    <div class="lik-uftcl-ptf-main-body">
      <div class="lik-uftcl-ptf-print-body">
        <form>
          <div class="lik-uftcl-pdf-header"></div>
          <div class="lik-uftcl-pdf-body">
            <!-- body header part section start -->
            <div class="main-2">
              <div class="body-top">
                <p class="ptf-ln-3">
                  <span><b>Employee History</b></span>
                </p>
                <div class="top-info">
                  <p class="ptf-ln-top-5">
                    <span><b>Employer</b></span>
                    <b><span>:</span>
                    <span>Action Contre La Faim <br/>
                    House-23, Road- 113/A, Gulshan-2, Dhaka-1212, Bangladesh </span></b>
                  </p>
                  <img src="{{ asset('images/logo/acf-pf.png') }}" alt="acf" style="width: 200px;height: 100px;margin-left: auto;margin-right: auto;">
                  <p class="ptf-ln-top-6">
                    <span></span>
                    <b><span></span>
                    <span></span>
                    </b>
                  </p>
                  <p class="ptf-ln-top-4" style="">
                    <span><b>Workplace</b></span>
                    <b><span>:</span>
                    <span>{{ $userInfo[0]->work_place }}</span></b>
                  </p>
                  <p class="ptf-ln-top-6">
                    <span><b>Project Subdivision</b>
                      <b><span>:</span>
                      <span>{{ $userInfo[0]->sub_location }}</span>
                      </b>
                    </p>

                  </div>
                  <div class="top-info">
                    <p class="ptf-ln-top-4" style="">
                      <span>Employee</span>
                      <b><span>:</span>
                      <span></span></b>
                    </p>
                    <p class="ptf-ln-top-5">
                      <span>Staff Code</span>
                      <b><span>:</span>
                      <span>{{ sprintf('%04d', $userInfo[0]->staff_code) }}</span></b>
                    </p>
                    <p class="ptf-ln-top-6">
                      <span>First Name</span>
                      <b><span>:</span>
                      <span>{{ $userInfo[0]->first_name }}</span>
                      </b>
                    </p>
                    <p class="ptf-ln-top-6">
                      <span>Last Name</span>
                      <b><span>:</span>
                      <span>{{ $userInfo[0]->last_name }}</span>
                      </b>
                    </p>
                    <p class="ptf-ln-top-6">
                      <span>Designation</span>
                      <b><span>:</span>
                      <span>{{ $userInfo[0]->position }}</span>
                      </b>
                    </p>
                    <p class="ptf-ln-top-6">
                      <span>Level</span>
                      <b><span>:</span>
                      <span>{{ $userInfo[0]->level }}</span>
                      </b>
                    </p>
                    <p class="ptf-ln-top-6">
                      <span>Department</span>
                      <b><span>:</span>
                      <span>{{ $userInfo[0]->department_code }}</span>
                      </b>
                    </p>
                    <p class="ptf-ln-top-6">
                      <span>Entry Date</span>
                      <b><span>:</span>
                      <span>{{ $userInfo[0]->joining_date }}</span>
                      </b>
                    </p>
                    <p class="ptf-ln-top-6">
                      <span>Contract start Date</span>
                      <b><span>:</span>
                      <span>{{ $userInfo[0]->joining_date }}</span>
                      </b>
                    </p>
                    <p class="ptf-ln-top-6">
                      <span>Contract end Date</span>
                      <b><span>:</span>
                      <span><?php if($userInfo[0]->ending_date != "1970-01-01")  echo $userInfo[0]->ending_date; ?></span>
                      </b>
                    </p>
                  </div>
                  <div class="top-info">
                    <p style="font-size: 13px;margin:5px;"><b>Month : </b></p>
                  </div>
                </div>
              </div>
              <table class="settlement" width="800" style="table-layout:fixed;">
                <tbody>
                <tr class="">
                  <th>Description</th>
                  <th>Base</th>
                  <th>Employee Contribution</th>
                  <th>Employer Contribution</th>
                  <th>Total</th>
                </tr>
              </tbody>
            </table>
            <table class="settlement-table" width="800" style="table-layout:fixed; margin-bottom: 10px;">
            <tbody>
              <tr><td>Provident fund Balance without interest</td>
              <td>10</td>
              <td>{{ $userInfo[0]->employee_contribution }}</td>
              <td>{{ $userInfo[0]->employer_contribution }}</td>
              <td>{{ $userInfo[0]->employee_contribution + $userInfo[0]->employer_contribution }}</td></tr>
              <tr><td>Interest received after Audit</td>
              <td>2</td>
              <td>{{ $userInfo[0]->employee_contribution * ($userInfo[0]->interest_percent/100) }}</td>
              <td>{{ $userInfo[0]->employer_contribution * ($userInfo[0]->interest_percent/100) }}</td>
              <td>{{ ($userInfo[0]->employee_contribution * ($userInfo[0]->interest_percent/100)) + ($userInfo[0]->employer_contribution * ($userInfo[0]->interest_percent/100)) }}</td></tr>
              <tr><td><b>Provident fund Balance with interest</b></td>
              <td></td>
              <td></td>
              <td></td>
              <td><b>{{ $userInfo[0]->employee_contribution + $userInfo[0]->employer_contribution + ($userInfo[0]->employee_contribution * ($userInfo[0]->interest_percent/100)) + ($userInfo[0]->employer_contribution * ($userInfo[0]->interest_percent/100)) }}</b></td></tr>
              <tr><td>Maximum Loan Amount 80%  Balance</td>
              <td></td>
              <td></td>
              <td></td>
              <td>{{ number_format(($userInfo[0]->employee_contribution + $userInfo[0]->employer_contribution + ($userInfo[0]->employee_contribution * ($userInfo[0]->interest_percent/100)) + ($userInfo[0]->employer_contribution * ($userInfo[0]->interest_percent/100))) * 0.8, 2) }}</td></tr>
              <tr><td><b>Loan Date:</b></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td></tr>
              <tr><td>Installment  without Interest Amount</td>
              <td>{{ number_format($data[0]->monthly_installment, 2)}}</td>
              <td></td>
              <td></td>
              <td></td></tr>

              <tr><td>Installment Interest Amount</td>
              <td>{{ number_format($data[0]->monthly_interest, 2)}}</td>
              <td></td>
              <td></td>
              <td></td></tr>
              <tr><td>Installment  with Interest Amount</td>
              <td>{{ number_format($data[0]->monthly_installment + $data[0]->monthly_interest, 2)}}</td>
              <td></td>
              <td></td>
              <td></td></tr>

              <tr><td>Loan Disbursement Amount</td>
              <td></td>
              <td></td>
              <td></td>
              <td>{{ number_format($data[0]->loan_amount, 2)}}</td></tr>

              <tr><td>Loan Interest Amount</td>
              <td></td>
              <td></td>
              <td></td>
              <td>{{ number_format($data[0]->interest, 2)}}</td></tr>

              <tr><td><b>Total Loan Amount with Interest</b></td>
              <td></td>
              <td></td>
              <td></td>
              <td><b>{{ number_format($data[0]->loan_amount + $data[0]->interest, 2)}}</b></td></tr>


              <tr><td>Paid loan Installment without interest</td>
              <td>{{ $loan_details[0]->num_of_paid_installment }}</td>
              <td></td>
              <td></td>
              <td>{{ number_format($loan_details[0]->without_interest_paid_loan,2) }}</td></tr>

              <tr><td>Due loan Installment without interest</td>
              <td>{{ $loan_details[0]->num_of_due_installment }}</td>
              <td></td>
              <td></td>
              <td>{{ number_format($loan_details[0]->without_interest_due_loan,2) }}</td></tr>

              <tr><td>Paid loan Installment with interest</td>
              <td>{{ $loan_details[0]->num_of_paid_installment }}</td>
              <td></td>
              <td></td>
              <td>{{ number_format($loan_details[0]->with_interest_paid_loan,2) }}</td></tr>

              <tr><td>Due loan Installment with interest</td>
              <td>{{ $loan_details[0]->num_of_due_installment }}</td>
              <td></td>
              <td></td>
              <td>{{ number_format($loan_details[0]->with_interest_due_loan, 2) }}</td></tr>

              <tr><td><b>Total Balance:</b></td>
              <td></td>
              <td></td>
              <td></td>
              <td><b>{{ number_format(($userInfo[0]->employee_contribution + $userInfo[0]->employer_contribution + ($userInfo[0]->employee_contribution * ($userInfo[0]->interest_percent/100)) + ($userInfo[0]->employer_contribution * ($userInfo[0]->interest_percent/100))) - $data[0]->loan_amount, 2)  }}</b></td></tr>
            </tbody>
            </table>
            <div style="">
              <div style="width: 45%;border: 1px solid #000; border-radius: 10px;float: right;text-align: center;">
                <p style="font-weight: 600;font-size: 16px;"><b><u>Net Balance</u></b></p>
                <p style="font-size: 18px;font-weight: 700;"><b><u>BDT  {{ number_format((($userInfo[0]->employee_contribution + $userInfo[0]->employer_contribution + ($userInfo[0]->employee_contribution * ($userInfo[0]->interest_percent/100)) + ($userInfo[0]->employer_contribution * ($userInfo[0]->interest_percent/100))) - $data[0]->loan_amount) + $loan_details[0]->without_interest_paid_loan, 2) }}</u></b></p>
              </div>
<!--               <div style="width: 45%;border: 1px solid #000; border-radius: 10px;float: left;text-align: center;">
                <p style="font-weight: 600;font-size: 16px;"><b><u>Net to Pay</u></b></p>
                <p style="font-size: 18px;font-weight: 700;"><b><u>BDT 12,333</u></b></p>
              </div> -->
            </div>

            <div class="lik-uftcl-pdf-body" style="width: 795px!important;margin-top: 100px;">
              <div class="right-header" style="width: 35%;">
                <!-- <p style="font-size: 18px;margin: 5px;text-decoration: overline;"><b>Signature Employee</b></p> -->
              </div>
              <div class="left-header" style="width: 60%;float: right!important;">
                 <div style="width: 46%;float: left;">
                    <p style="font-size: 16px;margin: 5px;text-decoration: overline;"><b>Signature Employee</b></p>
                 </div>
                 <div style="width: 46%;float: right;">
                <p style="font-size: 16px;margin: 5px;text-decoration: overline;"><b>Singature Trustee Board</b></p>
                </div>
              </div>
            </div>
            <div class="main-2" style="margin-top: 8px;">
              <div class="body-top">
                <p class="ptf-ln-3">
                  <span><b><u>Comments</u></b></span>
                </p>
              </div>
            </div>
            <!-- table section end -->
            <div class="body-mid" style="padding-top: 25px;">
              <p style="text-align: center;font-size: 12px;line-height: .5;">"Please report to us within 48 hours if this statement is incorrect. Otherwise this statement will be considered to be confirmed by you."</p>
              <hr style="border-top:.5px dotted;">
              <div class="body-mid-left">
                <span style="font-size: 12px;"><b>Print Date</b></span>
                <span style="font-size: 12px;">:</span>
                <span style="font-size: 12px;"><?php echo date('d-M-Y'); ?></span>
              </div>
              <div class="body-mid-right2">
                <span style="font-size: 12px;"><b>Page 1 of 1</b></span>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
  <script src="{{ asset('js/jquery.min.js') }}"></script>
  <script>
  $(".print-button").on("click", function() {
  $("#search-grid").hide();
  $(".main-footer").hide();
  $('#title_data').hide();
  $('.print-button').hide();
  window.print();
  window.location = url;
  });
  </script>
</body>
</html>

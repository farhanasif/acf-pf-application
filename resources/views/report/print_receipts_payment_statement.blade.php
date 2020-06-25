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
            <!--             <div class="header-part">
              <img src="../images/logo/acf2acf.jpg" alt="acf" style="width: 300px;height: 100px;margin-left: auto;margin-right: auto;display: block;">
              <div class="header">
                <h2 style="text-align: center;">Individual Staff Balance for Provident Fund as on 31 Decembar</h2>
                <span style="line-height: 1.5;"></span>
              </div>
            </div> -->
            <div class="main-2" style="border-radius: 0px!important; padding: 0px!important;">
              <div class="body-top">
                <p class="ptf-ln-3">
                  <span>ACTION CONTRE LA FAIM <br /> EMPLOYEES PROVIDENT FUND</span>
                  <span></span>
                  <img src="../images/logo/acf-pf.png" alt="acf" style="width: 200px;height: 100px;margin-left: auto;margin-right: auto;">
                  <span>STATEMENTS OF RECEIPTS AND PAYMENTS <br /> FOR THE YEAR {{ $date_info['from_date'] }} to {{ $date_info['to_date'] }}</span>
                </p>
              </div>
              <table class="settlement" width="800" style="table-layout:fixed; border-radius: 0px!important; width: 788px;border: none;border-top: 1px solid #000;margin-top: 0px!important;">
                <tbody>
                  <tr class="">
                    <th>Particulars</th>
                    <th>Note</th>
                    <th>{{ $date_info['from_date'] }}</th>
                    <th>{{ $date_info['to_date'] }}</th>
                  </tr>
                </tbody>
              </table>
              <table class="settlement-table" width="800" style="table-layout:fixed; margin-bottom: 10px; width: 788px;border: none;border-top: 1px solid #000;">
                <tbody>
                  <tr>
                    <td><b>RECEIPTS : </b></td>
                    <td></td>
                    <td></td>
                    <td></td></tr>
                    <tr><td>Employees Contribution</td>
                <td></td>
                <td style="text-align: right;">{{ $contribution[0]->own_formAmount }}</td>
                <td style="text-align: right;">{{ $contribution[0]->own_toAmount }}</td></tr>
                <tr><td>Employers Contribution</td>
                <td></td>
                <td style="text-align: right;">{{ $contribution[0]->organization_formAmount }}</td>
                <td style="text-align: right;">{{ $contribution[0]->organization_toAmount }}</td></tr>
                    <tr><td>Bank Interest (Saving Account)</td>
                    <td></td>
                    <td style="text-align: right;">{{ number_format($investment[0]->formAmount, 2) }}</td>
                    <td style="text-align: right;">{{ number_format($investment[0]->toAmount, 2) }}</td></tr>

                    <tr><td style="text-align: right;"> <b>Total Taka:</b></td>
                    <td></td>
                    <td style="text-align: right;"><b>{{ number_format($contribution[0]->own_formAmount + $contribution[0]->organization_formAmount + $investment[0]->formAmount , 2 )}}</b></td>
                    <td style="text-align: right;"><b>{{ number_format($contribution[0]->own_toAmount + $contribution[0]->organization_toAmount + $investment[0]->toAmount , 2 )}}</b></td>
                  </tr>
                  <tr><td style="height: 16px;"><b></b></td>
                  <td style="height: 16px;"></td>
                  <td style="height: 16px;"></td>
                  <td style="height: 16px;"><b></b></td></tr>
                  <tr>
                    <td><b>PAYMENTS : </b></td>
                    <td></td>
                    <td></td>
                    <td></td></tr>
                    <tr><td>Investment (Sanchayapatra)</td>
                    <td></td>
                    <td style="text-align: right;">{{ $pay1[0]->formAmount }}</td>
                    <td style="text-align: right;">{{ $pay1[0]->toAmount }}</td></tr>

                    <tr><td>Payments to Members</td>
                    <td></td>
                    <td style="text-align: right;">{{ $pay3[0]->formAmount }}</td>
                    <td style="text-align: right;">{{ $pay3[0]->formAmount }}</td></tr>

                    <tr><td>Bank Charge</td>
                    <td></td>
                    <td style="text-align: right;">{{ $pay2[0]->formAmount }}</td>
                    <td style="text-align: right;">{{ $pay2[0]->toAmount }}</td></tr>
                    <tr><td style="text-align: right;"> <b>Total Payments:</b></td>
                    <td></td>
                    <td style="text-align: right;"><b>{{ number_format($pay1[0]->formAmount + $pay2[0]->formAmount + $pay3[0]->formAmount,2) }}</b></td>
                    <td style="text-align: right;"><b>{{ number_format($pay1[0]->toAmount + $pay2[0]->toAmount +  $pay3[0]->toAmount,2) }}</b></td>
                  </tr>
                  <tr><td style="height: 16px;"><b></b></td>
                  <td style="height: 16px;"></td>
                  <td style="height: 16px;"></td>
                  <td style="height: 16px;"><b></b></td></tr>
                  <tr><td>Closing Balance: </td>
                  <td></td>
                  <td></td>
                  <td></td></tr>
                  <tr><td>Cash At Bank</td>
                  <td></td>
                  <td style="text-align: right;">{{ $closing_bal[0]->formAmount }}</td>
                  <td style="text-align: right;">{{ $closing_bal[0]->toAmount }}</td>
                <tr></tr>
                <tr><td style="height: 16px;"><b></b></td>
                <td style="height: 16px;"></td>
                <td style="height: 16px;"></td>
                <td style="height: 16px;"><b></b></td></tr>
                <tr><td style="text-align: right;"> <b>Total Taka:</b></td>
                <td></td>
                <td style="text-align: right;"><b>{{ number_format($contribution[0]->own_formAmount + $contribution[0]->organization_formAmount + $investment[0]->formAmount + $pay1[0]->formAmount + $pay2[0]->formAmount + $pay3[0]->formAmount +  $closing_bal[0]->formAmount, 2 )}}</b></td>
                <td style="text-align: right;"><b>{{ number_format($contribution[0]->own_toAmount + $contribution[0]->organization_toAmount + $investment[0]->toAmount + $pay1[0]->toAmount + $pay2[0]->toAmount + $pay3[0]->toAmount + $closing_bal[0]->toAmount , 2 )}}</b></td>
              </tr>
            </tbody>
          </table>
          <div style="">
            <p style="margin-top: 4px;margin-left: 5px;margin-bottom: 3px;">1.00 Figures hav been rounded off to the nearest taka.</p>
            <p style="margin-top: 2px;margin-left: 5px;margin-bottom: 3px;">2.00 Annexed notes form part of the accounts.</p>
          </div>
          <div class="lik-uftcl-pdf-body" style="width: 788px!important;margin-top: 60px;margin-bottom: 0px;">
            <div class="right-header" style="width: 35%;float: right!important;">
              <div style="width: 90%;float: left;">
                <p style="font-size: 16px;margin: 5px;"><b>(Chairman of CPF Trust)</b></p>
              </div>
            </div>
            <div class="left-header" style="width: 60%;float: right!important;">
              <div style="width: 46%;float: left;">
                <p style="font-size: 16px;margin: 5px;"><b>(Member of CPF Trust)</b></p>
              </div>
              <div style="width: 46%;float: right;">
                <p style="font-size: 16px;margin: 5px;"><b>(Secretary of CPF Trust)</b></p>
              </div>
            </div>
          </div>

          <div class="lik-uftcl-pdf-body" style="width: 788px!important;margin-top: 60px;margin-bottom: 15px;">
            <div class="right-header" style="width: 35%;float: right!important;">
              <div style="width: 90%;float: left;">
                <p style="font-size: 16px;margin: 5px;"><b>(Toha Khan Zaman & Co.)</b> <br/> <span style="margin-right: 15px;">Chartered Accountants</span></p>
              </div>
            </div>
            <div class="left-header" style="width: 60%;float: right!important;">
               <p style="font-size: 15px;">Signed in terms of our separate report of even date annexed.</p>
               <br>
               <p style="font-size: 15px;">Dated, Dhaka</p>
               <p style="font-size: 15px;">17 June 2020</p>
            </div>
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

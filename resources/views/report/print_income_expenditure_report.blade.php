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
                  <span>STATEMENTS OF COMPREHENSIVE INCOME <br /> (INCOME AND EXPENDITURE ACCOUNT) <br /> FOR THE YEAR {{ $date_info['from_date'] }} to {{ $date_info['to_date'] }}</span>
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
                    <td><b>INCOME : </b></td>
                    <td></td>
                    <td></td>
                    <td></td></tr>
                    <?php $total_income_form = 0;$total_income_to = 0; foreach ($incomes as $income) { $total_income_form += $income->formAmount; $total_income_to += $income->toAmount;?>
                    <tr><td>{{ $income->account_head }}</td>
                    <td></td>
                    <td style="text-align: right;">{{ number_format($income->formAmount,2) }}</td>
                    <td style="text-align: right;">{{ number_format($income->toAmount,2) }}</td></tr>
                    <?php } ?>
                    <tr><td style="height: 16px;"><b></b></td>
                    <td style="height: 16px;"></td>
                    <td style="height: 16px;"></td>
                    <td style="height: 16px;"><b></b></td></tr>
                    <tr><td style="text-align: right;"> <b>Total Taka:</b></td>
                    <td></td>
                    <td style="text-align: right;"><b><?php echo number_format($total_income_form,2); ?></b></td>
                    <td style="text-align: right;"><b><?php echo number_format($total_income_to,0); ?></b></td>
                  </tr>
                  <tr><td style="height: 16px;"><b></b></td>
                  <td style="height: 16px;"></td>
                  <td style="height: 16px;"></td>
                  <td style="height: 16px;"><b></b></td></tr>
                  <tr>
                    <td><b>EXPENDITURE : </b></td>
                    <td></td>
                    <td></td>
                    <td></td></tr>
                    <?php $total_expen_form = 0;$total_expen_to = 0; foreach ($expens as $expen) { $total_expen_form += $expen->formAmount < 0? $expen->formAmount*-1 : $expen->formAmount; $total_expen_to += $expen->toAmount < 0 ? $expen->toAmount*-1: $expen->toAmount;?>
                    <tr><td>{{ $expen->account_head }}</td>
                    <td></td>
                    <td style="text-align: right;">{{ $expen->formAmount < 0 ? number_format( $expen->formAmount*-1,2) : number_format( $expen->formAmount,2) }}</td>
                    <td style="text-align: right;">{{ $expen->toAmount < 0 ? number_format( $expen->toAmount*-1,2) : number_format( $expen->toAmount,2) }}</td></tr>
                     <?php } ?>
                    <tr><td style="height: 16px;"><b></b></td>
                    <td style="height: 16px;"></td>
                    <td style="height: 16px;"></td>
                    <td style="height: 16px;"><b></b></td></tr>
                    <tr><td style="text-align: right;"> <b>Total Expenditure Taka:</b></td>
                    <td></td>
                    <td style="text-align: right;"><b><?php echo number_format($total_expen_form,2); ?></b></td>
                    <td style="text-align: right;"><b><?php echo number_format($total_expen_to,2); ?></b></td>
                  </tr>
                  <tr><td style="height: 16px;"><b></b></td>
                  <td style="height: 16px;"></td>
                  <td style="height: 16px;"></td>
                  <td style="height: 16px;"><b></b></td></tr>
                  <tr><td>Surplus(Deficit) of Income over Expenditure</td>
                  <td></td>
                  <td style="text-align: right;"><?php echo number_format($total_income_form - $total_expen_form, 2); ?></td>
                  <td style="text-align: right;"><?php echo number_format($total_income_to - $total_expen_to, 2); ?></td>
                <tr></tr>
                <tr><td style="height: 16px;"><b></b></td>
                <td style="height: 16px;"></td>
                <td style="height: 16px;"></td>
                <td style="height: 16px;"><b></b></td></tr>
                <tr><td style="text-align: right;"> <b>Total Taka:</b></td>
                <td></td>
                <td style="text-align: right;"><b><?php echo number_format($total_income_form - $total_expen_form, 2); ?></b></td>
                <td style="text-align: right;"><b><?php echo number_format($total_income_to - $total_expen_to, 2); ?></b></td>
              </tr>
              <tr><td style="height: 16px;"><b></b></td>
              <td style="height: 16px;"></td>
              <td style="height: 16px;"></td>
              <td style="height: 16px;"><b></b></td></tr>
              <tr>
                <td><b>DISTRIBUTION ON INTEREST : </b></td>
                <td></td>
                <td></td>
                <td></td></tr>
                <tr><td>Employees Contribution</td>
                <td></td>
                <td style="text-align: right;">{{ $interest[0]->own_form }}</td>
                <td style="text-align: right;">{{ $interest[0]->own_to }}</td></tr>
                <tr><td>Employers Contribution</td>
                <td>11.01</td>
                <td style="text-align: right;">{{ $interest[0]->organization_form }}</td>
                <td style="text-align: right;">{{ $interest[0]->organization_to }}</td></tr>
                <tr><td style="height: 16px;"><b></b></td>
                <td style="height: 16px;"></td>
                <td style="height: 16px;"></td>
                <td style="height: 16px;"><b></b></td></tr>
                <tr style=""><td style="text-align: right;"> <b>Total Taka:</b></td>
                <td></td>
                <td style="text-align: right;"><b><?php echo number_format($total_income_form - $total_expen_form, 2); ?></b></td>
                <td style="text-align: right;"><?php echo number_format($total_income_to - $total_expen_to, 2); ?></td>
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

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
            <div class="header-part">
              <!-- body header part left section start -->
              <img src="../images/logo/acf2acf.jpg" alt="acf" style="width: 300px;height: 100px;margin-left: auto;margin-right: auto;display: block;">
              <div class="header">
                <h2 style="text-align: center;">Individual Staff Balance for Provident Fund as on 31 Decembar</h2>
                <span style="line-height: 1.5;"></span>
              </div>
            </div>
            <div class="left-header">
              <p style="line-height: 3.5; font-size: 18px;"><b>Date : <?php echo date('d-M-Y'); ?></b></p>
            </div>
            <div class="lik-uftcl-pdf-body" style="border: 1px solid gray;width: 795px!important;">
              <div class="left-header" style="width: 45%;">
                <p style="font-size: 16px;margin: 5px;"><b>Employer</b></p>
              </div>
              <div class="right-header" style="border-left: 1px solid gray;">
                <p style="font-size: 16px;margin: 5px;text-align: left!important;"><b>Action Contre La Faim <br /> <br />House-23, Road- 113/A, Gulshan-2, Dhaka-1212, Bangladesh</b></p>
              </div>
            </div>
            <div class="lik-uftcl-pdf-body" style="border: 1px solid gray;width: 795px!important;">
              <div class="left-header" style="width: 45%;">
                <p style="font-size: 16px;margin: 5px;margin-top: 10px;margin-bottom:10px;"><b>Staff Code</b></p>
              </div>
              <div class="right-header" style="border-left: 1px solid gray;">
                <p style="font-size: 16px;margin: 5px;margin-top: 10px;margin-bottom:10px;text-align: left!important;"><b>{{$info[0]->staff_code}}</b></p>
              </div>
            </div>
            <div class="lik-uftcl-pdf-body" style="border: 1px solid gray;width: 795px!important;">
              <div class="left-header" style="width: 45%;">
                <p style="font-size: 16px;margin: 5px;margin-top: 10px;margin-bottom:10px;"><b>First Name</b></p>
              </div>
              <div class="right-header" style="border-left: 1px solid gray;">
                <p style="font-size: 16px;margin: 5px;margin-top: 10px;margin-bottom:10px;text-align: left!important;"><b>{{$info[0]->first_name}}</b></p>
              </div>
            </div>
            <div class="lik-uftcl-pdf-body" style="border: 1px solid gray;width: 795px!important;">
              <div class="left-header" style="width: 45%;">
                <p style="font-size: 16px;margin: 5px;margin-top: 10px;margin-bottom:10px;"><b>Last Name</b></p>
              </div>
              <div class="right-header" style="border-left: 1px solid gray;">
                <p style="font-size: 16px;margin: 5px;margin-top: 10px;margin-bottom:10px;text-align: left!important;"><b>{{$info[0]->last_name}}</b></p>
              </div>
            </div>
            <div class="lik-uftcl-pdf-body" style="border: 1px solid gray;width: 795px!important;">
              <div class="left-header" style="width: 45%;">
                <p style="font-size: 16px;margin: 5px;margin-top: 10px;margin-bottom:10px;"><b>Designation</b></p>
              </div>
              <div class="right-header" style="border-left: 1px solid gray;">
                <p style="font-size: 16px;margin: 5px;margin-top: 10px;margin-bottom:10px;text-align: left!important;"><b>{{$info[0]->position }}</b></p>
              </div>
            </div>
            <div class="lik-uftcl-pdf-body" style="border: 1px solid gray;width: 795px!important;">
              <div class="left-header" style="width: 45%;">
                <p style="font-size: 16px;margin: 5px;margin-top: 10px;margin-bottom:10px;"><b>Workplace</b></p>
              </div>
              <div class="right-header" style="border-left: 1px solid gray;">
                <p style="font-size: 16px;margin: 5px;margin-top: 10px;margin-bottom:10px;text-align: left!important;"><b>{{$info[0]->base}}</b></p>
              </div>
            </div>
            <div class="lik-uftcl-pdf-body" style="border: 1px solid gray;width: 795px!important;margin-top: 20px;">
              <div class="left-header" style="width: 50%;">
                <p style="font-size: 16px;margin: 5px;margin-top: 10px;margin-bottom:10px;"><b>Employees Contribution</b></p>
              </div>
              <div class="right-header" style="border-left: 1px solid gray;width: 45%;">
                <p style="font-size: 16px;margin: 5px;margin-top: 10px;margin-bottom:10px;text-align: left!important;"><b>BDT = {{ number_format($info[0]->total_own_pf,2) }}</b></p>
              </div>
            </div>
            <div class="lik-uftcl-pdf-body" style="border: 1px solid gray;width: 795px!important;">
              <div class="left-header" style="width: 50%;">
                <p style="font-size: 16px;margin: 5px;margin-top: 10px;margin-bottom:10px;"><b>Employer's Contribution</b></p>
              </div>
              <div class="right-header" style="border-left: 1px solid gray;width: 45%;">
                <p style="font-size: 16px;margin: 5px;margin-top: 10px;margin-bottom:10px;text-align: left!important;"><b>BDT = {{ number_format($info[0]->total_organaization_pf,2) }}</b></p>
              </div>
            </div>
            <div class="lik-uftcl-pdf-body" style="border: 1px solid gray;width: 795px!important;">
              <div class="left-header" style="width: 50%;">
                <p style="font-size: 16px;margin: 5px;margin-top: 10px;margin-bottom:10px;"><b>Employees Contribution Interest</b></p>
              </div>
              <div class="right-header" style="border-left: 1px solid gray;width: 45%;">
                <p style="font-size: 16px;margin: 5px;margin-top: 10px;margin-bottom:10px;text-align: left!important;"><b>BDT = {{ number_format($info[0]->total_own_interest,2) }}</b></p>
              </div>
            </div>
            <div class="lik-uftcl-pdf-body" style="border: 1px solid gray;width: 795px!important;">
              <div class="left-header" style="width: 50%;">
                <p style="font-size: 16px;margin: 5px;margin-top: 10px;margin-bottom:10px;"><b>Employer's Contribution Interest</b></p>
              </div>
              <div class="right-header" style="border-left: 1px solid gray;width: 45%;">
                <p style="font-size: 16px;margin: 5px;margin-top: 10px;margin-bottom:10px;text-align: left!important;"><b>BDT = {{ number_format($info[0]->total_organization_interest,2) }}</b></p>
              </div>
            </div>

            <div class="lik-uftcl-pdf-body" style="border: 1px solid gray;width: 795px!important;margin-top: 20px;">
              <div class="left-header" style="width: 50%;">
                <p style="font-size: 16px;margin: 5px;margin-top: 10px;margin-bottom:10px;"><b>Total Amount:</b></p>
              </div>
              <div class="right-header" style="border-left: 1px solid gray;width: 45%;">
                <p style="font-size: 16px;margin: 5px;margin-top: 10px;margin-bottom:10px;text-align: left!important;"><b>BDT = {{ number_format($info[0]->total_amount,2) }}</b></p>
              </div>
            </div>

            <div class="lik-uftcl-pdf-body" style="width: 795px!important;margin-top: 160px;">
              <div class="left-header" style="width: 45%;">
                <p style="font-size: 18px;margin: 5px;text-decoration: overline;"><b>Signature Employee</b></p>
              </div>
              <div class="right-header" style="">
                <p style="font-size: 18px;margin: 5px;text-decoration: overline;"><b>Singature Trustee Board</b></p>
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
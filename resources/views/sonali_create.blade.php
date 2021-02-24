<?php header('Access-Control-Allow-Origin:*');?>
@extends('master')

@section('content')

    <!-- Main content -->
    <section class="content container-fluid">
        <button type="button" id='e_challan_payment' class='btn btn-success btn-minier btn-white btn-bold' style="margin-left: 30px;">
            <i class="fa fa-plus"></i> E-Challan Payment
        </button>


      <div class="row">

      </div>
      <!-- /.row -->



    </section>
    <!-- /.content -->

@endsection

@section('customjs')


    <script>
    $(document).ready(function () {

        var locale = "{{ Session::get('locale') }}";
        var root = "{{ URL::to('/') }}";
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        $('#e_challan_payment').on('click', function(e) {
                e.preventDefault();

                var api_token = "";
                var session_token = "";
                var get_token_data = {
                        "AccessUser":{
                            "userName":"bdtaxUser2014",
                            "password":"duUserPayment2014"
                        },
                        "strUserId":"bdtaxUser2014",
                        "strPassKey":"duUserPayment2014",
                        "strRequestId":"1554221212",
                        "strAmount":"1000",
                        "strTranDate":"2019-02-26",
                        "strAccounts":"0002634313655"
                    };

                var pyment_session_token_data = {
                        "Authentication": {
                            "ApiAccessUserId": "a2i@pmo",
                            "ApiAccessPassKey": api_token
                        },
                        "ReferenceInfo": {
                            "RequestId": "0222333876",
                            "RefTranNo": "2019031694/1/0108664611",
                            "RefTranDateTime": "2020-10-22 11:11:11",
                            "ReturnUrl": root + "/sonali_irc_form",
                            // "ReturnUrl": root + "/redirectPage",
                            "ReturnMethod": "POST",
                            "TranAmount": "100",
                            "ContactName": "Arif",
                            "ContactNo": "01744558899",
                            "PayerId": "na",
                            "Address": "applicentAddress",
                            "Paymode": "A02"
                        },
                        "CreditInformations": [
                            {
                                "SLNO": "1",
                                "CreditAccount": "1110000018754 ",
                                "CrAmount": "51",
                                "Purpose": "Challan Fee",
                                "Onbehalf": "Test"
                            },
                            {
                                "SLNO": "2",
                                "CreditAccount": "0002634313655",
                                "CrAmount": "49",
                                "Purpose": "Vat Fee",
                                "Onbehalf": "Test"
                            }
                        ]
                    };
                var data  = {'get_token_data': get_token_data, 'pyment_session_token_data': pyment_session_token_data};
                $.ajax({
                    // url: "https://27.147.153.82:6314/api/SpgService/GetSessionKey",
                    url: root+'/getSonaliBankApiToken',
                    data: data,
                    method: 'post',
                    success:function(response){
                      api_token = response;
                      // alert(api_token);
                      var url = "https://27.147.153.82:6332/SpgLanding/SpgLanding/"+ api_token;
                      window.location.href=url;
                      // window.open(url, '_blank');
                      // var data = >;
                      // console.log(data);
                    },
                    error: function(response) {
                        console.log(response.errors);
                    }
                });

               // function paymentSessionToken(api_token){
               //  var data['pyment_session_token_data'] = {
               //          "Authentication": {
               //              "ApiAccessUserId": "a2i@pmo",
               //              "ApiAccessPassKey": api_token
               //          },
               //          "ReferenceInfo": {
               //              "RequestId": "0222333876",
               //              "RefTranNo": "2019031694/1/0108664611",
               //              "RefTranDateTime": "2020-10-22 11:11:11",
               //              "ReturnUrl": "later",
               //              "ReturnMethod": "POST",
               //              "TranAmount": "100",
               //              "ContactName": "Arif",
               //              "ContactNo": "01744558899",
               //              "PayerId": "na",
               //              "Address": "applicentAddress",
               //              "Paymode": "M04"
               //          },
               //          "CreditInformations": [
               //              {
               //                  "SLNO": "1",
               //                  "CreditAccount": "1110000018754 ",
               //                  "CrAmount": "51",
               //                  "Purpose": "Challan Fee",
               //                  "Onbehalf": "Test"
               //              },
               //              {
               //                  "SLNO": "2",
               //                  "CreditAccount": "0002634313655",
               //                  "CrAmount": "49",
               //                  "Purpose": "Vat Fee",
               //                  "Onbehalf": "Test"
               //              }
               //          ]
               //      };

               //  $.ajax({
               //      // url: "https://27.147.153.82:6314/api/SpgService/GetSessionKey",
               //      url: baseUrl + '/user/form/renew_app/getSonaliBankPymentSessionToken',
               //      data: pyment_session_token_data,
               //      method: 'post',
               //      success:function(response){
               //          var data = JSON.parse(response);
               //          pending = false;
               //        // alert(response);
               //      },
               //      error: function(response) {
               //          console.log(response.errors);
               //      }
               //  });
               // }

            });
    });
    </script>

@stop
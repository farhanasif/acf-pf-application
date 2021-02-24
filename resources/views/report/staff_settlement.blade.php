@extends('master')
@section('content')
      <!-- Content Wrapper. Contains page content -->

        <!-- Content Header (Page header) -->
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1>Per Staff Settlement Report</h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                  <li class="breadcrumb-item active">Staff Settlement Report</li>
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
                <h3 class="card-title">Select Staff Code to continue</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                      <div class="col-sm-4">
                          <!-- select -->
                          <div class="form-group">
                          <label> Staff Code</label>
                            <select name="staff" id="staff" class="form-control select2bs4">
                              <option value="">--select--</option>
                                @foreach ($employees as $empolyee)
                                  <option value="{{ $empolyee->staff_code }}">{{ sprintf('%04d', $empolyee->staff_code) }} &nbsp;&nbsp; {{ $empolyee->first_name }} {{ $empolyee->last_name }}</option>
                                @endforeach
                            </select>
                          </div>
                      </div>

                    <div class="col-sm-4">
                            <div class="form-group">
                            <label>&nbsp;&nbsp; Settlement Date</label>
                              <div class="col-md-12 col-sm-12">
                                <input type="text" class="form-control" disabled name="settlement_date" placeholder="Settlement Date" id="settlement_date">
                              </div>
                            </div>
                    </div> 

                    <div class="col-sm-4">
                        <div class="form-group">
                        <label>&nbsp;&nbsp; Settlement Amount</label>
                          <div class="col-md-12 col-sm-12">
                            <input type="text" class="form-control" disabled name="settlement_amount" placeholder="Settlement Amount" id="settlement_amount">
                          </div>
                    </div>
                  </div> 

                  </div>

                </div>
                <!-- /.card-body -->
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="button" id="processToSettlement" disabled  style="border-radius: 0px" class="btn btn-success">Process To Settlement</button>
                </div>
    
                <!-- /.card-footer -->
            </div>

            <div class="card card-success card-outline">
                <div class="card-body">
                  <span id="expire_message"></span>
                  <a style="border-radius: 0px; display:none;" href="" id="staffSettlementView" class="btn btn-success float-right">View</a>
                </div>
            </div>

        </section>
        <!-- /.content -->
@endsection
@section('customjs')

<script>
$(document).ready(function() {

  $('#processToSettlement').on("click",function(){

    if (confirm('Are you sure set settlement?')) {
        var settlement_date = $("#settlement_date").val();
        var staff = $("#staff").val();
        var settlement_amount = $("#settlement_amount").val();

        var token = "{{ csrf_token() }}";
        var url_data = "{{ url('/expire-date-update-staff-settlement') }}";

      $.ajax({
          method: "POST",
          url: url_data,
          dataType: "json",
          data: {
              _token: token,
              staff:staff, settlement_date:settlement_date,settlement_amount:settlement_amount
          },
          success:function(data){
            console.log(data);
            $("#staff").val(null).trigger('change');
            $("#settlement_date").val('').prop('disabled', true);
            $("#settlement_amount").val('').prop('disabled', true);
            $("#processToSettlement").val('').prop('disabled', true);
            var message = 'This Settlement setted at '+ settlement_date;
            $("#expire_message").text(message);
          },
          error:function(data){
            console.log(data);
          }
      });
    } else {
      alert('Why did you press cancel? You should have confirmed');
    }




  });

  $('#staff').on("change", function(){

      // var settlement_date = $("#settlement_date").val(settlement_date);
      var staff = $(this).val();

      var token = "{{ csrf_token() }}";
      var url_data = "{{ url('/check-expire-date-staff-settlement') }}";

        $.ajax({
            method: "GET",
            url: url_data,
            dataType: "json",
            data: {
                _token: token,
                staff:staff
            },
            success:function (data){
                console.log(data);
                if( data.expire_date == 0){
                  $("#settlement_date").prop('disabled', false);
                  $("#settlement_amount").prop('disabled', false);
                  $("#processToSettlement").prop('disabled', false);
                  var message = 'This employee expire date empty';
                  $("#expire_message").text(message);
                }else{
                  var message = 'This employee already settlement at ' + data.expire_date;
                  $("#expire_message").text(message);
                  $("#settlement_date").prop('disabled', true);
                  $("#settlement_amount").prop('disabled', true);
                  $("#processToSettlement").prop('disabled', true);
                }

                // var base = window.location.origin;
                var url_data = "{{ url('/print-staff-settlement') }}";
                $('#staffSettlementView').attr('href',url_data+'/'+staff).attr('target','-_blank').css({display: "block"});

            },
            error:function(data){
              console.log(data);
            }
        });

    });


      $('.select2bs4').select2({
        theme: 'bootstrap4',
      });
  $(function() {
     $( "#settlement_date" ).datepicker({
          dateFormat: "YYYY-MM-DD HH:mm:ss",
          orientation: "bottom left"
     });
    });
  });
</script>

@endsection

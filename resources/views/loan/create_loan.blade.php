@extends('master')

@section('content')

<section class="content-header">
   <div class="container-fluid">
     <div class="row mb-2">
       <div class="col-sm-6">
         <h1>Create Loan Information </h1>
       </div>
       <div class="col-sm-6">
         <ol class="breadcrumb float-sm-right">
           <li class="breadcrumb-item"><a href="#">Home</a></li>
           <li class="breadcrumb-item active"><a href="#">Loan Management</a></li>
           <li class="breadcrumb-item active"><a href="#">Create Loan Information</a></li>
         </ol>
       </div>
     </div>
   </div><!-- /.container-fluid -->
 </section>

   <div class="card card-success card-outline">
        <div class="card-header">
          <h3 class="card-title">Create Loan Information</h3>
        </div>
        @if ($message = Session::get('success'))
          <div class="alert alert-success alert-block">
           <button type="button" class="close" data-dismiss="alert">×</button>
           <strong>{{ $message }}</strong>
          </div>
          @endif

          @if ($errors->any())
        <div class="alert alert-warning">
          <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
          @endif

        <div class="card-body">
          <!-- /.card -->
            <!-- Horizontal Form -->
           <form class="form-horizontal form-label-left" action="" method="post">
              @csrf
            <div class="form-group row">
            <label for="staff" class="col-form-label col-md-2 col-sm-2 label-align">Staff Name</label>
              <div class="col-md-4 col-sm-3">
                <select name="staff" id="staff" class="form-control select2bs4">
                   <option value="">--select--</option>
                    @foreach ($employees as $empolyee)
                      <option value="{{ $empolyee->staff_code }}">{{ sprintf('%04d', $empolyee->staff_code) }} &nbsp;&nbsp; {{ $empolyee->first_name }} {{ $empolyee->last_name }}  </option>
                    @endforeach
                </select>
              </div>
              <label for="staff_code" class="col-form-label col-md-2 col-sm-2 label-align">Staff Code</label>
                <div class="col-md-4 col-sm-3 ">
                   <input type="text" class="form-control" name="staff_code" placeholder="Staff Code" value="" id="staff_code"> 
              </div>
            </div>
            
           <div class="form-group row">
            <label for="joining_date" class="col-form-label col-md-2 col-sm-2 label-align ">Joining Date</label>
            <div class="col-md-4 col-sm-3 ">
               <input type="text" class="form-control" name="joining_date" placeholder="Joining Date" id="joining_date">
            </div>
   
            <label for="position" class="col-form-label col-md-2 col-sm-3 label-align">Designation</label>
              <div class="col-md-4 col-sm-3 ">
                  <input type="text" class="form-control" name="position" placeholder="Joining Date" id="position">
              </div>
         </div>
  
         <div class="form-group row">
            <label for="ending_date" class="col-form-label col-md-2 col-sm-2 label-align ">Ending Date</label>
            <div class="col-md-4 col-sm-3 ">
               <input type="text" class="form-control" name="ending_date" placeholder="Joining Date" id="ending_date">
            </div>
            <label for="base" class="col-form-label col-md-2 col-sm-3 label-align">Base</label>
              <div class="col-md-4 col-sm-3 ">
                  <input type="text" class="form-control" name="base" placeholder="Base" id="base">
            </div>
        </div>
  
       <div class="form-group row">
        <label for="loan_amount" class="col-form-label col-md-2 col-sm-3 label-align">Deposit Amount</label>
            <div class="col-md-4 col-sm-3 ">
                <input type="number" class="form-control" name="deposit_amount" placeholder="Deposit Amount" id="deposit_amount">
          </div>
         <label for="acount_head" class="col-form-label col-md-2 col-sm-3 label-align">Account Head</label>
              <div class="col-md-4 col-sm-3">
                <select name="account_head" id="account_head" class="form-control select2bs4">
                   <option value="">--select--</option>
                    @foreach ($accounts as $val)
                      <option value="{{ $val->id }}">{{ $val->account_head }}</option>
                    @endforeach
                </select>
              </div>
              </div>

      <div class="form-group row">
          <label for="loan_amount" class="col-form-label col-md-2 col-sm-3 label-align">Loan Amount</label>
              <div class="col-md-4 col-sm-3 ">
                  <input type="number" class="form-control" name="loan_amount" placeholder="Loan Amount" id="loan_amount">
            </div>
             <div class="col-md-4 col-sm-3 ">
                  <p style="color: green;" id="mxl"></p>
            </div>
    </div>
     <div class="form-group row">
        <label for="loan_amount_in_word" class="col-form-label col-md-2 col-sm-3 label-align">Loan Amount in word</label>
              <div class="col-md10 col-sm-10 ">
                  <input type="text" class="form-control" name="loan_amount_in_word" placeholder="Loan Amount" id="loan_amount_in_word">
            </div>
     </div>
     <div class="form-group row">
        <label for="loan_amount_in_word" class="col-form-label col-md-2 col-sm-3 label-align">Purpose</label>
          <div class="col-md10 col-sm-10 " id="">
         <label class="" style="padding-right: 15px;font-weight: 500!important;">
            Land&Building(RM&S) <input type = "checkbox" id = "check1" value = "1" name="type"> 
         </label>
         <label class="" style="padding-right: 15px; font-weight: 500!important;" name="type">
             Medical <input type = "checkbox" id = "check2" value = "2" >
         </label>
         <label class="" style="padding-right: 15px; font-weight: 500!important;" name="type">
             Marraige <input type = "checkbox" id = "check3" value = "3" >
         </label>
         <label class="" style="padding-right: 15px; font-weight: 500!important;">
             Others <input type = "checkbox" id = "check4" value = "4" name="type">
         </label>
          </div>
     </div>
  
       <div class="form-group row">
        <label for="bank_account" class="col-form-label col-md-2 col-sm-3 label-align">Bank Account Number</label>
          <div class="col-md10 col-sm-10 ">
             <input type="text" class="form-control" name="bank_account" placeholder="Bank Account Number" id="bank_account">
          </div>
     </div>
   <div class="form-group row">
    <label for="bank_name" class="col-form-label col-md-2 col-sm-3 label-align">Bank Name</label>
    <div class="col-md-4 col-sm-3 ">
       <input type="text" class="form-control" name="bank_name" placeholder="Bank Name" id="bank_name">
    </div>
    
    <label for="branch_name" class="col-form-label col-md-2 col-sm-3 label-align">Branch Name</label>
   <div class="col-md-4 col-sm-3 ">
      <input type="text" class="form-control" name="branch_name" placeholder="Branch Name" id="branch_name">
   </div>
  </div>
  <div class="form-group row">
    <label for="district" class="col-form-label col-md-2 col-sm-3 label-align">District</label>
    <div class="col-md-4 col-sm-3 ">
       <input type="text" class="form-control" name="district" placeholder="District" id="district">
    </div>
    
    <label for="date" class="col-form-label col-md-2 col-sm-3 label-align">Date</label>
   <div class="col-md-4 col-sm-3 ">
      <input type="text" class="form-control" name="date" placeholder="Branch Name" id="date">
   </div>
  </div>
  <div class="form-group row" style="border: 1px solid gray; box-shadow: 5px 8px gray; ">
    <div style="margin: 8px;" class="row">
    <div class="col-md-6 col-sm-6 ">
       <p>Monthly deduction(to be deducted from salary) of Taka : <strong></strong></p>
    </div>
    <div class="col-md-6 col-sm-6 ">
       <p>Interest rate 4% per annum : <strong></strong></p>
    </div>
      <div class="col-md-6 col-sm-6 ">
       <p>Monthly deduction(to be deducted from salary) of Taka in words : <strong></strong></p>
    </div>
    <div class="col-md-6 col-sm-6 ">
       <p>Installment Times : <strong>12</strong></p>
    </div>
    <div class="col-md-6 col-sm-6 ">
       <p>Contribution Balance with interest as on : <strong></strong></p>
    </div>
    <div class="col-md-6 col-sm-6 ">
       <p>PF Loan Balance(if any)as no : <strong><span id="preloan"></span></strong></p>
    </div>
    <div class="col-md-6 col-sm-6 ">
     <p > Maximum Loan allow : <span id="mxloan"><strong></strong></span></p>
    </div>
    </div>
 </div>
  
     <div class="form-group row">
       <div class="col-md-2"></div>
       <div class="col-md-3 col-sm-3">
           <button  type="submit" class="btn btn-success" id="submitInfo">Submit</button>
       <a type="submit" class="btn btn-info ml-3" href="{{route('create-loan')}}">Back</a>
       </div>
    </div>
  
       </form>
			            <!-- /.card -->
        </div>
      </div>
@endsection
@section('customjs')
<script>
$(document).ready(function() {
  var mxlaonAllow = 0;
  var description = "";
  $(function() { 
     $( "#joining_date" ).datepicker();
     $( "#ending_date" ).datepicker();
     $( "#date" ).datepicker();
  });
  
  $("#loan_amount").hover(function(){
    $("#mxl").text("Maximum allowable loan amount is "+ mxlaonAllow + "Tk.");
  });
  $("#staff").on("click", function() {
    // e.preventDefault();
    var staff_code = $("#staff").val();
    console.log(staff_code);
    var token = "{{ csrf_token() }}";
    var url_data = "{{ url('/loan-from-data') }}";
      $.ajax({
        method: "POST",
        url: url_data,
        data: {
            _token: token,
            staff_code: staff_code,
        },
        success: function(data) {
          var info = JSON.parse(data);
          
          // if(info != undefined){
          const { staff_code, first_name, last_name, joining_date, ending_date, position, base, total_pf } = info[0];

          var newStaffCode = newStaffCode = staff_code.toString();
          if(4 - newStaffCode.length == 1 ) 
            newStaffCode = '0' + newStaffCode;
          else if(4 - newStaffCode.length == 2) 
            newStaffCode = '00' + newStaffCode;
          else if(4 - newStaffCode.length == 2) 
            newStaffCode = '000' + newStaffCode;

          document.getElementById("staff_code").value = newStaffCode;
          document.getElementById("joining_date").value = joining_date;
          document.getElementById("ending_date").value = ending_date;
          document.getElementById("position").value = position;
          document.getElementById("base").value = base;
          document.getElementById("deposit_amount").value = total_pf;
          mxlaonAllow = (total_pf*0.8).toFixed(4);
          $('#mxloan').html(mxlaonAllow + "Tk.");
          description = staff_code+' '+ first_name +' '+last_name+' Loan Application';
        }
      });
  });
  $("#submitInfo").on("click", function(e) {
    e.preventDefault();
    var staff_code = $("#staff_code").val();
    var loan_amount = $("#loan_amount").val();
    var purpos = "";
    console.log(typeof(staff_code));
    // staff_code = parseInt(staff_code);
    var check;
    $(':checkbox:checked').each(function(i){
          check = $(this).val();
    });
    if(check == 1) {
      purpose = "Land&Building(RM&S)";
    }else if(check == 2){
      purpose = "Medical";
    }else if(check == 3) {
      purpose = "Marraige";
    }else {
      purpose = "Others";
    }
    console.log(purpose);
    var bank_account = $("#bank_account").val();
    var bank_name = $("#bank_name").val();
    var branch_name = $("#branch_name").val();
    var district = $("#district").val();
    // parseFloat(order_rate);
    var date = $("#date").val();
    var account_head = $("#account_head").val();
    // console.log(typeof(loan_amount));
    // console.log(typeof(mxlaonAllow));
    if(!loan_amount) {
      alert("Loan Amount field is reuired!");
      return;
    }
    if(!purpose) {
      alert("Purpose field is reuired!");
      return;
    }
    if(Number(mxlaonAllow) < Number(loan_amount)) {
      alert("Sorry! this amount is not acceptable. Maximun "+ mxlaonAllow +" Tk is acceptable.");
      return;
    }
    if(!bank_name) {
      alert("Bank Name field is reuired!");
      return;
    }
    if(!bank_account) {
      alert("Bank Account Number field is reuired!");
      return;
    }
    if(!branch_name) {
      alert("Branch Name field is reuired!");
      return;
    }
    if(!district) {
      alert("District Name field is reuired!");
      return;
    }
    if(!date) {
      alert("Date field is reuired!");
      return;
    }
    if(!account_head) {
      alert("Account Heaad field is reuired!");
      return;
    }
    var monthly_installment = (loan_amount/12).toFixed(4);
    var interest = (loan_amount*0.004).toFixed(4);
    var monthly_interest = (interest/12).toFixed(4);
    // var toyal_paymet = (monthly_installment+monthly_interest).toFixed(4);
    var token = "{{ csrf_token() }}";
    var url_data = "{{ url('/save-loan') }}";
      $.ajax({
        method: "POST",
        url: url_data,
        data: {
            _token: token,
            staff_code: parseInt(staff_code),
            loan_amount: loan_amount,
            purpose: purpose,
            bank_account: bank_account,
            bank_name: bank_name,
            branch_name: branch_name,
            district: district,
            date: date,
            account_head: account_head,
            mxlaonAllow: mxlaonAllow,
            monthly_interest: monthly_interest,
            monthly_installment: monthly_installment,
            interest: interest,
            description: description
        },
        success: function(data) {
          alert(data);
        }
      });
  });
});
</script>
@endsection
<?php
$con=mysqli_connect("localhost","root","","clinic_db");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
<link rel="icon" type="image/png" href="./assets/img/favicon.png">

<title>Appoinment Booking</title>

<!--     Fonts and icons     -->
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />

<!-- Nucleo Icons -->
<link href="./assets/css/nucleo-icons.css" rel="stylesheet" />
<link href="./assets/css/nucleo-svg.css" rel="stylesheet" />

<!-- Font Awesome Icons -->
<script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
<link href="./assets/css/nucleo-svg.css" rel="stylesheet" />

<!-- CSS Files -->
<link id="pagestyle" href="./assets/css/argon-dashboard.css?v=2.0.0" rel="stylesheet" />

<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>

<script>
$(document).ready(function(){ 
	
	document.getElementById('txtDate').valueAsDate = new Date();
	
	GetAppoinmentDates();
	GetSpecialisation($('#ddDoctor').val());
	
	$('#divAppoinment').show();
	$('#divRegistration').hide();
	
	$("#btnRegister").click(function() {
		
		var PatientName = $('#txtName').val();
		var Mobile = $('#txtMobileNo').val();
		var Address = $('#txtAddress').val();
		var Flag="RegisterPatient";
		$.ajax({
			type: 'post',
			url:  'ServerSide.php', // point to server-side PHP script
			data: 'PatientName=' + PatientName + '&Mobile=' + Mobile + '&Address=' + Address + '&Flag=' + Flag,
			async: false,
			success: function(data){//alert(data);                         
				swal({   
					title: "Successfully Registered!",   
					text: "The patient ID id "+data,   
					type: "success",   
					showCancelButton: false,   
					confirmButtonColor: "#DD6B55",   
					confirmButtonText: "OK!",   
					closeOnConfirm: false 
				}, function(){   
					window.location.href ="index.php";
				});
			}
		});
	});
	
	$("#btnSave").click(function() {
		
		var PatientId = $('#txtPatientId').val();
		var Doctor = $('#ddDoctor').val();
		var Date = $('#txtDate').val();
		var Time = $('#ddTime').val();
		var Details = $('#txtDetails').val();
		var Flag="BookAppoinment";
		$.ajax({
			type: 'post',
			url:  'ServerSide.php', // point to server-side PHP script
			data: 'PatientId=' + PatientId + '&Doctor=' + Doctor + '&Date=' + Date + '&Time=' + Time + '&Details=' + Details + '&Flag=' + Flag,
			async: false,
			success: function(data){//alert(data);  
				if(data==1)
				{
					SuccessFullySaved("Good Job!","Appoinment Booked");
					setTimeout(function() { window.location.href ="index.php";}, 1000);
				}
				else
				{
					ErrorWhileSave("Not Booked!","Something went wrong. Try again later!");
				}
			}
		});
	});
	
	$('.date-picker-2').popover({
	html : true, 
	content: function() {
	  return $("#example-popover-2-content").html();
	},
	title: function() {
	  return $("#example-popover-2-title").html();
	}
});
$(".date-picker-2").datepicker({
	onSelect: function(dateText) { 
	
		var Flag="GetAppoinmentTimes";
		var DoctorId=$('#ddDoctor').val();
		$.ajax({
			type: 'post',
			url:  'ServerSide.php', // point to server-side PHP script
			data: 'dateText=' + dateText + '&DoctorId=' + DoctorId + '&Flag=' + Flag,
			async: false,
			success: function(data){                        
				$('#example-popover-2-title').html('<b>Scheduled Appiontments</b>');
				$('#example-popover-2-content').html('Scheduled Appiontments On <strong>'+dateText+'</strong><br>'+data);
				$('#example-popover-2-content').html('Scheduled Appiontments On <strong>'+dateText+'</strong><br>'+html);
				$('.date-picker-2').popover('show');
			}
		});
    }
});
});
function GetSpecialisation(DoctorId)
{
	var Flag="GetSpecialisation";
	$.ajax({
		type: 'post',
		url:  'ServerSide.php', // point to server-side PHP script
		data: 'DoctorId=' + DoctorId + '&Flag=' + Flag,
		async: false,
		success: function(data){                        
			$('#txtSpecialisation').val(data);
		}
	});
	GetAppoinmentDates();
}
function CheckPatient(PatientId)
{
	var Flag="CheckPatient";
	$.ajax({
		type: 'post',
		url:  'ServerSide.php', // point to server-side PHP script
		data: 'PatientId=' + PatientId + '&Flag=' + Flag,
		async: false,
		success: function(data){                        
			if(data==0)
			{
				ErrorWhileSave("Warning!","Patient Id not exist");
				$('#txtPatientId').val('');
			}
		}
	});
}
function GetAppoinmentDates()
{
	var Date = $('#txtDate').val();
	var DoctorId = $('#ddDoctor').val();
	var Flag="GetAppoinmentDates";
	$.ajax({
		type: 'post',
		url:  'ServerSide.php', // point to server-side PHP script
		data: 'Date=' + Date + '&DoctorId=' + DoctorId + '&Flag=' + Flag,
		async: false,
		success: function(data){                        
			$('#ddTime').html(data);
		}
	});
}
function DivChange()
{
	$('#divAppoinment').hide();
	$('#divRegistration').show();
}
function SuccessFullySaved(header,Message) {
            if (Message == null)
                Message = "";
            swal(header, "" + Message + "", "success")
        };

function ErrorWhileSave(header,Message) { 
            if (Message == null)
                Message = "";
            swal(header, "" + Message + "", "error")
        };
</script>
<style>
	.pointer {cursor: pointer;}
	
	.popover {
	left: 40% !important;
}
.btn {
	margin: 1%;
}
label
{
	font-size: small;
}
</style>
</head>
<body class="g-sidenav-show  bg-gray-100">
<main class="main-content border-radius-lg ">
        <div class="container-fluid py-4">
            <div class="row mt-4">
			<div class="col-lg-12 mb-lg-0 mb-4">
				<div class="card ">
				<div class="card-header pb-0 p-3">
				<div class="d-flex justify-content-between">
				<h4 class="mb-2">Book Appoinment</h4>
				</div>
			</div>
<div class="row" id="divAppoinment">
<div class="col-md-2">
<label class="control-label">Patient Id</label>
<input type="text" id="txtPatientId" class="form-control" onchange="CheckPatient(this.value)">
<a style="color: red" class="pointer" onclick="DivChange();">New Patient?Register here!</a>
</div>
<div class="col-md-3">
<label class="control-label">Doctor</label>
<select id="ddDoctor" class="form-control" onchange="GetSpecialisation(this.value);">
<?php
$sql_doctor="SELECT DoctorId, DoctorName FROM doctor_tbl";
$exe_doctor=mysqli_query($con,$sql_doctor);
while($fetch_doctor=mysqli_fetch_array($exe_doctor))
{
?>
	<option value="<?php echo $fetch_doctor['DoctorId'] ?>"><?php echo $fetch_doctor['DoctorName'] ?></option>
<?php
}
?>
</select>
</div>
<div class="col-md-3">
<label class="control-label">Specialisation</label>
<input type="text" id="txtSpecialisation" class="form-control" readonly>
</div>
<div class="col-md-2">
<label class="control-label">Date</label>
<input type="date" id="txtDate" class="form-control" onchange="GetAppoinmentDates();">
</div>
<div class="col-md-2">
<label class="control-label">Time</label>
<select id="ddTime" class="form-control">
</select>
</div>
<div class="col-md-12">
<label class="control-label">Details</label>
<textarea id="txtDetails" class="form-control"></textarea>
</div>
<div class="col-md-12">
<button type="button" name="Save" id="btnSave" class="btn btn-dark btn-sm">Save</button>
</div>

<div class="col-md-6">
	<span style="color: green"><i>Choose the doctor and click on the date to view appointments booked with that doctor</i></span>
      <div  class="date-picker-2" placeholder="Recipient's username" id="ttry" aria-describedby="basic-addon2"></div>
      <span class="" id="example-popover-2"></span> </div>
    <div id="example-popover-2-content" class="hidden col-md-3"> </div>
    <div id="example-popover-2-title" class="hidden col-md-3"> </div>

</div>
<div id="divRegistration">
<div class="col-md-6">
<label class="control-label">Name</label>
<input type="text" id="txtName" class="form-control">
</div>
<div class="col-md-6">
<label class="control-label">Mobile No</label>
<input type="text" id="txtMobileNo" class="form-control">
</div>
<div class="col-md-12">
<label class="control-label">Address</label>
<textarea id="txtAddress" class="form-control"></textarea>
</div>
<div class="col-md-3">
<button type="button" name="Register" id="btnRegister" class="btn btn-dark btn-block btn-sm">Register</button>
</div>
</div>
</div>
			
			</div>
			
			</div>
			</div>

         
       </main>

<!--   Core JS Files   -->
<script src="./assets/js/core/popper.min.js" ></script>
<script src="./assets/js/core/bootstrap.min.js" ></script>
<!--<script src="./assets/js/plugins/perfect-scrollbar.min.js" ></script>
<script src="./assets/js/plugins/smooth-scrollbar.min.js" ></script>-->


<!-- Sweet-Alert  -->
<link href="./assets/sweetalert/sweetalert.css" rel="stylesheet" type="text/css" />
<script src="./assets/sweetalert/sweetalert.min.js"></script>
<script src="./assets/sweetalert/jquery.sweet-alert.custom.js"></script>







































































<script>
  var win = navigator.platform.indexOf('Win') > -1;
  if (win && document.querySelector('#sidenav-scrollbar')) {
    var options = {
      damping: '0.5'
    }
    Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
  }
</script>

<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>


<!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc --><script src="./assets/js/argon-dashboard.min.js?v=2.0.0"></script>
  </body>

</html>
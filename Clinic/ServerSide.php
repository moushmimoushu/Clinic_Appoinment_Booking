<?php
$con=mysqli_connect("localhost","root","","clinic_db");
$Flag=$_POST['Flag'];

if($Flag=='GetSpecialisation')
{
	$DoctorId=$_POST['DoctorId'];
	$sql="SELECT Specialize FROM doctor_specialize_tbl WHERE DoctorId='$DoctorId'";
	$exe=mysqli_query($con,$sql);
	$fetch=mysqli_fetch_array($exe);
	$Specialize=$fetch['Specialize'];
	print $Specialize;
}
if($Flag=='CheckPatient')
{
	$PatientId=$_POST['PatientId'];
	$sql="SELECT COUNT(PatientId) AS 'Count' FROM patient_tbl WHERE PatientId='$PatientId'";
	$exe=mysqli_query($con,$sql);
	$fetch=mysqli_fetch_array($exe);
	$Count=$fetch['Count'];
	if($Count==1)
	{
		print 1;
	}
	else
	{
		print 0;
	}
}
if($Flag=='GetAppoinmentDates')
{
	$Date=$_POST['Date'];
	$DoctorId=$_POST['DoctorId'];
	$sql_time="SELECT ConsultationId, Time FROM consultation_time_tbl WHERE ConsultationId NOT IN (SELECT Time FROM appoinment_tbl WHERE Date='$Date' AND DoctorId='$DoctorId')";
	$exe_time=mysqli_query($con,$sql_time);
	while($fetch_time=mysqli_fetch_array($exe_time))
	{
?>
	<option value="<?php echo $fetch_time['ConsultationId'] ?>"><?php echo $fetch_time['Time'] ?></option>
<?php
	}
}
if($Flag=='GetAppoinmentTimes')
{
	$dateText=$_POST['dateText'];
	$dateText=date("Y-m-d", strtotime($dateText) );
	$DoctorId=$_POST['DoctorId'];
	$sql="SELECT c.Time FROM appoinment_tbl a INNER JOIN consultation_time_tbl c ON a.Time=c.ConsultationId WHERE a.Date='$dateText' AND a.DoctorId='$DoctorId' ORDER BY Time ASC";
	$exe=mysqli_query($con,$sql);
	$count=mysqli_num_rows($exe);
	if($count>0)
	{
		while($fetch=mysqli_fetch_array($exe))
		{
?>
<button  class="btn btn-success"><?php echo $fetch['Time'] ?></button><br>
<?php
		}
	}
	else
	{
?>
<button  class="btn btn-success">No appoinments found!</button>
<?php	
	}
}
if($Flag=='RegisterPatient')
{
	$Name=$_POST['PatientName'];
	$MobileNo=$_POST['Mobile'];
	$Address=$_POST['Address'];
	$Address = mysqli_real_escape_string($con,$Address);
	
	$sql="INSERT INTO patient_tbl (Name, MobileNo, Address) VALUES ('$Name', '$MobileNo', '$Address')";
	$exe=mysqli_query($con,$sql);
	$last_id = mysqli_insert_id($con);
	print $last_id;
}
if($Flag=='BookAppoinment')
{
	$PatientId=$_POST['PatientId'];
	$DoctorId=$_POST['Doctor'];
	$Date=$_POST['Date'];
	$Time=$_POST['Time'];
	$Details=$_POST['Details'];
	$Details = mysqli_real_escape_string($con,$Details);
	
	$sql="INSERT INTO appoinment_tbl (PatientId, DoctorId, Date, Time, Details) VALUES ('$PatientId', '$DoctorId', '$Date', '$Time', '$Details')";
	$exe=mysqli_query($con,$sql);
	print 1;
}
?>
<?php
	ob_start();
	session_start();
	require_once 'dbconnect.php';
	
	// if session is not set this will redirect to login page
	if( !isset($_SESSION['admin']) ) {
		header("Location: index.php");
		exit;
	}
	// select loggedin users detail
	$conn = mysqli_connect('localhost','root','','cooperative');
	$res=mysqli_query($conn,"SELECT * FROM users WHERE userId=".$_SESSION['admin']);
	$userRow=mysqli_fetch_array($res);


	$ress=mysqli_query($conn,"SELECT * FROM personalinfo_tbl WHERE cust_id='$userRow[userName]'");
	$userRows=mysqli_fetch_array($ress);

	
	$cust_fname = $userRows['cust_fname'];
	$cust_oname = $userRows['cust_oname'];
	$cust_lname = $userRows['cust_lname'];
	$cust_staffstatus = $userRows['cust_staffstatus'];
	$cust_healthstatus = $userRows['cust_healthstatus'];
	$cust_staffid = $userRows['cust_staffid'];
	$cust_nok = $userRows['cust_nok'];

	@$passave=@mysqli_query($conn,"SELECT * FROM savingamount_tbl WHERE cust_id='$userRow[userName]' and savings_status='1' ORDER BY SN DESC");
	@$userPassave=@mysqli_fetch_array($passave);
	$cust_savings = $userPassave['cust_savings'];


	$cust_nokrelationship = $userRows['cust_nokrelationship'];
	$cust_noknum = $userRows['cust_noknum'];
	$cust_school = $userRows['cust_school'];
	$cust_department = $userRows['cust_department'];

	@$pass=@mysqli_query($conn,"SELECT * FROM passport_tbl WHERE AppNumber='$userRow[userName]'");
	@$userPass=@mysqli_fetch_array($pass);
?>

<?php 

		@$cust_id = trim($_GET['cust_id']);
		@$cust_id = strip_tags($cust_id);
		@$cust_id = htmlspecialchars($cust_id);


$custedit=mysqli_query($conn,"SELECT * FROM personalinfo_tbl WHERE cust_id='$cust_id'");
$loaneditget=mysqli_fetch_array($custedit);

$cust_id=$loaneditget['cust_id'];
$cust_fname=$loaneditget['cust_fname'];
$cust_oname=$loaneditget['cust_oname'];
$cust_lname=$loaneditget['cust_lname'];
$cust_maritalstatus=$loaneditget['cust_maritalstatus'];
$cust_gender=$loaneditget['cust_gender'];
$cust_email=$loaneditget['cust_email'];
$cust_phno=$loaneditget['cust_phno'];
$cust_date=$loaneditget['cust_date'];
	@$passave=@mysqli_query($conn,"SELECT * FROM savingamount_tbl WHERE cust_id='$cust_id' and savings_status='1' ORDER BY SN DESC");
	@$userPassave=@mysqli_fetch_array($passave);
	$cust_savings = $userPassave['cust_savings'];
$cust_staffstatus=$loaneditget['cust_staffstatus'];
$cust_healthstatus=$loaneditget['cust_healthstatus'];
$cust_nok=$loaneditget['cust_nok'];
$cust_noknum=$loaneditget['cust_noknum'];
$cust_nokrelationship=$loaneditget['cust_nokrelationship'];
$cust_staffid=$loaneditget['cust_staffid'];
$cust_school=$loaneditget['cust_school'];
$cust_department=$loaneditget['cust_department'];
$Passport=$loaneditget['Passport'];
$cust_status=$loaneditget['cust_status'];
if ($cust_status == 1) {$cust_statusv="APPROVED";} elseif ($cust_status == 0) {$cust_statusv="DELCINED";} else {$cust_statusv="PENDING";}

?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome - <?php echo $userRow['userName']; ?></title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script> 
  <script src="assets/js/lga.js"></script>
<link rel="stylesheet" href="assets/css/bootstrap.min.css">
<link rel="stylesheet" href="style.css" type="text/css" />
<!--<link rel="stylesheet" type="text/css" href="style.css" />-->
<style>
	.wrapper{
		padding-top: 50px;
	}
	#form-content{
		margin: 0 auto;
		width: 500px;
	}
</style>
</head>
<body>

	<nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Admin Dashboard</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">     <?php 	$report1=mysqli_query($conn,"SELECT * FROM loanrequest_tbl WHERE report='0'");

	$report2=mysqli_query($conn,"SELECT * FROM savingamount_tbl WHERE report='0'");


	$msg1=mysqli_query($conn,"SELECT * FROM loanrequest_tbl WHERE msg='0'");

	$msg2=mysqli_query($conn,"SELECT * FROM savingamount_tbl WHERE msg='0'");

if ((mysqli_num_rows($report1) > 0) or (mysqli_num_rows($report2) > 0)){$rep="rep1.jpg";} else {$rep="rep.jpg";}

if ((mysqli_num_rows($msg1) > 0) or (mysqli_num_rows($msg2) > 0)){$msg="msg1.jpg";} else {$msg="msg.jpg";}
?>     <ul class="nav navbar-nav">            <li><a href="admin_detail.php">Home</a></li>
            <li><a href="members_detail.php">Members</a></li>			<li><a href="membersloan_detail.php">Loan</a></li>
            <li><a href="memberssavings_detail.php">Savings</a></li>
<li><a href="savings_deposit.php">S.Deposit</a></li>
<li><a href="loan_deposit.php">L.Deposit</a></li>
            <li><a href="expenditure.php">Expenditure</a></li>
<li><a href="admin_report.php" title="See Messages"><img name="" src="<?php echo $msg; ?>" width="20" height="20" alt=""></a></li>
            <li><a href="#" title="Generate Report"><img name="" src="<?php echo $rep; ?>" width="20" height="20" alt=""></a></li>
          </ul>

          <ul class="nav navbar-nav navbar-right">
            
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">			  <span class="glyphicon glyphicon-user"></span>&nbsp;Admin ID:<strong><?php echo $userRow['userName']; ?> </strong>&nbsp;<span class="caret"></span></a>
              <ul class="dropdown-menu">                <li><a href="dividend.php"></span>&nbsp;Share Dividend</a></li>                <li><a href="dividend_edit.php"></span>&nbsp;Delete Dividend</a></li>
                <li><a href="print_mandate.php"></span>&nbsp;Print Mandate</a></li>
                <li><a href="savings_deduction.php"></span>&nbsp;Print Deduction</a></li>
                <li><a href="select_report.php"></span>&nbsp;Retrieve Mandate</a></li>
                <li><a href="select_reportb.php"></span>&nbsp;Retrieve Deduction</a></li>

<li><a href="logout.php?logout"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Sign Out</a></li>
</ul>
            </li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav> 

	<div id="wrapper">
<div style="background-image: url(../onlineapp/ccslogo/header.jpg); background-repeat: no-repeat center center; background-size: cover; height: 150px"></div>

	<div class="container">
	  <div class="col-lg-12">
	
		<div class="row">
		<br><h4 align="center">EDIT MEMBERS RECORD</h4><br><h5 align="center"><strong>Customer ID: </strong><?php echo $cust_id; ?></h5><br>
			<div id="form-content">
			
			<form method="post" id="reg-form" autocomplete="off">
		<input name="cust_id" type="hidden" value="<?php echo $cust_id; ?>">		
<div class="form-group"><label>Entrance Date</label>
					<input type="date" class="form-control" name="cust_date" id="lname" placeholder="<?php if (@$cust_date <> ""){echo @$cust_date;} else {echo "Select Date";}?>" value="<?php echo @$cust_date; ?>" required />
				</div>
				
<div class="form-group">
<label>First Name</label>
					<input type="text" onkeyup="this.value = this.value.toUpperCase();" pattern="[A-Za-z\\s]*" class="form-control" name="cust_fname" id="lname" placeholder="<?php if (@$cust_fname <> ""){echo @$cust_fname;} else {echo "Enter First Name";}?>" value="<?php echo @$cust_fname; ?>" required />
				</div>

				<div class="form-group">
                <label>Other Name</label>
					<input type="text" onkeyup="this.value = this.value.toUpperCase();" pattern="[A-Za-z\\s]*" class="form-control" name="cust_oname" id="lname" placeholder="<?php if (@$cust_oname <> ""){echo @$cust_oname;} else {echo "Enter Other Name";}?>" value="<?php echo @$cust_oname; ?>" required />
				</div>
				
				<div class="form-group">
                <label>Last Name</label>
					<input type="text" onkeyup="this.value = this.value.toUpperCase();" pattern="[A-Za-z\\s]*" class="form-control" name="cust_lname" id="lname" placeholder="<?php if (@$cust_lname <> ""){echo @$cust_lname;} else {echo "Enter Last Name";}?>" value="<?php echo @$cust_lname; ?>" required />
				</div>

<div class="form-group">
<label>Marital Status</label>
<select name="cust_maritalstatus" id="lname" class="form-control" required>
  <option value="<?php if (@$cust_maritalstatus <> ""){echo @$cust_maritalstatus;} else {echo "";}?>" selected><?php if (@$cust_maritalstatus <> ""){echo @$cust_maritalstatus;} else {echo "Select Marital Status";}?></option>
  <option value="Single">Single</option>
  <option value="Married">Married</option>
  <option value="Divorced">Divorced</option>
</select>				
</div>

<div class="form-group">
<label>Gender</label>
<select name="cust_gender" id="lname" class="form-control" required>
  <option value="<?php if (@$cust_gender <> ""){echo @$cust_gender;} else {echo "";}?>" selected><?php if (@$cust_gender <> ""){echo @$cust_gender;} else {echo "Select Sex";}?></option>
  <option value="Male">Male</option>
  <option value="Female">Female</option>
</select>				
</div>
				
				<div class="form-group">
                <label>Email</label>
					<input type="cust_email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" class="form-control" name="cust_email" id="lname"  placeholder="<?php if (@$cust_email <> ""){echo @$cust_email;} else {echo "Enter Your Email";}?>" value="<?php echo @$cust_email; ?>" required />
				</div>
				
				<div class="form-group"><label>Phone Number</label>
					<input type="tel" pattern="[0-9].{10}" class="form-control" name="cust_phno" id="lname"  placeholder="<?php if (@$cust_phno <> ""){echo @$cust_phno;} else {echo "Enter Contact Number";}?>" value="<?php echo @$cust_phno; ?>" required />
				</div>






<div class="form-group">					
							  <label>Staff Status (Teaching/Non-Teaching)</label>
<select name="cust_staffstatus" class="form-control" required>
  <option value="<?php if (@$cust_staffstatus <> ""){echo @$cust_staffstatus;} else {echo "";}?>" selected><?php if (@$cust_staffstatus <> ""){echo @$cust_staffstatus;} else {echo "Staff Status";}?></option>
  <option value="Teaching Staff">Teaching Staff</option>
  <option value="Non Teaching">Non Teaching</option>
</select>				
</div>

<div class="form-group">					
							  <label>Health Status</label>
<select name="cust_healthstatus" class="form-control" required>
  <option value="<?php if (@$cust_healthstatus <> ""){echo @$cust_healthstatus;} else {echo "";}?>" selected><?php if (@$cust_healthstatus <> ""){echo @$cust_healthstatus;} else {echo "Health Status";}?></option>
  <option value="Medical needs">Medical Needs</option>
  <option value="Non Medical Needs">Non Medical Needs</option>
</select>				
</div>
                
				<div class="form-group">							  <label>Staff Number</label>

					<input type="text" onkeyup="this.value = this.value.toUpperCase();" pattern="^[A-Za-z0-9 -]+$" class="form-control" name="cust_staffid" id="lname" placeholder="<?php if (@$cust_staffid <> ""){echo @$cust_staffid;} else {echo "Enter Staff Number";}?>" value="<?php echo @$cust_staffid; ?>" required />
				</div>


				<div class="form-group">		<input name="savings_id" type="hidden" value="<?php echo $playernumber; ?>">					  <label>Monthly Savings</label><input name="savings_date" type="hidden" value="<?php echo date('Y-m-d'); ?>">

					<input type="text" onkeyup="this.value = this.value.toUpperCase();" pattern="^[0-9 -]+$" class="form-control" name="cust_savings" id="lname" placeholder="<?php if (@$cust_savings <> ""){echo @$cust_savings;} else {echo "Monthly Savings";}?>" value="<?php echo @$cust_savings; ?>" required disabled />
				</div>


				<div class="form-group">							  <label>Customer School</label>

					<input type="text" onkeyup="this.value = this.value.toUpperCase();" pattern="^[A-Za-z0-9 -]+$" class="form-control" name="cust_school" id="lname" placeholder="<?php if (@$cust_school <> ""){echo @$cust_school;} else {echo "Enter Staff School";}?>" value="<?php echo @$cust_school; ?>" required />
				</div>

				<div class="form-group">							  <label>Customer Department</label>

					<input type="text" onkeyup="this.value = this.value.toUpperCase();" pattern="^[A-Za-z0-9 -]+$" class="form-control" name="cust_department" id="lname" placeholder="<?php if (@$cust_department <> ""){echo @$cust_department;} else {echo "Enter Staff Department";}?>" value="<?php echo @$cust_department; ?>" required />
				</div>


				<div class="form-group">
                <label>Next of Kin Record</label>
					<input type="text" onkeyup="this.value = this.value.toUpperCase();" pattern="^[A-Za-z -]+$" class="form-control" name="cust_nok" id="lname" placeholder="<?php if (@$cust_nok <> ""){echo @$cust_nok;} else {echo "Next of Kin Full Name";}?>" value="<?php echo @$cust_nok; ?>" required />
				</div>
				
				<div class="form-group">
					<input type="tel" pattern="[0-9].{10}" class="form-control" name="cust_noknum" id="lname" value="<?php echo @$cust_noknum; ?>" placeholder="<?php if (@$cust_noknum <> ""){echo @$cust_noknum;} else {echo "Next of Kin Contact No";}?>" required />
				</div>
				
				
				<div class="form-group">
<select name="cust_nokrelationship" class="form-control" required>
  <option value="<?php if (@$cust_nokrelationship <> ""){echo @$cust_nokrelationship;} else {echo "";}?>" selected><?php if (@$cust_nokrelationship <> ""){echo @$cust_nokrelationship;} else {echo "Next of Kin Relationship";}?></option>
  <option value="Father">Father</option>
  <option value="Mother">Mother</option>
  <option value="Spouse">Spouse</option>
  <option value="Brother">Brother</option>
  <option value="Sister">Sister</option>
  <option value="Son">Son</option>
  <option value="Daughter">Daughter</option>
  <option value="Cousin">Cousin</option>
  <option value="Aunt">Aunt</option>
  <option value="Uncle">Uncle</option>
  <option value="Nephew">Nephew</option>
  <option value="Niece">Niece</option>
</select>					
				</div>                

<div class="form-group" style="background-color:#999">					
							  <label>Customer Status</label>
<select name="cust_status" class="form-control" required>
  <option value="<?php if (@$cust_status <> ""){echo @$cust_status;} else {echo "";}?>" selected><?php if (@$cust_statusv <> ""){echo @$cust_statusv;} else {echo "Select Customer Status";}?></option>
  <option value="1">- APPROVED -</option>
  <option value="6">- PENDING -</option>
  <option value="0">- DECLINED -</option>
</select>				
</div>        

				<hr />
				
				<div class="form-group">
					<button class="btn btn-primary">Submit/Save Details</button>
				</div>
				
			</form>
            
            </div>
            
            </div>
		
	</div>
	
</div>
	
</div>
<script src="assets/jquery-1.12.4-jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>

<script type="text/javascript">
$(document).ready(function() {	
	
	// submit form using $.ajax() method
	
	$('#reg-form').submit(function(e){
		
		e.preventDefault(); // Prevent Default Submission
		
		$.ajax({
			url: 'submitedit.php',
			type: 'POST',
			data: $(this).serialize() // it will serialize the form data
		})
		.done(function(data){
			$('#form-content').fadeOut('slow', function(){
				$('#form-content').fadeIn('slow').html(data);
			});
		})
		.fail(function(){
			alert('Ajax Submit Failed ...');	
		});
	});
	
	
	/*
	// submit form using ajax short hand $.post() method
	
	$('#reg-form').submit(function(e){
		
		e.preventDefault(); // Prevent Default Submission
		
		$.post('submit.php', $(this).serialize() )
		.done(function(data){
			$('#form-content').fadeOut('slow', function(){
				$('#form-content').fadeIn('slow').html(data);
			});
		})
		.fail(function(){
			alert('Ajax Submit Failed ...');
		});
		
	});
	*/
	
});
</script>
</body>
</html>
<?php ob_end_flush(); ?>
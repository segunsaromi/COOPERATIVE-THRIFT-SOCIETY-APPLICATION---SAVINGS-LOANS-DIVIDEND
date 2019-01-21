<?php

	ob_start();
	session_start();
	require_once 'dbconnect.php';
	
	// if session is not set this will redirect to login page
	if( !isset($_SESSION['user']) ) {
		header("Location: index.php");
		exit;
	}
	// select loggedin users detail
	$conn = mysqli_connect('localhost','root','','cooperative');
	$res=mysqli_query($conn,"SELECT * FROM users WHERE userId=".$_SESSION['user']);
	$userRow=mysqli_fetch_array($res);

if( $_POST ){

		$cust_savings = trim($_POST['cust_savings']);
		$cust_savings = strip_tags($cust_savings);
		$cust_savings = htmlspecialchars($cust_savings);

		$cust_staffstatus = trim($_POST['cust_staffstatus']);
		$cust_staffstatus = strip_tags($cust_staffstatus);
		$cust_staffstatus = htmlspecialchars($cust_staffstatus);

		$cust_healthstatus = trim($_POST['cust_healthstatus']);
		$cust_healthstatus = strip_tags($cust_healthstatus);
		$cust_healthstatus = htmlspecialchars($cust_healthstatus);

		$cust_department = trim($_POST['cust_department']);
		$cust_department = strip_tags($cust_department);
		$cust_department = htmlspecialchars($cust_department);

		$cust_school = trim($_POST['cust_school']);
		$cust_school = strip_tags($cust_school);
		$cust_school = htmlspecialchars($cust_school);

		$cust_staffid = trim($_POST['cust_staffid']);
		$cust_staffid = strip_tags($cust_staffid);
		$cust_staffid = htmlspecialchars($cust_staffid);
		$cust_staffid = "AD/R/S.".$cust_staffid;

		$cust_nokrelationship = trim($_POST['cust_nokrelationship']);
		$cust_nokrelationship = strip_tags($cust_nokrelationship);
		$cust_nokrelationship = htmlspecialchars($cust_nokrelationship);

		$cust_nok = trim($_POST['cust_nok']);
		$cust_nok = strip_tags($cust_nok);
		$cust_nok = htmlspecialchars($cust_nok);

		$cust_noknum = trim($_POST['cust_noknum']);
		$cust_noknum = strip_tags($cust_noknum);
		$cust_noknum = htmlspecialchars($cust_noknum);


			$query = "UPDATE personalinfo_tbl SET cust_staffstatus='$cust_staffstatus', cust_healthstatus='$cust_healthstatus', cust_school='$cust_school', cust_department='$cust_department', cust_nok='$cust_nok', cust_noknum='$cust_noknum', cust_nokrelationship='$cust_nokrelationship', cust_staffid='$cust_staffid' WHERE cust_id='$userRow[userName]'";
			$res = mysqli_query($conn,$query);

$querycheck="SELECT * FROM savingamount_tbl WHERE cust_id='$userRow[userName]'";
$check = mysqli_query($conn, $querycheck);
if (mysqli_num_rows($check) > 0) {
			$querysave = "UPDATE savingamount_tbl SET savings_id='$_POST[savings_id]', cust_savings='$cust_savings', savings_date='$_POST[savings_date]', savings_status='0'  WHERE cust_id='$userRow[userName]'";
			$ressave = mysqli_query($conn,$querysave); }
			
			else {$querysave = "INSERT INTO savingamount_tbl (cust_id, savings_id, cust_savings, savings_date, savings_status) VALUES ('$userRow[userName]', '$_POST[savings_id]', '$cust_savings', '$_POST[savings_date]', '0')";
			$ressave = mysqli_query($conn,$querysave); }

	?>
    
	<form method="post" id="reg-form" autocomplete="off">
    <table width="100%" border="0" class="table table-striped">
    
    <tr>
    <td colspan="2">
    	<div class="alert alert-info">
    		<strong>Success</strong>, Verify Details Entered...
    	</div>
    </td>
    </tr>
    
    <tr>
    <td width="39%">MOnthly Savings.</td>
    <td width="61%"><strong><?php echo $cust_savings; ?></strong></td>
    </tr>

    <tr>
    <td width="39%">Staff Status.</td>
    <td width="61%"><strong><?php echo $cust_staffstatus; ?></strong></td>
    </tr>

    <tr>
    <td>Health Status</td>
    <td><strong><?php echo $cust_healthstatus; ?></strong></td>
    </tr>

    <tr>
    <td>School</td>
    <td><strong><?php echo $cust_school; ?></strong></td>
    </tr>

    <tr>
    <td>Department</td>
    <td><strong><?php echo $cust_department; ?> </strong></td>
    </tr>

    <tr>
    <td>Next of Kin</td>
    <td><strong><?php echo $cust_nok; ?> </strong></td>
    </tr>

    <tr>
    <td>Next of Kin Phone</td>
    <td><strong><?php echo $cust_noknum; ?></strong></td>
    </tr>
    
    <tr>
    <td>Next of Kin Relationship</td>
    <td><strong><?php echo $cust_nokrelationship; ?></strong></td>
    </tr>

    
    </table>
				<div class="form-group">
				 <a href="index.php"> <button class="btn btn-primary" name="submit"> - RECORD VERIFIED - </button></a>
				</div>
				
			</form>
<script src="assets/jquery-1.12.4-jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>

    <?php
	
}
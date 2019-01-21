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

if ($_POST['savings_edit']){
		$savings_id = trim($_POST['savings_id']);
		$savings_id = strip_tags($savings_id);
		$savings_id = htmlspecialchars($savings_id);

		$cust_savings = trim($_POST['cust_savings']);
		$cust_savings = strip_tags($cust_savings);
		$cust_savings = htmlspecialchars($cust_savings);

		$savings_date = trim($_POST['savings_date']);
		$savings_date = strip_tags($savings_date);
		$savings_date = htmlspecialchars($savings_date);

$savings_report=0;
	$conn = mysqli_connect('localhost','root','','cooperative');








			$queryedit = "UPDATE savingamount_tbl SET cust_savings='$cust_savings', savings_date='$savings_date', report='$savings_report' WHERE savings_id='$savings_id'";
			$resedit = mysqli_query($conn,$queryedit);

}

	$ress=mysqli_query($conn,"SELECT * FROM personalinfo_tbl WHERE cust_id='$userRow[userName]'");
	$userRows=mysqli_fetch_array($ress);



$saveedit=mysqli_query($conn,"SELECT * FROM savingamount_tbl WHERE savings_id='$savings_id'");
$saveeditget=mysqli_fetch_array($saveedit);

$savings_status=$saveeditget['savings_status'];
if ($savings_status == 1) {$savings_statusv="APPROVED";} elseif ($savings_status == 0) {$savings_statusv="INACTIVE";} else {$savings_statusv="PENDING";}

	?>
    
	<form method="post" id="reg-form" autocomplete="off">
    <table width="100%" border="0" class="table table-striped">
    
    <tr>
    <td colspan="2">
    	<div class="alert alert-info">
    		<strong>Success</strong>, Verify Details Entered... <?php echo $savings_id; ?>
    	</div>
    </td>
    </tr>
    
    <tr>
    <td width="39%">Savings Amount.</td>
    <td width="61%"><strong><?php echo $cust_savings; ?></strong></td>
    </tr>

    <tr>
    <td width="39%">Savings Date.</td>
    <td width="61%"><strong><?php echo $savings_date; ?></strong></td>
    </tr>

    <tr>
    <td width="39%">Savings Status.</td>
    <td width="61%"><strong><?php echo $savings_statusv; ?></strong></td>
    </tr>
 
    </table>


    
				<div class="form-group">
				 <a href="index.php"> <button class="btn btn-primary" name="submit"> - SAVINGS VERIFIED - </button></a>
				</div>
				
			</form>
<script src="assets/jquery-1.12.4-jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>

    <?php
	
}
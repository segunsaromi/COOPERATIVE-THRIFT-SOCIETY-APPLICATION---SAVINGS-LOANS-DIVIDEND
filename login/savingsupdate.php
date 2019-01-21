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

		$cust_id = trim($_POST['cust_id']);
		$cust_id = strip_tags($cust_id);
		$cust_id = htmlspecialchars($cust_id);

		$savings_status = trim($_POST['savings_status']);
		$savings_status = strip_tags($savings_status);
		$savings_status = htmlspecialchars($savings_status);

	$savings_report=0;
	$conn = mysqli_connect('localhost','root','','cooperative');



$member=mysqli_query($conn,"SELECT * FROM personalinfo_tbl WHERE cust_id='$cust_id'");
$memberRow=mysqli_fetch_array($member);

$error1 = '';
$error = '';
$error2 = '';

if ($memberRow['cust_status'] != 1){$error1 ="This member has not been activated. A member can only be activated for savings only if their membership status has been activated.";

$queryedit = mysqli_query($conn,"UPDATE savingamount_tbl SET cust_savings='$cust_savings', savings_date='$savings_date', savings_report='$savings_report' WHERE savings_id='$savings_id'");


} 
	$conn = mysqli_connect('localhost','root','','cooperative');
	
	$view=mysqli_query($conn,"SELECT * FROM savingamount_tbl WHERE cust_id='$cust_id' and savings_status='1'");
	$view2=mysqli_query($conn,"SELECT * FROM savingamount_tbl WHERE savings_id='$savings_id'");
	$viewRow=mysqli_fetch_array($view2);

if ($error1 == '') { 

if (($viewRow['savings_status'] == 1) && ($savings_status == 1))
{
$error2 ="This member Savings Deduction is already activated. Thank you!!"; 

$query = mysqli_query($conn,"UPDATE savingamount_tbl SET cust_savings='$cust_savings', savings_date='$savings_date', report='$savings_report' WHERE savings_id='$savings_id' ") or die(mysqli_error($conn)); $savings_status = 1;
}


elseif ((mysqli_num_rows($view) > 0) && ($savings_status == 1))
{
$error ="This member already have an existing Savings Deduction. A member can not have multiple savings. You have to deactivate the existing savings to activate new savings"; $savings_status = 0;

$query = mysqli_query($conn,"UPDATE savingamount_tbl SET cust_savings='$cust_savings', savings_date='$savings_date', report='$savings_report' WHERE savings_id='$savings_id' ") or die(mysqli_error($conn)); $savings_status = 0;
} 

else
{
$query = mysqli_query($conn,"UPDATE savingamount_tbl SET cust_savings='$cust_savings', savings_date='$savings_date', savings_status='$savings_status', report='$savings_report' WHERE savings_id='$savings_id' ") or die(mysqli_error($conn));
}


}


}

	$ress=mysqli_query($conn,"SELECT * FROM personalinfo_tbl WHERE cust_id='$userRow[userName]'");
	$userRows=mysqli_fetch_array($ress);


	?>
    
	<form method="post" id="reg-form" autocomplete="off">
    <table width="100%" border="0" class="table table-striped">
    
    <tr>
    <td colspan="2">
    	<div class="alert alert-info"><strong><?php echo @$error2; ?></strong><br/><strong><?php echo @$error1; ?></strong><br/><strong><?php echo @$error; ?></strong><br/>
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
    <td width="61%"><strong><?php if (($savings_status=='0') or ($savings_status=='')){echo "<span style='color:#F00'><strong>INACTIVE</strong></span>";} elseif ($savings_status=='1'){echo "<span style='color:#004400'><strong>ACTIVE</strong></span>";} else {echo"<span style='color:#000000'><strong>PENDING</strong></span>";} ?></strong></td>
    </tr>
 
    </table>


    
				<div class="form-group">
				  <a href="savings_edit.php"><button class="btn btn-primary" name="submit"> - RECORD VERIFIED - </button></a>
				</div>
				
			</form>
<script src="assets/jquery-1.12.4-jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>


    <?php
	
}
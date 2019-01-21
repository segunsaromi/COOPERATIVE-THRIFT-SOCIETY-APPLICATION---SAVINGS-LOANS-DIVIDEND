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

if ($_POST['bank_edit']){
		$cust_id = trim($_POST['cust_id']);
		$cust_id = strip_tags($cust_id);
		$cust_id = htmlspecialchars($cust_id);

		$bank_name = trim($_POST['bank_name']);
		$bank_name = strip_tags($bank_name);
		$bank_name = htmlspecialchars($bank_name);

		$acc_no = trim($_POST['acc_no']);
		$acc_no = strip_tags($acc_no);
		$acc_no = htmlspecialchars($acc_no);


	$conn = mysqli_connect('localhost','root','','cooperative');



$bank=mysqli_query($conn,"SELECT * FROM bank_tbl WHERE cust_id='$cust_id'") or die(mysqli_error($conn)); 
$bankrow=mysqli_fetch_array($bank);
if (mysqli_num_rows($bank) > 0)
{
	$bankinsert=mysqli_query($conn,"UPDATE bank_tbl SET bank_name='$bank_name', acc_no='$acc_no' WHERE cust_id='$cust_id'") or die(mysqli_error($conn));
	}
else 
{
	$bankinsert=mysqli_query($conn,"INSERT INTO bank_tbl (bank_name,acc_no,cust_id) VALUES ('$bank_name','$acc_no','$cust_id')") or die(mysqli_error($conn));
	
	}



}

	$ress=mysqli_query($conn,"SELECT * FROM personalinfo_tbl WHERE cust_id='$userRow[userName]'");
	$userRows=mysqli_fetch_array($ress);


	?>
    
	<form method="post" id="reg-form" autocomplete="off">
    <table width="100%" border="0" class="table table-striped">
    
    <tr>
    <td colspan="2">
    	<div class="alert alert-info">
    		<strong>Success</strong>, Verify Bank Details Entered...
    	</div>
    </td>
    </tr>
    
    <tr>
    <td width="39%">Bank Name.</td>
    <td width="61%"><strong><?php echo $bank_name; ?></strong></td>
    </tr>

    <tr>
    <td width="39%">Account Number.</td>
    <td width="61%"><strong><?php echo $acc_no; ?></strong></td>
    </tr>

 
    </table>


    
				<div class="form-group">
				  <a href="bank_edit.php"><button class="btn btn-primary" name="submit"> - RECORD VERIFIED - </button></a>
				</div>
				
			</form>
<script src="assets/jquery-1.12.4-jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>

    <?php
	
}
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

if ($_POST['income']){
		$inc_des = trim($_POST['inc_des']);
		$inc_des = strip_tags($inc_des);
		$inc_des = htmlspecialchars($inc_des);

		$inc_date = trim($_POST['inc_date']);
		$inc_date = strip_tags($inc_date);
		$inc_date = htmlspecialchars($inc_date);

		$inc_id = trim($_POST['inc_id']);
		$inc_id = strip_tags($inc_id);
		$inc_id = htmlspecialchars($inc_id);

		$amount = trim($_POST['amount']);
		$amount = strip_tags($amount);
		$amount = htmlspecialchars($amount);

	$conn = mysqli_connect('localhost','root','','cooperative');

	$bankinsert=mysqli_query($conn,"INSERT INTO income_tbl (inc_des,inc_id,amount,inc_date) VALUES ('$inc_des','$inc_id','$amount','$inc_date')") or die(mysqli_error($conn));
	



}

	$ress=mysqli_query($conn,"SELECT * FROM personalinfo_tbl WHERE cust_id='$userRow[userName]'");
	$userRows=mysqli_fetch_array($ress);


	?>
    
	<form method="post" id="reg-form" autocomplete="off">
    <table width="100%" border="0" class="table table-striped">
    
    <tr>
    <td colspan="2">
    	<div class="alert alert-info">
    		<strong>Success</strong>, Verify Income Details Entered...
    	</div>
    </td>
    </tr>
    
    <tr>
    <td width="39%">Date.</td>
    <td width="61%"><strong><?php echo $inc_date; ?></strong></td>
    </tr>

    <tr>
    <td width="39%">Description.</td>
    <td width="61%"><strong><?php echo $inc_des; ?></strong></td>
    </tr>

    <tr>
    <td width="39%">Amount.</td>
    <td width="61%"><strong><?php echo $amount; ?></strong></td>
    </tr>

 
    </table>

<input name="inc_id" type="hidden" value="<?php echo $inc_id; ?>" />
    
				<div class="form-group">
				  <a href="income_edit.php"><button class="btn btn-primary" name="submit"> - FINISH - </button> </a>
				
			</form>
<script src="assets/jquery-1.12.4-jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
    <?php
	
}
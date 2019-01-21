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

if (@$_POST['deduction']){
		$deduction_month = trim($_POST['deduction_month']);
		$deduction_month = strip_tags($deduction_month);
		$deduction_month = htmlspecialchars($deduction_month);


	$conn = mysqli_connect('localhost','root','','cooperative');

	$bankinsert=mysqli_query($conn,"UPDATE savingamount_tbl SET deduction_month='$deduction_month' WHERE savings_status='1' and msg='0'") or die(mysqli_error($conn));
	
	header('Location: print_deduction.php');
}

else
{

echo "<a href='print_dedution.php'>CLICK TO PRINT</a>";

}

	?>
    
	<form method="post" id="reg-form" autocomplete="off">
    <table width="100%" border="0" class="table table-striped">
    
    <tr>
    <td colspan="2">
    	<div class="alert alert-info">
    		<strong>Success</strong>, Deduction Month Details Entered...
    	</div>
    </td>
    </tr>
    

    </table>

    
				<div class="form-group">
				  <a href="print_deduction.php"><button class="btn btn-primary" name="submit"> - PRINT SAVINGS DEDUCTION - </button></a>
				</div>
				
			</form>
<script src="assets/jquery-1.12.4-jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>

    <?php
	
}
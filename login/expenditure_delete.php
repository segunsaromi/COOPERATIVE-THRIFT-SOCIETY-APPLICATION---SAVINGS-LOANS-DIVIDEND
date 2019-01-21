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

if (@$_POST['delete']){
		$exp_id = trim($_POST['exp_id']);
		$exp_id = strip_tags($exp_id);
		$exp_id = htmlspecialchars($exp_id);

	$conn = mysqli_connect('localhost','root','','cooperative');

	$bankinsert=mysqli_query($conn,"DELETE FROM expenditure_tbl WHERE exp_id='$exp_id'") or die(mysqli_error($conn));
}

else
{

echo "<a href='expenditure_edit.php'>CLICK TO RETURN</a>";

}

	?>
    
	<form method="post" id="reg-form" autocomplete="off">
    <table width="100%" border="0" class="table table-striped">
    
    <tr>
    <td colspan="2">
    	<div class="alert alert-info">
    		<strong>Success</strong>, Expenditure Details Deleted...
    	</div>
    </td>
    </tr>
    

    </table>

    
				<div class="form-group">
				  <a href="expenditure_edit.php"><button class="btn btn-primary" name="submit"> - ENTER EXPENDITURE - </button></a>
				</div>
				
			</form>
<script src="assets/jquery-1.12.4-jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>

    <?php
	
}
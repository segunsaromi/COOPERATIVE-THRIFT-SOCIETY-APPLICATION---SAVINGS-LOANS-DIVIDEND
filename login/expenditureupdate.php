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

if ($_POST['expenditure']){
		$exp_des = trim($_POST['exp_des']);
		$exp_des = strip_tags($exp_des);
		$exp_des = htmlspecialchars($exp_des);

		$exp_date = trim($_POST['exp_date']);
		$exp_date = strip_tags($exp_date);
		$exp_date = htmlspecialchars($exp_date);

		$exp_id = trim($_POST['exp_id']);
		$exp_id = strip_tags($exp_id);
		$exp_id = htmlspecialchars($exp_id);

		$amount = trim($_POST['amount']);
		$amount = strip_tags($amount);
		$amount = htmlspecialchars($amount);

	$conn = mysqli_connect('localhost','root','','cooperative');

	$bankinsert=mysqli_query($conn,"INSERT INTO expenditure_tbl (exp_des,exp_id,amount,exp_date) VALUES ('$exp_des','$exp_id','$amount','$exp_date')") or die(mysqli_error($conn));
	



}

	$ress=mysqli_query($conn,"SELECT * FROM personalinfo_tbl WHERE cust_id='$userRow[userName]'");
	$userRows=mysqli_fetch_array($ress);


	?>
    
	<form method="post" id="reg-form" autocomplete="off">
    <table width="100%" border="0" class="table table-striped">
    
    <tr>
    <td colspan="2">
    	<div class="alert alert-info">
    		<strong>Success</strong>, Verify Expenditure Details Entered...
    	</div>
    </td>
    </tr>
    
    <tr>
    <td width="39%">Date.</td>
    <td width="61%"><strong><?php echo $exp_date; ?></strong></td>
    </tr>

    <tr>
    <td width="39%">Description.</td>
    <td width="61%"><strong><?php echo $exp_des; ?></strong></td>
    </tr>

    <tr>
    <td width="39%">Amount.</td>
    <td width="61%"><strong><?php echo $amount; ?></strong></td>
    </tr>

 
    </table>

<input name="exp_id" type="hidden" value="<?php echo $exp_id; ?>" />
    
				<div class="form-group">
				  <button class="btn btn-primary" name="submit"> - APPROVE - </button>  <button class="btn btn-primary" name="delete"> - DISCARD - </button>
				</div>
				
			</form>
<script src="assets/jquery-1.12.4-jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {	
	
	// submit form using $.ajax() method
	
	$('#reg-form').submit(function(e){
		
		e.preventDefault(); // Prevent Default Submission
		
		$.ajax({
			url: 'expenditure_delete.php',
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
    <?php
	
}
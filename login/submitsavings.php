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

		$date_deposit = trim($_POST['date_deposit']);
		$date_deposit = strip_tags($date_deposit);
		$date_deposit = htmlspecialchars($date_deposit);

	$save=mysqli_query($conn,"SELECT * FROM savingamount_tbl WHERE savings_status='1'");
	while ($saverow=mysqli_fetch_array($save))
	 {
	$deposit=mysqli_query($conn,"INSERT INTO savings_tbl (cust_id,savings_id,cust_savings,savings_date,savings_status) VALUES ('$saverow[cust_id]','$saverow[savings_id]','$saverow[cust_savings]','$date_deposit','$saverow[savings_status]')");

	}
	

	?>
<?php 
$_SESSION['success']="Savings deposit has been effcted for ".$date_deposit;
header("location:savings_deposit.php");

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
				  <button class="btn btn-primary" name="submit"> - RECORD VERIFIED - </button>
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
			url: 'verify.php',
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
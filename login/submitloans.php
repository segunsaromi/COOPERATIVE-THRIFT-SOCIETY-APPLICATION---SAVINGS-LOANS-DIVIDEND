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


$conn = mysqli_connect('localhost','root','','cooperative');
$detaila = mysqli_query($conn,"SELECT * FROM loanrequest_tbl WHERE loan_status='1' and loan_complete='0'");
while ($detailfetcha=mysqli_fetch_array($detaila)){?>  
<?php

$cust_id=$detailfetcha['cust_id'];
$loan_id=$detailfetcha['loan_id'];
$loan_amount=$detailfetcha['loan_amount'];
$loan_duration=$detailfetcha['loan_duration'];
$loan_status=$detailfetcha['loan_status'];
$loan_date=$detailfetcha['loan_date'];

$loanpay=mysqli_query($conn,"SELECT * FROM loan_tbl WHERE loan_id='$loan_id' ORDER BY loan_count ASC LIMIT 1 ");
if (mysqli_num_rows($loanpay) == 0)
	{@$loan_count=$loan_duration; 
	@$loan_countnext=$loan_count - 1;} 
else { 
	$nextcount=mysqli_fetch_array($loanpay); 
	@$loan_count=$nextcount['loan_countnext']; 
	@$loan_countnext=$loan_count - 1; }

$custsave=mysqli_query($conn,"SELECT * FROM personalinfo_tbl WHERE cust_id='$cust_id'");
$custsavev=mysqli_fetch_array($custsave);
$cust_fname=$custsavev['cust_fname'];
$cust_oname=$custsavev['cust_oname'];
$cust_lname=$custsavev['cust_lname'];

$monthly=mysqli_query($conn,"SELECT * FROM loanpayment_tbl WHERE loan_id='$loan_id'");
$monthlyrow=mysqli_fetch_array($monthly);
$monthlypay=$monthlyrow['principal'] + $monthlyrow['interest'];


$payment_status=1;


?>
<?php 
	$deposit=mysqli_query($conn,"INSERT INTO loan_tbl (cust_id,loan_id,loan_payment,payment_date,payment_status,loan_count,loan_countnext) VALUES ('$cust_id','$loan_id','$monthlypay','$date_deposit','$payment_status','$loan_count','$loan_countnext')") or die(mysqli_error($conn));

if ($deposit) 
{
	$deposit2=mysqli_query($conn,"UPDATE loanpayment_tbl SET status='1' WHERE period='$loan_count' and loan_id='$loan_id'") or die(mysqli_error($conn));
	
	if ($loan_countnext==0){mysqli_query($conn,"UPDATE loanrequest_tbl SET loan_complete='1' WHERE loan_id='$loan_id'") or die(mysqli_error($conn));
	}
}
	?>
    <?php
	$_SESSION['success']="Loan deposit has been effcted for ".$date_deposit;
header("location:loan_deposit.php");
	
	?>
    <?php } ?>
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
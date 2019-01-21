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

if ($_POST['loan_agree']){
		$loan_id = trim($_POST['loan_id']);
		$loan_id = strip_tags($loan_id);
		$loan_id = htmlspecialchars($loan_id);

		$loan_amount = trim($_POST['loan_amount']);
		$loan_amount = strip_tags($loan_amount);
		$loan_amount = htmlspecialchars($loan_amount);

		$loan_duration = trim($_POST['loan_duration']);
		$loan_duration = strip_tags($loan_duration);
		$loan_duration = htmlspecialchars($loan_duration);

		$loan_guarantor1 = trim($_POST['loan_guarantor1']);
		$loan_guarantor1 = strip_tags($loan_guarantor1);
		$loan_guarantor1 = htmlspecialchars($loan_guarantor1);

		$loan_guarantor2 = trim($_POST['loan_guarantor2']);
		$loan_guarantor2 = strip_tags($loan_guarantor2);
		$loan_guarantor2 = htmlspecialchars($loan_guarantor2);

		$loan_guarantor3 = trim($_POST['loan_guarantor3']);
		$loan_guarantor3 = strip_tags($loan_guarantor3);
		$loan_guarantor3 = htmlspecialchars($loan_guarantor3);


	$conn = mysqli_connect('localhost','root','','cooperative');

	$check=mysqli_query($conn,"SELECT COUNT(cust_id) FROM loanrequest_tbl WHERE cust_id='$userRow[userName]' and loan_status='0'"); if (mysqli_fetch_array($check) > 2){$danger = '1';} else {
	
			$query = "INSERT INTO loanrequest_tbl (cust_id,loan_id,loan_amount,loan_duration,loan_guarantor1,loan_guarantor2,loan_guarantor3,loan_date) VALUES ('$userRow[userName]','$loan_id','$loan_amount','$loan_duration','$loan_guarantor1','$loan_guarantor2','$_POST[loan_date]')";
			$res = mysqli_query($conn,$query);}

}

	$ress=mysqli_query($conn,"SELECT * FROM savingamount_tbl WHERE cust_id='$userRow[userName]' and savings_status='1' ORDER BY SN DESC");
	$userRows=mysqli_fetch_array($ress);

	?>
    
	<form method="post" id="reg-form" autocomplete="off">
    <table width="100%" border="0" class="table table-striped">
    
    <tr>
    <td colspan="2">
    	<div class="alert alert-info"><strong><?php if ($danger == '1'){echo "ALERT: You can not have more than 2 INACTIVE LOAN";}?></strong>
    		<strong>Success</strong>, Verify Details Entered... <?php echo $loan_id; ?>
    	</div>
    </td>
    </tr>
    
    <tr>
    <td width="39%">Loan Amount / Duration (Months).</td>
    <td width="61%"><strong><?php echo $loan_amount; ?> / <?php echo $loan_duration; ?> Months</strong></td>
    </tr>
 
    </table>


    <table width="100%" border="0" class="table table-striped">
    
    <tr>
    <td colspan="5">
    	<div class="alert alert-info">
    		<strong>REPAYMENT PLAN</strong>, Verify Details...
    	</div>
    </td>
    </tr>
    
    <tr>
    	<div class="alert alert-info">
    <td width="12%"><strong>Month</strong></td>
    <td width="22%"><strong>Principal</strong></td>
    <td width="22%"><strong>Interest</strong></td>
    <td width="22%"><strong>Savings</strong></td>
    <td width="22%"><strong>Monthly Deductions</strong></td></div>
    </tr>

<?php $principal=$loan_amount / $loan_duration; $interest=($loan_amount * 0.42) / $loan_duration; $total = $principal + $interest +  $userRows['cust_savings']; 
			while ($loan_duration <> '0'){?>

<?php $loan_duration=$loan_duration - 1; @$period = @$period + 1; @$totalprincipal = @$totalprincipal + $principal; @$totalinterst = @$totalinterst + $interest; ?>

<?php $querypay = "INSERT INTO loanpayment_tbl (cust_id,loan_id,period,principal,interest,savings,total) VALUES ('$userRow[userName]','$loan_id','$period','$principal','$interest','$userRows[cust_savings]','$total')";
			$res = mysqli_query($conn,$querypay);
?>
    <tr>
    <td width="12%"><?php echo $period; ?></td>
    <td width="22%"><?php echo $principal; ?></td>
    <td width="22%"><?php echo $interest; ?></td>
    <td width="22%"><?php echo $userRows['cust_savings']; ?></td>
    <td width="22%"><?php echo $total; ?></td>
    </tr>


<?php }?>

<?php @$totalamount = @$totalprincipal + $totalinterst;?>
    <tr>
    <td width="12%"></td>
    <td width="22%"><strong><?php echo $totalprincipal; ?></strong></td>
    <td width="22%"><strong><?php echo $totalinterst; ?></strong></td>
    <td colspan="2"><strong>Total Loan Payment <?php echo $totalamount; ?></strong></td>
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
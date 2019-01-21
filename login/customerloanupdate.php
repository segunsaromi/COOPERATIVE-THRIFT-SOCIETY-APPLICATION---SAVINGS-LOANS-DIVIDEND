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

if ($_POST['loan_edit']){
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

		$loan_id = trim($_POST['loan_id']);
		$loan_id = strip_tags($loan_id);
		$loan_id = htmlspecialchars($loan_id);


	$conn = mysqli_connect('localhost','root','','cooperative');
$checkloan=mysqli_query($conn,"SELECT * FROM loanrequest_tbl WHERE loan_complete='0' and loan_status='0' and loan_id='$loan_id'");
if (mysqli_num_rows($checkloan) > 0){
			$queryedit = "UPDATE loanrequest_tbl SET loan_amount='$loan_amount', loan_duration='$loan_duration', loan_guarantor1='$loan_guarantor1', loan_guarantor2='$loan_guarantor2', loan_date='$_POST[loan_date]' WHERE loan_id='$loan_id'";
			$resedit = mysqli_query($conn,$queryedit);  } else {$error1="SORRY! Dear Member you can not EDIT the Loan Details after a loan is already APPROVED. Contact the Administrator for any further assistance. Thank You!"; }

}

	$ress=mysqli_query($conn,"SELECT * FROM personalinfo_tbl WHERE cust_id='$userRow[userName]'");
	$userRows=mysqli_fetch_array($ress);

	@$passave=@mysqli_query($conn,"SELECT * FROM savingamount_tbl WHERE cust_id='$userRow[userName]' and savings_status='1' ORDER BY SN DESC");
	@$userPassave=@mysqli_fetch_array($passave);
	$cust_savings = $userPassave['cust_savings'];
	?>
    
	<form method="post" id="reg-form" autocomplete="off">
    <table width="100%" border="0" class="table table-striped">
    
    <tr>
    <td colspan="2">
    	<div class="alert alert-info"><strong><?php echo @$error1; ?></strong><br />
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

<?php $principal=$loan_amount / $loan_duration; $interest=($loan_amount * 0.42) / $loan_duration; $total = $principal + $interest +  $cust_savings; $period=0;

$delete=mysqli_query($conn,"DELETE FROM loanpayment_tbl WHERE loan_id='$loan_id'"); 

			while ($loan_duration <> '0'){?>

<?php $loan_duration=$loan_duration - 1; @$period = @$period + 1; @$totalprincipal = @$totalprincipal + $principal; @$totalinterst = @$totalinterst + $interest; 


$querypay = "INSERT INTO loanpayment_tbl (cust_id,loan_id,period,principal,interest,savings,total) VALUES ('$userRow[userName]','$loan_id','$period','$principal','$interest','$cust_savings','$total')";
			$res = mysqli_query($conn,$querypay);
?>
    <tr>
    <td width="12%"><?php echo $period; ?></td>
    <td width="22%"><?php echo $principal; ?></td>
    <td width="22%"><?php echo $interest; ?></td>
    <td width="22%"><?php echo $cust_savings; ?></td>
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
				 <a href="index.php"> <button class="btn btn-primary" name="submit"> - RECORD VERIFIED - </button></a>
				</div>
				
			</form>
<script src="assets/jquery-1.12.4-jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>

    <?php
	
}
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

		$loan_guarantor3 = trim($_POST['loan_guarantor3']);
		$loan_guarantor3 = strip_tags($loan_guarantor3);
		$loan_guarantor3 = htmlspecialchars($loan_guarantor3);

		$loan_id = trim($_POST['loan_id']);
		$loan_id = strip_tags($loan_id);
		$loan_id = htmlspecialchars($loan_id);

		$cust_id = trim($_POST['cust_id']);
		$cust_id = strip_tags($cust_id);
		$cust_id = htmlspecialchars($cust_id);

		$loan_status = trim($_POST['loan_status']);
		$loan_status = strip_tags($loan_status);
		$loan_status = htmlspecialchars($loan_status);

//////////////////////////////////////////////////////////////////////////////

	$savings_report=0;
	$conn = mysqli_connect('localhost','root','','cooperative');



$member=mysqli_query($conn,"SELECT * FROM personalinfo_tbl WHERE cust_id='$cust_id'");
$memberRow=mysqli_fetch_array($member);

$error1 = '';
$error = '';
$error2 = '';

///////////////////////loan not activate so edit can be possible here

$checkloan=mysqli_query($conn,"SELECT * FROM loanrequest_tbl WHERE loan_complete='0' and loan_status='0' and loan_id='$loan_id'");
$loanpay=mysqli_query($conn,"SELECT * FROM loan_tbl WHERE loan_id='$loan_id'")or die(mysqli_error($conn));
if ((mysqli_num_rows($checkloan) > 0) && (mysqli_num_rows($loanpay) == 0)){

if ($memberRow['cust_status'] != 1){$error1 ="This member has not been activated. A member can only be activated for Loan only if their membership status has been activated.";

$queryedit = mysqli_query($conn,"UPDATE loanrequest_tbl SET loan_amount='$loan_amount', loan_duration='$loan_duration', loan_guarantor1='$loan_guarantor1', loan_guarantor2='$loan_guarantor2', loan_guarantor3='$loan_guarantor3', loan_date='$_POST[loan_date]' WHERE loan_id='$loan_id'");

$loan_status=0;
} 
	$conn = mysqli_connect('localhost','root','','cooperative');
	
	$view=mysqli_query($conn,"SELECT * FROM loanrequest_tbl WHERE cust_id='$cust_id' and loan_status='1'");
	$view2=mysqli_query($conn,"SELECT * FROM loanrequest_tbl WHERE loan_id='$loan_id'");
	$complete=mysqli_query($conn,"SELECT * FROM loanrequest_tbl WHERE cust_id='$cust_id' and loan_status='1' and loan_complete='0'");
	$viewRow=mysqli_fetch_array($view2);

if ($error1 == '') { 

if (($viewRow['loan_status'] == 1) && ($loan_status == 1))
{
$error2 ="This member Loan is already activated. Thank you!!"; 

$query = mysqli_query($conn,"UPDATE loanrequest_tbl SET loan_amount='$loan_amount', loan_duration='$loan_duration', loan_guarantor1='$loan_guarantor1', loan_guarantor2='$loan_guarantor2', loan_guarantor3='$loan_guarantor3', loan_date='$_POST[loan_date]' WHERE loan_id='$loan_id'") or die(mysqli_error($conn)); $loan_status = 1;
}


elseif ((mysqli_num_rows($complete) > 0) && ($loan_status == 1))
{
$error ="This member already have an existing Loan. A member can not have multiple Loan running at thesame time. You have to deactivate the existing Loan to activate new Loan"; $loan_status = 0;

$query = mysqli_query($conn,"UPDATE loanrequest_tbl SET loan_amount='$loan_amount', loan_duration='$loan_duration', loan_guarantor1='$loan_guarantor1', loan_guarantor2='$loan_guarantor2', loan_guarantor3='$loan_guarantor3', loan_date='$_POST[loan_date]' WHERE loan_id='$loan_id'") or die(mysqli_error($conn)); $loan_status = 0;
} 

else
{
$query = mysqli_query($conn, "UPDATE loanrequest_tbl SET loan_amount='$loan_amount', loan_duration='$loan_duration', loan_guarantor1='$loan_guarantor1', loan_guarantor2='$loan_guarantor2', loan_guarantor3='$loan_guarantor3', loan_status='$loan_status', loan_date='$_POST[loan_date]' WHERE loan_id='$loan_id'") or die(mysqli_error($conn));

}


}
} elseif((mysqli_num_rows($checkloan) == 0) && (mysqli_num_rows($loanpay) == 0)){
	
	
	
if ($memberRow['cust_status'] != 1){$error1 ="This member has not been activated. A member can only be activated for Loan only if their membership status has been activated.";

$queryedit = mysqli_query($conn,"UPDATE loanrequest_tbl SET loan_amount='$loan_amount', loan_duration='$loan_duration', loan_guarantor1='$loan_guarantor1', loan_guarantor2='$loan_guarantor2', loan_guarantor3='$loan_guarantor3', loan_date='$_POST[loan_date]' WHERE loan_id='$loan_id'");

$loan_status=0;
} 
	$conn = mysqli_connect('localhost','root','','cooperative');
	
	$view=mysqli_query($conn,"SELECT * FROM loanrequest_tbl WHERE cust_id='$cust_id' and loan_status='1'");
	$view2=mysqli_query($conn,"SELECT * FROM loanrequest_tbl WHERE loan_id='$loan_id'");
	$complete=mysqli_query($conn,"SELECT * FROM loanrequest_tbl WHERE cust_id='$cust_id' and loan_status='1' and loan_complete='0'");
	$viewRow=mysqli_fetch_array($view2);

if ($error1 == '') { 

if (($viewRow['loan_status'] == 1) && ($loan_status == 1))
{
$error2 ="This member Loan is already activated. Thank you!!"; 

$query = mysqli_query($conn,"UPDATE loanrequest_tbl SET loan_amount='$loan_amount', loan_duration='$loan_duration', loan_guarantor1='$loan_guarantor1', loan_guarantor2='$loan_guarantor2', loan_guarantor3='$loan_guarantor3', loan_date='$_POST[loan_date]' WHERE loan_id='$loan_id'") or die(mysqli_error($conn)); $loan_status = 1;
}


elseif ((mysqli_num_rows($complete) > 0) && ($loan_status == 1))
{
$error ="This member already have an existing Loan. A member can not have multiple Loan running at thesame time. You have to deactivate the existing Loan to activate new Loan"; $loan_status = 0;

$query = mysqli_query($conn,"UPDATE loanrequest_tbl SET loan_amount='$loan_amount', loan_duration='$loan_duration', loan_guarantor1='$loan_guarantor1', loan_guarantor2='$loan_guarantor2', loan_guarantor3='$loan_guarantor3', loan_date='$_POST[loan_date]' WHERE loan_id='$loan_id'") or die(mysqli_error($conn)); $loan_status = 0;
} 

else
{
$query = mysqli_query($conn, "UPDATE loanrequest_tbl SET loan_amount='$loan_amount', loan_duration='$loan_duration', loan_guarantor1='$loan_guarantor1', loan_guarantor2='$loan_guarantor2', loan_guarantor3='$loan_guarantor3', loan_status='$loan_status', loan_date='$_POST[loan_date]' WHERE loan_id='$loan_id'") or die(mysqli_error($conn));
}


}


}

else {$error1="SORRY! Dear Administrator you can not EDIT the Loan Amount and Loan Duration after a loan is already APPROVED. Contact the Developer for any further assistance. Thank You!"; 

if ($memberRow['cust_status'] != 1){$error1 ="This member has not been activated. A member can only be activated for Loan only if their membership status has been activated.";

$queryedit = mysqli_query($conn,"UPDATE loanrequest_tbl SET loan_guarantor1='$loan_guarantor1', loan_guarantor2='$loan_guarantor2', loan_guarantor3='$loan_guarantor3', loan_date='$_POST[loan_date]' WHERE loan_id='$loan_id'");

$loan_status=0;
} 
	$conn = mysqli_connect('localhost','root','','cooperative');
	
	$view=mysqli_query($conn,"SELECT * FROM loanrequest_tbl WHERE cust_id='$cust_id' and loan_status='1'");
	$view2=mysqli_query($conn,"SELECT * FROM loanrequest_tbl WHERE loan_id='$loan_id'");
	$complete=mysqli_query($conn,"SELECT * FROM loanrequest_tbl WHERE cust_id='$cust_id' and loan_status='1' and loan_complete='0'");
	$viewRow=mysqli_fetch_array($view2);

if ($error1 == '') { 

if (($viewRow['loan_status'] == 1) && ($loan_status == 1))
{
$error2 ="This member Loan is already activated. Thank you!!"; 

$query = mysqli_query($conn,"UPDATE loanrequest_tbl SET loan_guarantor1='$loan_guarantor1', loan_guarantor2='$loan_guarantor2', loan_guarantor3='$loan_guarantor3', loan_date='$_POST[loan_date]' WHERE loan_id='$loan_id'") or die(mysqli_error($conn)); $loan_status = 1;
}


elseif ((mysqli_num_rows($complete) > 0) && ($loan_status == 1))
{
$error ="This member already have an existing Loan. A member can not have multiple Loan running at thesame time. You have to deactivate the existing Loan to activate new Loan"; $loan_status = 0;

$query = mysqli_query($conn,"UPDATE loanrequest_tbl SET loan_guarantor1='$loan_guarantor1', loan_guarantor2='$loan_guarantor2', loan_guarantor3='$loan_guarantor3', loan_date='$_POST[loan_date]' WHERE loan_id='$loan_id'") or die(mysqli_error($conn)); $loan_status = 0;
} 

else
{
$query = mysqli_query($conn, "UPDATE loanrequest_tbl SET loan_guarantor1='$loan_guarantor1', loan_guarantor2='$loan_guarantor2', loan_guarantor3='$loan_guarantor3', loan_status='$loan_status', loan_date='$_POST[loan_date]' WHERE loan_id='$loan_id'") or die(mysqli_error($conn));
}


}



}





}



//////////////////////////////////////////////////////////////////////////////



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
    	<div class="alert alert-info"><strong><?php echo @$error2; ?></strong><br/><strong><?php echo @$error; ?></strong><br/><strong><?php echo @$error1; ?></strong><br/>
    		<strong>Success</strong>, Verify Details Entered... <?php echo $loan_id; ?> Status: <?php if (($loan_status=='0') or ($loan_status=='')){echo "<span style='color:#F00'><strong>INACTIVE</strong></span>";} elseif ($loan_status=='1'){echo "<span style='color:#004400'><strong>ACTIVE</strong></span>";} else {echo"<span style='color:#000000'><strong>PENDING</strong></span>";} ?>
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

<?php $principal=$loan_amount / $loan_duration; $interest=($loan_amount * 0.42) / $loan_duration; $total = $principal + $interest +  $userPassave['cust_savings']; $period=0;

$delete=mysqli_query($conn,"DELETE FROM loanpayment_tbl WHERE loan_id='$loan_id'"); 

			while ($loan_duration <> '0'){?>

<?php $loan_duration=$loan_duration - 1; @$period = @$period + 1; @$totalprincipal = @$totalprincipal + $principal; @$totalinterst = @$totalinterst + $interest; 


$querypay = "INSERT INTO loanpayment_tbl (cust_id,loan_id,period,principal,interest,savings,total) VALUES ('$userRow[userName]','$loan_id','$period','$principal','$interest','$userPassave[cust_savings]','$total')";
			$res = mysqli_query($conn,$querypay);
?>
    <tr>
    <td width="12%"><?php echo $period; ?></td>
    <td width="22%"><?php echo $principal; ?></td>
    <td width="22%"><?php echo $interest; ?></td>
    <td width="22%"><?php echo $userPassave['cust_savings']; ?></td>
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
				  <a href="index.php"><button class="btn btn-primary" name="submit"> - LOAN VERIFIED - </button></a>
				</div>
				
			</form>
<script src="assets/jquery-1.12.4-jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>

    <?php
	
}
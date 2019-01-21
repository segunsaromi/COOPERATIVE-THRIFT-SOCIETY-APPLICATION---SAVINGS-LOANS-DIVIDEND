
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


	$ress=mysqli_query($conn,"SELECT * FROM personalinfo_tbl WHERE cust_id='$userRow[userName]'");
	$userRows=mysqli_fetch_array($ress);

	
	
		@$loan_id = trim($_GET['loan_id']);
		@$loan_id = strip_tags($loan_id);
		@$loan_id = htmlspecialchars($loan_id);

?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome - <?php echo $userRow['userName']; ?></title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script> 
  <script src="assets/js/lga.js"></script>
<link rel="stylesheet" href="assets/css/bootstrap.min.css">
<link rel="stylesheet" href="style.css" type="text/css" />
<!--<link rel="stylesheet" type="text/css" href="style.css" />-->
<style>
	.wrapper{
		padding-top: 50px;
	}
	#form-content{
		margin: 0 auto;
		width: 500px;
	}
</style>
</head>
<body>

	<nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Admin Dashboard</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">     <?php 	$report1=mysqli_query($conn,"SELECT * FROM loanrequest_tbl WHERE report='0'");

	$report2=mysqli_query($conn,"SELECT * FROM savingamount_tbl WHERE report='0'");


	$msg1=mysqli_query($conn,"SELECT * FROM loanrequest_tbl WHERE msg='0'");

	$msg2=mysqli_query($conn,"SELECT * FROM savingamount_tbl WHERE msg='0'");

if ((mysqli_num_rows($report1) > 0) or (mysqli_num_rows($report2) > 0)){$rep="rep1.jpg";} else {$rep="rep.jpg";}

if ((mysqli_num_rows($msg1) > 0) or (mysqli_num_rows($msg2) > 0)){$msg="msg1.jpg";} else {$msg="msg.jpg";}
?>     <ul class="nav navbar-nav">            <li><a href="admin_detail.php">Home</a></li>
            <li><a href="members_detail.php">Members</a></li>			<li><a href="membersloan_detail.php">Loan</a></li>
            <li><a href="memberssavings_detail.php">Savings</a></li>
<li><a href="savings_deposit.php">S.Deposit</a></li>
<li><a href="loan_deposit.php">L.Deposit</a></li>
            <li><a href="expenditure.php">Expenditure</a></li>
<li><a href="admin_report.php" title="See Messages"><img name="" src="<?php echo $msg; ?>" width="20" height="20" alt=""></a></li>
            <li><a href="#" title="Generate Report"><img name="" src="<?php echo $rep; ?>" width="20" height="20" alt=""></a></li>
          </ul>

          <ul class="nav navbar-nav navbar-right">
            
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">			  <span class="glyphicon glyphicon-user"></span>&nbsp;Admin ID:<strong><?php echo $userRow['userName']; ?> </strong>&nbsp;<span class="caret"></span></a>
              <ul class="dropdown-menu">                <li><a href="dividend.php"></span>&nbsp;Share Dividend</a></li>                <li><a href="dividend_edit.php"></span>&nbsp;Delete Dividend</a></li>
                <li><a href="print_mandate.php"></span>&nbsp;Print Mandate</a></li>
                <li><a href="savings_deduction.php"></span>&nbsp;Print Deduction</a></li>
                <li><a href="select_report.php"></span>&nbsp;Retrieve Mandate</a></li>
                <li><a href="select_reportb.php"></span>&nbsp;Retrieve Deduction</a></li>

<li><a href="logout.php?logout"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Sign Out</a></li>
</ul>
            </li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav> 

	<div id="wrapper">
<div style="background-image: url(../onlineapp/ccslogo/header.jpg); background-repeat: no-repeat center center; background-size: cover; height: 150px"></div>

	<div class="container"><br>
	  <div class="col-lg-12">
	
		<div class="row">
		
			<div id="form-content">
			
			<table width="100%" border="0" class="table table-striped">
  <tr>
    <td colspan="3">CUSTOMER RECORD</td>
    </tr>
  <tr>
    <td><strong>Cust. ID</strong></td>
    <td><strong>Customer Name.</strong><strong></strong></td>
    <td><strong> Status</strong></td>
  </tr>
<?php 
$conn = mysqli_connect('localhost','root','','cooperative');
$customer = mysqli_query($conn,"SELECT * FROM loanrequest_tbl WHERE loan_id='$loan_id'");
$fcustomer=mysqli_fetch_array($customer);
$cust_id=$fcustomer['cust_id'];

$customers = mysqli_query($conn,"SELECT * FROM personalinfo_tbl WHERE cust_id='$cust_id'");
$fcustomers=mysqli_fetch_array($customers);


$cust_fname=$fcustomers['cust_fname'];
$cust_oname=$fcustomers['cust_oname'];
$cust_lname=$fcustomers['cust_lname'];
$cust_status=$fcustomers['cust_status'];

?>
<tr>
    <td><a href="customerdetail_admin.php?page=null&cust_id=<?php echo $cust_id; ?>" title="<?php echo $cust_id; ?>"><?php echo $cust_id; ?></a></td>
    <td><?php echo $cust_lname; ?> <?php echo $cust_fname; ?> <?php echo $cust_fname; ?></td>
    <td><?php if (($cust_status=='0') or ($cust_status=='')){echo "<span style='color:#F00'><strong>INACTIVE</strong></span>";} elseif ($cust_status=='1'){echo "<span style='color:#004400'><strong>ACTIVE</strong></span>";} else {echo"<span style='color:#000000'><strong>PENDING</strong></span>";} ?></td>
  </tr> 
</table><br>
<table width="100%" border="0" class="table table-striped">
  <tr>
    <td colspan="6">LOAN REQUEST(s) FOR <span style='color:#F00'><strong><?php echo $cust_lname; ?> <?php echo $cust_fname; ?> <?php echo $cust_fname; ?></strong></span></td>
    </tr>
  <tr>
    <td><strong>Loan ID</strong></td>
    <td><strong>Loan Amount</strong></td>
    <td><strong>Duration</strong></td>
    <td><strong>Loan Date</strong></td>
    <td><strong>Status</strong></td>
	<td><strong>Edit</strong></td>  </tr>
<?php 
$conn = mysqli_connect('localhost','root','','cooperative');
$detaila = mysqli_query($conn,"SELECT * FROM loanrequest_tbl WHERE loan_id='$loan_id'");
while ($detailfetcha=mysqli_fetch_array($detaila)){?>  
<?php

//$loan_id=$detailfetcha['loan_id'];
$loan_amount=$detailfetcha['loan_amount'];
$loan_duration=$detailfetcha['loan_duration'];
$loan_date=$detailfetcha['loan_date'];
$loan_status=$detailfetcha['loan_status'];
$done=mysqli_query($conn,"SELECT * FROM loanrequest_tbl WHERE loan_complete='1' and loan_id='$loan_id'") or die(mysqli_error($conn));?>
<tr>
    <td><a href="adminloan_detail.php?page=null&loan_id=<?php echo $loan_id; ?>" title="<?php echo $loan_id; ?>"><?php echo $loan_id; ?></a></td>
    <td><?php echo $loan_amount; ?></td>
    <td><?php echo $loan_duration; ?></td>
    <td><?php echo $loan_date; ?></td>
    <td><?php if (mysqli_num_rows($done) > 0){echo "<span style='color:#004400'><strong>COMPLETE</strong></span>";} elseif (($loan_status=='0') or ($loan_status=='')){echo "<span style='color:#F00'><strong>INACTIVE</strong></span>";} elseif ($loan_status=='1'){echo "<span style='color:#004400'><strong>ACTIVE</strong></span>";} else {echo"<span style='color:#000000'><strong>PENDING</strong></span>";} ?></td>
<td><a href="loan_edit.php?page=null&loan_id=<?php echo $loan_id; ?>" title="<?php echo $loan_id; ?>">-|-</a></td>  </tr> <?php }?>
</table><br><br>

<?php $check = mysqli_query($conn,"SELECT * FROM loanrequest_tbl WHERE loan_id='$loan_id' and loan_status='1' LIMIT 1"); 
$loanco=mysqli_fetch_array($check);
if (mysqli_num_rows($check) <> 0) {?> 

<table width="100%" border="0" class="table table-striped">
    
    <tr>
    <td colspan="6">
EXISTING LOAN (Loan ID: <span style='color:#F00'><strong><?php echo $loanco['loan_id']; ?></strong></span>) FOR 
    <span style='color:#F00'><strong><?php echo $cust_lname; ?> <?php echo $cust_fname; ?> <?php echo $cust_fname; ?></strong></span></td>
    </tr>
    
    <tr>
    <td width="12%"><strong>Month</strong></td>
    <td width="22%"><strong>Principal</strong></td>
    <td width="22%"><strong>Interest</strong></td>
    <td width="22%"><strong>Savings</strong></td>
    <td width="22%"><strong>Monthly Deductions</strong></td>
    <td width="22%"><strong>Paid</strong></td>
    </tr>




<?php
$resloan = mysqli_query($conn,"SELECT * FROM loanpayment_tbl WHERE loan_id='$loanco[loan_id]'"); 
while ($loanget=mysqli_fetch_array($resloan)) {?>
    

<?php 
$period=$loanget['period'];
$principal=$loanget['principal'];
$interest=$loanget['interest'];
$savings=$loanget['savings'];
$total=$loanget['total'];
$status=$loanget['status']; if ($status == 1){$status="PAID";} else {$status="UNPAID";}

@$periods = @$periods + 1; @$totalprincipal = @$totalprincipal + $principal; @$totalinterst = @$totalinterst + $interest; @$totalsavings = @$totalsavings + $savings; @$totalpayment = @$totalinterst + $totalprincipal; ?>


    <tr>
    <td width="12%"><?php echo $periods; ?></td>
    <td width="22%"><?php echo $principal; ?></td>
    <td width="22%"><?php echo $interest; ?></td>
    <td width="22%"><?php echo $savings; ?></td>
    <td width="22%"><?php echo $total; ?></td>
    <td width="22%"><?php echo $status; ?></td>
    </tr>


<?php }?>

<?php @$totalamount = @$totalprincipal + $totalinterst;?>
    <tr>
    <td width="12%"></td>
    <td width="22%"><strong><?php echo $totalprincipal; ?></strong></td>
    <td width="22%"><strong><?php echo $totalinterst; ?></strong></td>
    <td colspan="2"><strong>Total Loan Payment = <?php echo $totalpayment; ?></strong></td>
    </tr>

 
    </table>
<?php }?>            
          </div>
            
            </div>
		
	</div>
	
</div>
	
</div>
<script src="assets/jquery-1.12.4-jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>

<script type="text/javascript">
$(document).ready(function() {	
	
	// submit form using $.ajax() method
	
	$('#reg-form').submit(function(e){
		
		e.preventDefault(); // Prevent Default Submission
		
		$.ajax({
			url: 'submit.php',
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
</body>
</html>
<?php ob_end_flush(); ?>
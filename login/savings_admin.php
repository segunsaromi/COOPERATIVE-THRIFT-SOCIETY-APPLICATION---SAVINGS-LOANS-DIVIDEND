
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

	
	
		@$savings_id = trim($_GET['savings_id']);
		@$savings_id = strip_tags($savings_id);
		@$savings_id = htmlspecialchars($savings_id);

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
$customer = mysqli_query($conn,"SELECT * FROM savingamount_tbl WHERE savings_id='$savings_id'");
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
    <td colspan="6">SAVINGS DEPOSIT REQUEST</td>
    </tr>
  <tr>
    <td><strong>Savings ID</strong></td>
    <td><strong>Monthly Savings</strong></td>
    <td><strong>Date Started</strong></td>
    <td><strong>Status</strong></td>
    <td><strong>View</strong></td>
    <td><strong>Edit</strong></td>
  </tr>
<?php 
$conn = mysqli_connect('localhost','root','','cooperative');
$detaila = mysqli_query($conn,"SELECT * FROM savingamount_tbl WHERE cust_id='$cust_id'");
while ($detailfetcha=mysqli_fetch_array($detaila)){?>  
<?php

$cust_savings=$detailfetcha['cust_savings'];
$savings_date=$detailfetcha['savings_date'];
$savings_status=$detailfetcha['savings_status'];
$savings_id=$detailfetcha['savings_id'];

?>
<tr>
    <td><a href="savings_admin.php?page=null&savings_id=<?php echo $savings_id; ?>" title="<?php echo $savings_id; ?>"><?php echo $savings_id; ?></a></td>
    <td><?php echo $cust_savings; ?></td>
    <td><?php echo $savings_date; ?></td>
    <td><?php if (($savings_status=='0') or ($savings_status=='')){echo "<span style='color:#F00'><strong>INACTIVE</strong></span>";} elseif ($savings_status=='1'){echo "<span style='color:#004400'><strong>ACTIVE</strong></span>";} else {echo"<span style='color:#000000'><strong>PENDING</strong></span>";} ?></td>
<td><a href="adminsavings_detail.php?page=null&savings_id=<?php echo $savings_id; ?>" title="<?php echo $savings_id; ?>">-|-</a></td>
<td><a href="savings_edit.php?page=null&savings_id=<?php echo $savings_id; ?>" title="<?php echo $savings_id; ?>">-|-</a></td>  </tr> <?php }?>
</table><br><br><table width="100%" border="0" class="table table-striped">
  <tr>
    <td colspan="3">SAVINGS DEPOSIT TRANSACTIONS for <strong><?php echo $savings_id; ?></strong></td>
    </tr>
  <tr>
    <td><strong>S/n</strong></td>
    <td><strong>Savings</strong></td>
    <td><strong>Date</strong></td>
  </tr>
<?php 
$conn = mysqli_connect('localhost','root','','cooperative');
$detail = mysqli_query($conn,"SELECT * FROM savings_tbl WHERE savings_id='$savings_id'"); 
while ($detailfetch=mysqli_fetch_array($detail)){?>  
<?php

@$period=@$period + 1;
$cust_savings=$detailfetch['cust_savings'];
$savings_date=$detailfetch['savings_date'];

?>
<?php  @$totalsavings = @$totalsavings + $cust_savings; ?>
<tr>
    <td><?php echo $period; ?></td>
    <td><?php echo $cust_savings; ?></td>
    <td><?php echo $savings_date; ?></td>
  </tr> <?php }?>
    <tr>
    <td colspan="3"><strong>Total Savings Deposit = <?php echo @$totalsavings; ?></strong></td>
    </tr>
</table>

            
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
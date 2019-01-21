<?php
	ob_start();
	session_start();
	require_once 'dbconnect.php';
	
	// if session is not set this will redirect to login page
	if( !isset($_SESSION['admin']) ) {
		header("Location: index.php");
		exit;
	}
	$conn = mysqli_connect('localhost','root','','cooperative');

	// select loggedin users detail
	$conn = mysqli_connect('localhost','root','','cooperative');
	$res=mysqli_query($conn,"SELECT * FROM users WHERE userId=".$_SESSION['admin']);
	$userRow=mysqli_fetch_array($res);

	$ress=mysqli_query($conn,"SELECT * FROM personalinfo_tbl WHERE cust_id='$userRow[userName]'");
	$userRows=mysqli_fetch_array($ress);

	$pass=mysqli_query($conn,"SELECT * FROM personalinfo_tbl WHERE cust_id='$userRow[userName]'");
	$userPass=mysqli_fetch_array($pass);
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome - <?php echo $userRow['userName']; ?></title>
<link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css"  />
<link rel="stylesheet" href="style.css" type="text/css" />
<style>
	.wrapper{
		padding-top: 50px;
	}
	#form-content{
		margin: 0 auto;
		width: 600px;
	}
</style></head>
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
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">            <li><a href="admin_detail.php">Home</a></li>
            <li><a href="members_detail.php">Members</a></li>			<li><a href="membersloan_detail.php">Loan</a></li>
            <li><a href="memberssavings_detail.php">Savings</a></li>
<li><a href="savings_deposit.php">Deposit</a></li>
            <li><a href="#">Withdrawal</a></li>
            <li><a href="#">Report</a></li>
            <li><a href="#">Request</a></li>
            <li><a href="#"><img name="" src="msg.jpg" width="20" height="20" alt=""></a></li>
            <li><a href="#"><img name="" src="rep.jpg" width="20" height="20" alt=""></a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">			  <span class="glyphicon glyphicon-user"></span>&nbsp;Admin ID:<strong><?php echo $userRow['userName']; ?> </strong>&nbsp;<span class="caret"></span></a>
              <ul class="dropdown-menu">                
              <li><a href="dividend.php"></span>&nbsp;Share Dividend</a></li>                <li><a href="dividend_edit.php"></span>&nbsp;Delete Dividend</a></li>
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
	  <div id="form-content">
<h4 align="center">CUSTOMER REQUEST(s)</h4><table width="100%" border="0" class="table table-striped">
  <tr>
    <td colspan="6">LOAN REQUEST(s)</td>
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
$detaila = mysqli_query($conn,"SELECT * FROM loanrequest_tbl ORDER by SN DESC");
while ($detailfetcha=mysqli_fetch_array($detaila)){?>  
<?php

$cust_id=$detailfetcha['cust_id'];
$loan_id=$detailfetcha['loan_id'];
$loan_amount=$detailfetcha['loan_amount'];
$loan_duration=$detailfetcha['loan_duration'];
$loan_date=$detailfetcha['loan_date'];
$loan_status=$detailfetcha['loan_status'];
$loan_complete=$detailfetcha['loan_complete'];
$message = mysqli_query($conn,"UPDATE loanrequest_tbl SET report=1 WHERE loan_id='$loan_id'") or die(mysqli_error($conn));

$custsave=mysqli_query($conn,"SELECT * FROM personalinfo_tbl WHERE cust_id='$cust_id'");
$custsavev=mysqli_fetch_array($custsave);
$cust_fname=$custsavev['cust_fname'];
$cust_oname=$custsavev['cust_oname'];
$cust_lname=$custsavev['cust_lname'];

?>

<tr>
<td><a href="customerdetail_admin.php?page=null&cust_id=<?php echo $loan_id; ?>" title="<?php echo $loan_id; ?>"><?php echo $cust_lname; ?> <?php echo $cust_fname; ?> <?php echo $cust_oname; ?></a></td>
    <td><?php echo $loan_amount; ?></td>
    <td><?php echo $loan_duration; ?></td>
    <td><?php echo $loan_date; ?></td>
    <td><?php if (($loan_status=='0') or ($loan_status=='')){echo "<span style='color:#F00'><strong>INACTIVE</strong></span>";} elseif ($loan_status=='1' and $loan_complete='1'){echo "<span style='color:#004400'><strong>COMPLETE</strong></span>";} elseif ($loan_status=='1'){echo "<span style='color:#004400'><strong>ACTIVE</strong></span>";} else {echo"<span style='color:#000000'><strong>PENDING</strong></span>";} ?></td>
<td><a href="loan_edit.php?page=null&loan_id=<?php echo $loan_id; ?>" title="<?php echo $loan_id; ?>">-|-</a></td>  </tr> <?php }?>
</table><br><br><table width="100%" border="0" class="table table-striped">
  <tr>
    <td colspan="4">SAVINGS REQUEST(s)</td>
    </tr>
<tr>
    <td><strong>Savings ID</strong></td>
    <td><strong>Monthly Savings</strong></td>
    <td><strong>Date Started</strong></td>
    <td><strong>Status</strong></td>
    <td><strong>View</strong></td>
    <td><strong>Edit</strong></td>
  </tr><?php 
$conn = mysqli_connect('localhost','root','','cooperative');
$detaila = mysqli_query($conn,"SELECT * FROM savingamount_tbl ORDER by SN DESC");
while ($detailfetcha=mysqli_fetch_array($detaila)){?>  
<?php

$cust_id=$detailfetcha['cust_id'];
$cust_savings=$detailfetcha['cust_savings'];
$savings_date=$detailfetcha['savings_date'];
$savings_status=$detailfetcha['savings_status'];
$savings_id=$detailfetcha['savings_id'];
$messages = mysqli_query($conn,"UPDATE savingamount_tbl SET report=1 WHERE savings_id='$savings_id'") or die(mysqli_error($conn));


$custsave=mysqli_query($conn,"SELECT * FROM personalinfo_tbl WHERE cust_id='$cust_id'");
$custsavev=mysqli_fetch_array($custsave);
$cust_fname=$custsavev['cust_fname'];
$cust_oname=$custsavev['cust_oname'];
$cust_lname=$custsavev['cust_lname'];

?>
<tr>    

<td><a href="customerdetail_admin.php?page=null&cust_id=<?php echo $savings_id; ?>" title="<?php echo $savings_id; ?>"><?php echo $cust_lname; ?> <?php echo $cust_fname; ?> <?php echo $cust_oname; ?></a></td>
    <td><?php echo $cust_savings; ?></td>
    <td><?php echo $savings_date; ?></td>
    <td><?php if (($savings_status=='0') or ($savings_status=='')){echo "<span style='color:#F00'><strong>INACTIVE</strong></span>";} elseif ($savings_status=='1'){echo "<span style='color:#004400'><strong>ACTIVE</strong></span>";} else {echo"<span style='color:#000000'><strong>PENDING</strong></span>";} ?></td>
<td><a href="adminsavings_detail.php?page=null&savings_id=<?php echo $savings_id; ?>" title="<?php echo $savings_id; ?>">-|-</a></td>
<td><a href="savings_edit.php?page=null&savings_id=<?php echo $savings_id; ?>" title="<?php echo $savings_id; ?>">-|-</a></td>    </tr> <?php }?>
</table><br><br></div>
    
    </div>
    
    </div>
    
    <script src="assets/jquery-1.11.3-jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    
</body>
</html>
<?php ob_end_flush(); ?>
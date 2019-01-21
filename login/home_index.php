<?php
	ob_start();
	session_start();
	require_once 'dbconnect.php';
	
	// if session is not set this will redirect to login page
	if( !isset($_SESSION['user']) ) {
		header("Location: index.php");
		exit;
	}
	$conn = mysqli_connect('localhost','root','','cooperative');

	// select loggedin users detail
	$conn = mysqli_connect('localhost','root','','cooperative');
	$res=mysqli_query($conn,"SELECT * FROM users WHERE userId=".$_SESSION['user']);
	$userRow=mysqli_fetch_array($res);

	$ress=mysqli_query($conn,"SELECT * FROM personalinfo_tbl WHERE cust_id='$userRow[userName]'");
	$userRows=mysqli_fetch_array($ress);
	$cust_fname = $userRows['cust_fname'];
	$cust_oname = $userRows['cust_oname'];
	$cust_lname = $userRows['cust_lname'];
	$cust_staffstatus = $userRows['cust_staffstatus'];
	$cust_healthstatus = $userRows['cust_healthstatus'];
	$cust_staffid = $userRows['cust_staffid'];
	$cust_nok = $userRows['cust_nok'];


	@$passave=@mysqli_query($conn,"SELECT * FROM savingamount_tbl WHERE cust_id='$userRow[userName]' and savings_status='1' ORDER BY SN DESC");
	@$userPassave=@mysqli_fetch_array($passave);
	$cust_savings = $userPassave['cust_savings'];


	$cust_nokrelationship = $userRows['cust_nokrelationship'];
	$cust_noknum = $userRows['cust_noknum'];
	$cust_school = $userRows['cust_school'];
	$cust_department = $userRows['cust_department'];

	@$pass=@mysqli_query($conn,"SELECT * FROM passport_tbl WHERE AppNumber='$userRow[userName]'");
	@$userPass=@mysqli_fetch_array($pass);

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
          <a class="navbar-brand" href="#">YCT Staff Cooperative</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">          <ul class="nav navbar-nav">
            <li><a href="home.php">Profile</a></li>
            <li><a href="imageupload/index.php">View/Edit Photograph</a></li>
            <li><a href="form.php">View/Edit Record</a></li>
            <li><a href="loan.php">Loan Application</a></li>
            <li><a href="bank_edit.php">Bank Details</a></li>
            <li><a href="g_history.php">History</a></li>

          </ul>
<ul class="nav navbar-nav navbar-right">
            
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
			  <span class="glyphicon glyphicon-user"></span>&nbsp;Member ID:<strong><?php echo $userRow['userName']; ?> </strong>&nbsp;<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="logout.php?logout"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Sign Out</a></li>
              </ul>
            </li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav> 

	<div id="wrapper">
<div style="background-image: url(../onlineapp/ccslogo/header.jpg); background-repeat: no-repeat center center; background-size: cover; height: 150px"></div>
	<div class="container">
    
    	<div class="page-header">
    	<h3>Staff Cooperative Multipurpose Society Ltd. -  Members Portal</h3>
    	<table width="100%">   
       <tr>
    <td width="13%"><img name="" src="imageupload/<?php if ($userRows['Passport'] <> "") {echo $userRows['Passport'];} else {echo "no-image.jpg";} ?>" width="60" height="60" alt=""></td>
    <td width="87%"><h5 style="color:#030"><strong> Name:</strong> <?php echo $cust_lname; echo " "; echo $cust_fname; echo " "; echo $cust_oname; ?></h5>         </td>
    </tr>
        
</table>
    	</div>
        
        <div id="form-content"><table width="100%" border="0" class="table table-striped">
  <tr>
    <td colspan="6">LOAN RECORD/TRANSACTIONS </td>
    </tr>
  <tr>
    <td width="12%"><strong>Loan ID</strong></td>
    <td width="22%"><strong>Loan Amount</strong></td>
    <td width="22%"><strong>Loan Date</strong></td>
    <td><strong>Duration</strong></td>
    <td><strong>Status</strong></td>
    <td><strong>Edit</strong></td>
  </tr>
<?php 
$conn = mysqli_connect('localhost','root','','cooperative');
$detail = mysqli_query($conn,"SELECT * FROM loanrequest_tbl WHERE cust_id='$userRow[userName]'"); 
while ($detailfetch=mysqli_fetch_array($detail)){?>  
<?php
$loan_duration=$detailfetch['loan_duration'];
$loan_amount=$detailfetch['loan_amount'];
$loan_date=$detailfetch['loan_date'];
$loan_status=$detailfetch['loan_status'];
$loan_id=$detailfetch['loan_id'];

$done=mysqli_query($conn,"SELECT * FROM loanrequest_tbl WHERE loan_complete='1' and loan_id='$loan_id'") or die(mysqli_error($conn));

?>

<tr>
    <td><a href="loan_detail.php?page=null&loan_id=<?php echo $loan_id; ?>" title="<?php echo $loan_id; ?>"><?php echo $loan_id; ?></a></td>
    <td><?php echo $loan_amount; ?></td>
    <td><?php echo $loan_date; ?></td>
    <td><?php echo $loan_duration; ?></td>
    <td><?php if (mysqli_num_rows($done) > 0){echo "<span style='color:#004400'><strong>COMPLETE</strong></span>";} elseif (($loan_status=='0') or ($loan_status=='')){echo "<span style='color:#F00'><strong>INACTIVE</strong></span>";} elseif ($loan_status=='1'){echo "<span style='color:#004400'><strong>ACTIVE</strong></span>";} else {echo"<span style='color:#000000'><strong>PENDING</strong></span>";} ?></td>
    <td><a href="customerloan_edit.php?page=null&loan_id=<?php echo $loan_id; ?>" title="<?php echo $loan_id; ?>">-|-</a></td>
  </tr> <?php }?>
</table><br><br><table width="100%" border="0" class="table table-striped">
  <tr>
    <td colspan="5">SAVINGS DEPOSIT RECORD/TRANSACTIONS </td>
    </tr>
  <tr>
    <td><strong>Savings ID</strong></td>
    <td><strong>Monthly Savings Amount</strong></td>
    <td><strong>Date Started</strong></td>
    <td><strong>Savings Status</strong></td>
    <td><strong>Edit</strong></td>
  </tr>
<?php 
$conn = mysqli_connect('localhost','root','','cooperative');
$detaila = mysqli_query($conn,"SELECT * FROM savingamount_tbl WHERE cust_id='$userRow[userName]'");
while ($detailfetcha=mysqli_fetch_array($detaila)){?>  
<?php

$cust_savings=$detailfetcha['cust_savings'];
$savings_date=$detailfetcha['savings_date'];
$savings_status=$detailfetcha['savings_status'];
$savings_id=$detailfetcha['savings_id'];


?>
<tr>
    <td><a href="savings_detail.php?page=null&savings_id=<?php echo $savings_id; ?>" title="<?php echo $savings_id; ?>"><?php echo $savings_id; ?></a></td>
    <td><?php echo $cust_savings; ?></td>
    <td><?php echo $savings_date; ?></td>
    <td><?php if (($savings_status=='0') or ($savings_status=='')){echo "<span style='color:#F00'><strong>INACTIVE</strong></span>";} elseif ($savings_status=='1'){echo "<span style='color:#004400'><strong>ACTIVE</strong></span>";} else {echo"<span style='color:#000000'><strong>PENDING</strong></span>";} ?></td>
<td><a href="customersavings_edit.php?page=null&savings_id=<?php echo $savings_id; ?>" title="<?php echo $savings_id; ?>">-|-</a></td>  </tr> <?php }?>
</table><br><br><table width="100%" border="0" class="table table-striped">
  <tr>
    <td colspan="4">TOTAL SAVINGS/ACCOUNT BALANCE</td>
    </tr>
  <tr>
    <td colspan="4"><strong>Total Savings</strong></td>
  </tr>
<?php 
$conn = mysqli_connect('localhost','root','','cooperative');
$detaillimit = mysqli_query($conn,"SELECT * FROM savings_tbl WHERE cust_id='$userRow[userName]' LIMIT 1");
$detailflimit=mysqli_fetch_array($detaillimit);

$detailb = mysqli_query($conn,"SELECT * FROM savings_tbl WHERE cust_id='$userRow[userName]'");
while ($detailfetchb=mysqli_fetch_array($detailb)){?>  
<?php
$cust_savings=$detailfetchb['cust_savings'];
@$cust_savingstotal = $cust_savingstotal + $cust_savings;
?><?php }?>
<?php 
$savings_date1=$detailflimit['savings_date'];
$savings_status=$detailfetchb['savings_status'];
$savings_date2=$detailfetchb['savings_date'];
?>
<tr>
    <td colspan="4">N <?php echo @$cust_savingstotal; ?></td>
  </tr> 
</table></div>
    
    </div>
    
    </div>
    
    <script src="assets/jquery-1.11.3-jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    
</body>
</html>
<?php ob_end_flush(); ?>
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
	  <div id="form-content"><br><h4 align="center">MEMBERS LOAN DETAILS</h4><br><table width="100%" border="0" class="table table-striped">
  <tr>
    <td colspan="5">LOAN RECORD/TRANSACTIONS <span style="color:#F00"><strong>ACTIVE</strong></span></td>
    </tr>
  <tr>
    <td><strong>Cust Name</strong></td>
    <td><strong>Loan Amount</strong></td>
    <td><strong>Loan Date</strong></td>
    <td><strong>Duration</strong></td>
    <td><strong>Status</strong></td>
  </tr>
<?php 
$conn = mysqli_connect('localhost','root','','cooperative');
$detail = mysqli_query($conn,"SELECT * FROM loanrequest_tbl WHERE loan_status='1'"); 
while ($detailfetch=mysqli_fetch_array($detail)){?>  
<?php
$loan_duration=$detailfetch['loan_duration'];
$loan_amount=$detailfetch['loan_amount'];
$loan_date=$detailfetch['loan_date'];
$loan_status=$detailfetch['loan_status'];
$loan_id=$detailfetch['loan_id'];


?>
<?php 
$good=mysqli_query($conn,"SELECT * FROM loanrequest_tbl WHERE loan_id='$loan_id' ");
$goodrow=mysqli_fetch_array($good);

$cust=mysqli_query($conn,"SELECT * FROM personalinfo_tbl WHERE cust_id='$goodrow[cust_id]'");
$custrow=mysqli_fetch_array($cust);
$cust_fname=$custrow['cust_fname'];
$cust_oname=$custrow['cust_oname'];
$cust_lname=$custrow['cust_lname'];
$done=mysqli_query($conn,"SELECT * FROM loanrequest_tbl WHERE loan_complete='1' and loan_id='$loan_id'") or die(mysqli_error($conn));
 ?>
<tr>
    <td><a href="loan_admin.php?page=null&loan_id=<?php echo $loan_id; ?>" title="<?php echo $loan_id; ?>"><?php echo $cust_lname; ?> <?php echo $cust_fname; ?> <?php echo $cust_oname; ?></a></td>
    <td><?php echo $loan_amount; ?></td>
    <td><?php echo $loan_date; ?></td>
    <td><?php echo $loan_duration; ?></td>
    <td><?php  if (mysqli_num_rows($done) > 0){echo "<span style='color:#004400'><strong>COMPLETE</strong></span>";} elseif (($loan_status=='0') or ($loan_status=='')){echo "<span style='color:#F00'><strong>INACTIVE</strong></span>";} elseif ($loan_status=='1'){echo "<span style='color:#004400'><strong>ACTIVE</strong></span>";} else {echo"<span style='color:#000000'><strong>PENDING</strong></span>";} ?></td>
  </tr> <?php }?>
</table><table width="100%" border="0" class="table table-striped">
  <tr>
    <td colspan="5">LOAN RECORD/TRANSACTIONS <span style="color:#F00"><strong>INACTIVE/PENDING</strong></span></td>
    </tr>
  <tr>
    <td><strong>Cust Name</strong></td>
    <td><strong>Loan Amount</strong></td>
    <td><strong>Loan Date</strong></td>
    <td><strong>Duration</strong></td>
    <td><strong>Status</strong></td>
  </tr>
<?php 
$conn = mysqli_connect('localhost','root','','cooperative');
$detail = mysqli_query($conn,"SELECT * FROM loanrequest_tbl WHERE loan_status='' or loan_status='6' or loan_status='0'"); 
while ($detailfetch=mysqli_fetch_array($detail)){?>  
<?php
$loan_duration=$detailfetch['loan_duration'];
$loan_amount=$detailfetch['loan_amount'];
$loan_date=$detailfetch['loan_date'];
$loan_status=$detailfetch['loan_status'];
$loan_id=$detailfetch['loan_id'];


?>
<?php 
$gooda=mysqli_query($conn,"SELECT * FROM loanrequest_tbl WHERE loan_id='$loan_id' ");
$goodrowa=mysqli_fetch_array($gooda);

$custa=mysqli_query($conn,"SELECT * FROM personalinfo_tbl WHERE cust_id='$goodrowa[cust_id]'");
$custrowa=mysqli_fetch_array($custa);
$cust_fname=$custrowa['cust_fname'];
$cust_oname=$custrowa['cust_oname'];
$cust_lname=$custrowa['cust_lname'];

?>
<tr>
    <td><a href="loan_admin.php?page=null&loan_id=<?php echo $loan_id; ?>" title="<?php echo $loan_id; ?>"><?php echo $cust_lname; ?> <?php echo $cust_fname; ?> <?php echo $cust_oname; ?></a></td>
    <td><?php echo $loan_amount; ?></td>
    <td><?php echo $loan_date; ?></td>
    <td><?php echo $loan_duration; ?></td>
    <td><?php if (($loan_status=='0') or ($loan_status=='')){echo "<span style='color:#F00'><strong>INACTIVE</strong></span>";} elseif ($loan_status=='1'){echo "<span style='color:#004400'><strong>ACTIVE</strong></span>";} else {echo"<span style='color:#000000'><strong>PENDING</strong></span>";} ?></td>
  </tr> <?php }?>
</table><br><br></div>
    
    </div>
    
    </div>
    
    <script src="assets/jquery-1.11.3-jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    
</body>
</html>
<?php ob_end_flush(); ?>
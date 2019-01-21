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
	<div class="container">
    
    	<div class="page-header">
    	<h3 align="center">Staff Cooperative Multipurpose Society Ltd. - Admin Portal</h3>
    	</div>
<?php 
$conn = mysqli_connect('localhost','root','','cooperative');
$activeloan = mysqli_query($conn,"SELECT * FROM loanrequest_tbl WHERE loan_status='1'");


while ($activerow=mysqli_fetch_array($activeloan)){?>  
<?php 
$activeloan_payment=$activerow['loan_amount'];
@$activeloan_paid=@$activeloan_paid + $activeloan_payment;
?>
<?php }?>

<?php 
$active = mysqli_query($conn,"SELECT * FROM loanrequest_tbl WHERE loan_status='1' and loan_complete='0'");
@$numactive=0;

while ($activero=mysqli_fetch_array($active)){?>  
<?php 
@$numactive = @$numactive + 1;
?>
<?php }?>


<?php 
$conn = mysqli_connect('localhost','root','','cooperative');
$completeloan = mysqli_query($conn,"SELECT * FROM loanrequest_tbl WHERE loan_status='1' and loan_complete='1'");


while ($completerow=mysqli_fetch_array($completeloan)){?>  
<?php 
@$numcomplete = @$numcomplete + 1;
$completeloan_payment=$completerow['loan_amount'];
@$completeloan_paid=@$completeloan_paid + $completeloan_payment;
?>
<?php }?>


<?php 
$conn = mysqli_connect('localhost','root','','cooperative');
$paidloan = mysqli_query($conn,"SELECT * FROM loan_tbl");


while ($paidrow=mysqli_fetch_array($paidloan)){?>  
<?php 
$loan_paid=$paidrow['loan_payment'];
@$totalloan_paid=@$totalloan_paid + $loan_paid;
?>
<?php }?>


<?php $totalloan = @$activeloan_paid + @$completeloan_paid; ?>

 
 
 
 
<?php 

$saveselect = mysqli_query($conn,"SELECT * FROM savings_tbl");
while ($saverow=mysqli_fetch_array($saveselect)){?>  
<?php
$cust_savings=$saverow['cust_savings'];
@$cust_savingstotal = $cust_savingstotal + $cust_savings;
?>
<?php }?>


<?php 

$activemember = mysqli_query($conn,"SELECT * FROM personalinfo_tbl WHERE cust_status='1'");
while ($getactiverow=mysqli_fetch_array($activemember)){?>  
<?php
@$member_active = @$member_active + 1;
?>
<?php }?>

<?php 

$notmember = mysqli_query($conn,"SELECT * FROM personalinfo_tbl WHERE cust_status='0' or cust_status=''");
while ($getnotrow=mysqli_fetch_array($notmember)){?>  
<?php
@$member_not = @$member_not + 1;
?>
<?php }?>
       
<?php 

$expenses = mysqli_query($conn,"SELECT * FROM expenditure_tbl");
while ($expensesrow=mysqli_fetch_array($expenses)){?>  
<?php
$amount = $expensesrow['amount'];
@$totalexp=@$totalexp + $amount;
?>
<?php }?>
       
        <div id="form-content"><table width="100%" border="0">
        <tr style="background-image:url(expenditure.jpg); background-repeat:no-repeat">
        <td height="155"><p>&nbsp;</p>
          <p>&nbsp;</p>
          <p><table width="100%" border="0"><tr><td width="31%">&nbsp;</td>
          <td width="69%"><h5><strong>Active Members.</strong> <?php echo @$member_active; ?></h5> <h5><strong>Inactive Members.</strong> <?php echo @$member_not; ?></h5><h6><a href="members_detail.php">Click to View Members</a></h6> </td></tr></table></p></td>
        </tr>
        <tr style="background-image:url(savings.jpg); background-repeat:no-repeat">
        <td height="155"><p>&nbsp;</p>
          <p>&nbsp;</p>
          <p><table width="100%" border="0"><tr><td width="31%">&nbsp;</td>
          <td width="69%"><h5><strong>Total Savings.</strong> N <?php echo @$cust_savingstotal; ?></h5> <h6><a href="memberssavings_detail.php">Click to View Savings</a></h6> </td></tr></table></p></td>
        </tr>

        <tr style="background-image:url(spent.jpg); background-repeat:no-repeat">
        <td height="155"><p>&nbsp;</p>
          <p>&nbsp;</p>
          <p><table width="100%" border="0"><tr><td width="31%">&nbsp;</td>
          <td width="69%"><h5><strong>Amount.</strong> N <?php echo @$totalexp; ?></h5> <h6><a href="expenditure_edit.php">Click to Enter Expenditure</a></h6> </td></tr></table></p></td>
        </tr>

        <tr style="background-image:url(loan.jpg); background-repeat:no-repeat">
        <td height="155"><p>&nbsp;</p>
          <p>&nbsp;</p>
          <p><table width="100%" border="0"><tr><td width="31%">&nbsp;</td>
          <td width="69%"><h5><strong>Loan Out.</strong> N <?php echo @$activeloan_paid; ?></h5> <h5><strong>Paid Loan:</strong> N <?php echo @$totalloan_paid; ?></h5><h6><strong>Active Loan No.</strong> <?php echo @$numactive; ?>. <a href="membersloan_detail.php">Click to View Loans</a></h6> </td></tr></table></p></td>
        </tr>

        <tr style="background-image:url(income.jpg); background-repeat:no-repeat">
        <td height="155"><p>&nbsp;</p>
          <p>&nbsp;</p>
          <p><table width="100%" border="0"><tr><td width="31%">&nbsp;</td>
          <td width="69%"><h5><strong>Gross Income.</strong> N <?php echo @$totalloan_paid + @$cust_savingstotal; ?></h5> <h5><strong>Net Income:</strong> N <?php echo @$totalloan_paid + @$cust_savingstotal - @$totalexp; ?></h5></td></tr></table></p></td>
        </tr>

        <tr>
        <td height="50"><a href="home_admin.php">Click Here for Break down Details of the Above</a></td>
        </tr>
        </table>
        

</div>
    
    </div>
    
    </div>
    
    <script src="assets/jquery-1.11.3-jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    
</body>
</html>
<?php ob_end_flush(); ?>
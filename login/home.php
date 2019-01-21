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
<?php 
$conn = mysqli_connect('localhost','root','','cooperative');
$detailloan = mysqli_query($conn,"SELECT * FROM loanrequest_tbl WHERE cust_id='$userRow[userName]' and loan_complete='0' LIMIT 1");
$detailloan1 = mysqli_query($conn,"SELECT * FROM loanrequest_tbl WHERE cust_id='$userRow[userName]' and loan_complete='1' LIMIT 1");
$detailloan2 = mysqli_query($conn,"SELECT * FROM loanrequest_tbl WHERE cust_id='$userRow[userName]' and loan_status='0' LIMIT 1");

if (mysqli_num_rows($detailloan) > 0) 
{
$getloan=mysqli_fetch_array($detailloan);
$detail = mysqli_query($conn,"SELECT * FROM loan_tbl WHERE cust_id='$userRow[userName]' and loan_id='$getloan[loan_id]'");
} 
elseif (mysqli_num_rows($detailloan2) > 0) 
{
$message="NOT YET";	
}
else
{
$getloan=mysqli_fetch_array($detailloan1);
$detail = mysqli_query($conn,"SELECT * FROM loan_tbl WHERE cust_id='$userRow[userName]' and loan_id='$getloan[loan_id]'");
}

while ($detailfetch=mysqli_fetch_array($detail)){?>  
<?php
$loan_payment=$detailfetch['loan_payment'];
$payment_date=$detailfetch['payment_date'];
$payment_status=$detailfetch['payment_status'];
$loan_countnext=$detailfetch['loan_countnext'];
$loan_duration=$getloan['loan_duration'];

@$loan_paid=@$loan_paid + $loan_payment;
?>
 <?php }?>
<?php 

$detailb = mysqli_query($conn,"SELECT * FROM savings_tbl WHERE cust_id='$userRow[userName]'");
while ($detailfetchb=mysqli_fetch_array($detailb)){?>  
<?php
$cust_savings=$detailfetchb['cust_savings'];
@$cust_savingstotal = $cust_savingstotal + $cust_savings;
?>
<?php 
$savings_date=$detailfetchb['savings_date'];
$savings_status=$detailfetchb['savings_status'];
?> <?php }?>
<?php $divide=mysqli_query($conn,"SELECT * FROM dividend_tbl WHERE cust_id='$userRow[userName]' and div_class='loans' LIMIT 1"); 
$dividerow=mysqli_fetch_array($divide); ?>

<?php $divides=mysqli_query($conn,"SELECT * FROM dividend_tbl WHERE cust_id='$userRow[userName]' and div_class='savings' LIMIT 1"); 
$dividerows=mysqli_fetch_array($divides); ?>
       
        <div id="form-content"><table width="100%" border="0">
        <tr style="background-image:url(savings.jpg); background-repeat:no-repeat">
        <td height="155"><p>&nbsp;</p>
          <p>&nbsp;</p>
          <p><table width="100%" border="0"><tr><td width="31%">&nbsp;</td>
          <td width="69%"><h5>N <?php echo @$cust_savingstotal; ?></h5> <h6>Last Save: <?php echo @$savings_date; ?></h6> </td></tr></table></p></td>
        </tr>
        <tr style="background-image:url(loan.jpg); background-repeat:no-repeat">
        <td height="155"><p>&nbsp;</p>
          <p>&nbsp;</p>
          <p><table width="100%" border="0"><tr><td width="31%">&nbsp;</td>
          <td width="69%"><h5>N <?php echo @$loan_paid; ?></h5> <h6>Last Save: <?php echo @$payment_date; ?> / <?php echo @$loan_duration." "."installments left"; ?> </h6></td></tr></table></p></td>
        </tr>

        <tr style="background-image:url(diviend.jpg); background-repeat:no-repeat">
        <td height="155"><p>&nbsp;</p>
          <p>&nbsp;</p>
          <p><table width="100%" border="0"><tr><td width="31%">&nbsp;</td>
          <td width="69%"><h5>LOAN: N <?php echo @$dividerow['dividend']; ?></h5> <h6>Date Calculated: <?php echo @$dividerow['div_date']; ?> </h6><h5>SAVINGS: N <?php echo @$dividerows['dividend']; ?></h5> <h6>Date Calculated: <?php echo @$dividerows['div_date']; ?> </h6></td></tr></table></p></td>
        </tr>

        <tr>
        <td height="50"><a href="home_index.php">Click Here for Break down</a></td>
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
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
            <li><a href="g_histroy.php">History</a></li>
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
	<div class="container"><br>
	  <div id="form-content"><br>
	    <h4 align="center">GUARANTOR HISTORY DETAILS</h4><br><table width="100%" border="0" class="table table-striped">
  <tr>
    <td colspan="6">GUARANTY HISTORY</td>
    </tr>
  <tr>
    <td><strong>S/NO</strong></td>
    <td><strong>APPLICANT NAME</strong></td>
    <td><strong>SUBJECT</strong></td>
    <td><strong>AMOUNT</strong></td>
    <td><strong>YES</strong></td>
    <td><strong>NO</strong></td>
  </tr>
<?php 
$conn = mysqli_connect('localhost','root','','cooperative');
$detaila = mysqli_query($conn,"SELECT * FROM loanrequest_tbl WHERE loan_guarantor1='$userRow[userName]'");

$detailab = mysqli_query($conn,"SELECT * FROM loanrequest_tbl WHERE loan_guarantor2='$userRow[userName]'");

$detailac = mysqli_query($conn,"SELECT * FROM loanrequest_tbl WHERE loan_guarantor3='$userRow[userName]'");

while (($detailfetchc=mysqli_fetch_array($detailac)) or ($detailfetcha=mysqli_fetch_array($detaila)) or ($detailfetchab=mysqli_fetch_array($detailab)))

{?>  
<?php

$loan_guarantor1=$detailfetcha['loan_guarantor1'];
$lg1_status=$detailfetcha['lg1_status'];
$cust_id=$detailfetcha['cust_id'];
$loan_amount=$detailfetcha['loan_amount'];
$loan_id=$detailfetcha['loan_id'];

$custsave=mysqli_query($conn,"SELECT * FROM personalinfo_tbl WHERE cust_id='$cust_id'");
$custsavev=mysqli_fetch_array($custsave);
$cust_fname=$custsavev['cust_fname'];
$cust_oname=$custsavev['cust_oname'];
$cust_lname=$custsavev['cust_lname'];

?>

<?php

$loan_guarantor2b=@$detailfetchab['loan_guarantor2'];
$lg2_statusb=@$detailfetchab['lg2_status'];
$cust_idb=@$detailfetchab['cust_id'];
$loan_amountb=@$detailfetchab['loan_amount'];
$loan_idb=@$detailfetchab['loan_id'];

$custsaveb=mysqli_query($conn,"SELECT * FROM personalinfo_tbl WHERE cust_id='$cust_idb'");
$custsavevb=mysqli_fetch_array($custsaveb);
$cust_fnameb=$custsavevb['cust_fname'];
$cust_onameb=$custsavevb['cust_oname'];
$cust_lnameb=$custsavevb['cust_lname'];

?>

<?php

$loan_guarantor3c=@$detailfetchac['loan_guarantor3'];
$lg3_statusc=@$detailfetchac['lg3_status'];
$cust_idc=@$detailfetchac['cust_id'];
$loan_amountc=@$detailfetchac['loan_amount'];
$loan_idc=@$detailfetchac['loan_id'];

$custsavec=mysqli_query($conn,"SELECT * FROM personalinfo_tbl WHERE cust_id='$cust_idc'");
$custsavevc=mysqli_fetch_array($custsaveb);
$cust_fnamec=$custsavevc['cust_fname'];
$cust_onamec=$custsavevc['cust_oname'];
$cust_lnamec=$custsavevc['cust_lname'];

?>

<?php if ($loan_guarantor1==""){} else {?>
<tr>    

<td><?php @$no = @$no + 1; echo @$no; ?></td>
    <td><?php echo $cust_lname; ?> <?php echo $cust_fname; ?> <?php echo $cust_oname; ?></td>
    <td>LOAN</td>
    <td><?php echo $loan_amount; ?></td>
    <td><a href="g_edit.php?page=null&g1yes_id=<?php echo $loan_id; ?>">-|-</a></td>
    <td><a href="g_edit.php?page=null&g1no_id=<?php echo $loan_id; ?>">-|-</a></td>
  </tr>
 <?php }?>  
<?php if ($loan_guarantor2b==""){} else{?>
<tr>    

<td><?php @$no = @$no + 1; echo @$no; ?></td>
    <td><?php echo $cust_lnameb; ?> <?php echo $cust_fnameb; ?> <?php echo $cust_onameb; ?></td>
    <td>LOAN</td>
    <td><?php echo $loan_amountb; ?></td>
    <td><a href="g_edit.php?page=null&g2yes_id=<?php echo $loan_idb; ?>">-|-</a></td>
    <td><a href="g_edit.php?page=null&g2no_id=<?php echo $loan_idb; ?>">-|-</a></td>
  </tr>   <?php }?>  
 
<?php if ($loan_guarantor3c==""){} else{?>
<tr>    

<td><?php @$no = @$no + 1; echo @$no; ?></td>
    <td><?php echo $cust_lnamec; ?> <?php echo $cust_fnamec; ?> <?php echo $cust_onamec; ?></td>
    <td>LOAN</td>
    <td><?php echo $loan_amountc; ?></td>
    <td><a href="g_edit.php?page=null&g3yes_id=<?php echo $loan_idc; ?>">-|-</a></td>
    <td><a href="g_edit.php?page=null&g3no_id=<?php echo $loan_idc; ?>">-|-</a></td>
  </tr>   <?php }?>  
 <?php }?>
 
 
</table><br></div>
    
    </div>
    
    </div>
    
    <script src="assets/jquery-1.11.3-jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    
</body>
</html>
<?php ob_end_flush(); ?>

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


	$ress=mysqli_query($conn,"SELECT * FROM personalinfo_tbl WHERE cust_id='$userRow[userName]'");
	$userRows=mysqli_fetch_array($ress);

	
	$cust_fname = $userRows['cust_fname'];
	$cust_oname = $userRows['cust_oname'];
	$cust_lname = $userRows['cust_lname'];
	$cust_staffstatus = $userRows['cust_staffstatus'];
	$cust_healthstatus = $userRows['cust_healthstatus'];
	$cust_staffid = $userRows['cust_staffid'];
	$cust_nok = $userRows['cust_nok'];
	$cust_savings = $userRows['cust_savings'];
	$cust_nokrelationship = $userRows['cust_nokrelationship'];
	$cust_noknum = $userRows['cust_noknum'];
	$cust_school = $userRows['cust_school'];
	$cust_department = $userRows['cust_department'];

	@$pass=@mysqli_query($conn,"SELECT * FROM passport_tbl WHERE AppNumber='$userRow[userName]'");
	@$userPass=@mysqli_fetch_array($pass);
	
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

	
	<div class="col-lg-12">
	
		<div class="row"><div id="form-content">
		<br><?php $conn = mysqli_connect('localhost','root','','cooperative');
$customer = mysqli_query($conn,"SELECT * FROM loanrequest_tbl WHERE loan_id='$loan_id'");
$fcustomer=mysqli_fetch_array($customer);
$loan_guarantor1=$fcustomer['loan_guarantor1'];
$loan_guarantor2=$fcustomer['loan_guarantor2'];

$gua=mysqli_query($conn,"SELECT * FROM personalinfo_tbl WHERE cust_id='$loan_guarantor1'");
$gub=mysqli_query($conn,"SELECT * FROM personalinfo_tbl WHERE cust_id='$loan_guarantor2'");
$guaRow=mysqli_fetch_array($gua);
$gubRow=mysqli_fetch_array($gub);
$loan_guarantor1=$guaRow['cust_lname']." ".$guaRow['cust_fname']." ".$guaRow['cust_oname'];
$loan_guarantor2=$gubRow['cust_lname']." ".$gubRow['cust_fname']." ".$gubRow['cust_oname']; ?>
<table width="100%" border="0" class="table table-striped">
<tr>
<td><strong>Guarantor 1:</strong></td>
<td><?php echo $loan_guarantor1; ?></td>
</tr>
<tr>
<td><strong>Guarantor 2:</strong></td>
<td><?php echo $loan_guarantor2; ?></td>
</tr>
</table>
        <br>
		<h4 align="center">MEMBER LOAN DETAILS</h4><br>
			
<?php 
$conn = mysqli_connect('localhost','root','','cooperative');
$details= mysqli_query($conn,"SELECT * FROM loanrequest_tbl WHERE loan_id='$loan_id'"); 
$fetch=mysqli_fetch_array($details);
$loan_status=$fetch['loan_status'];
?>				<table width="100%" border="0" class="table table-striped">
  <tr>
    <td colspan="5">LOAN REPAYMENT TRANSACTIONS (Loan ID:<strong><?php echo $loan_id; ?></strong>)<br>Status: <?php if (($loan_status=='0') or ($loan_status=='')){echo "<span style='color:#F00'><strong>INACTIVE</strong></span>";} elseif ($loan_status=='1'){echo "<span style='color:#004400'><strong>ACTIVE</strong></span>";} else {echo"<span style='color:#000000'><strong>PENDING</strong></span>";} ?></td>
    </tr>
  <tr>
    <td><strong>Month</strong></td>
    <td><strong>Principal</strong></td>
    <td><strong>Interest</strong></td>
    <td><strong>Savings</strong></td>
    <td><strong>Deductions/Monthly</strong></td>
    <td><strong>Paid</strong></td>
  </tr>
<?php 
$conn = mysqli_connect('localhost','root','','cooperative');
$detail = mysqli_query($conn,"SELECT * FROM loanpayment_tbl WHERE loan_id='$loan_id'"); 
while ($detailfetch=mysqli_fetch_array($detail)){?>  
<?php
$period=$detailfetch['period'];
$principal=$detailfetch['principal'];
$interest=$detailfetch['interest'];
$savings=$detailfetch['savings'];
$status=$detailfetch['status'];
if ($status == 1){$status="Paid";}
$total=$detailfetch['total'];


?>
<?php  @$totalprincipal = @$totalprincipal + $principal; @$totalinterst = @$totalinterst + $interest; @$totalamount=@$totalamount + $total;?>
<tr>
    <td><?php echo $period; ?></td>
    <td><?php echo $principal; ?></td>
    <td><?php echo $interest; ?></td>
    <td><?php echo $savings; ?></td>
    <td><?php echo $total; ?></td>
    <td><?php echo $status; ?></td>
  </tr> <?php }?>
    <tr>
    <td width="12%"></td>
    <td width="22%"><strong><?php echo $totalprincipal; ?></strong></td>
    <td width="22%"><strong><?php echo $totalinterst; ?></strong></td>
    <td colspan="2"><strong>Total Loan Payment = <?php echo $totalamount; ?></strong></td>
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
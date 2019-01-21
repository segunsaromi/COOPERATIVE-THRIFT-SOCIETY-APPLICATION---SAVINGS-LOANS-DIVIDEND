
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
	$cust_nokrelationship = $userRows['cust_nokrelationship'];
	$cust_noknum = $userRows['cust_noknum'];
	$cust_school = $userRows['cust_school'];
	$cust_department = $userRows['cust_department'];

	@$pass=@mysqli_query($conn,"SELECT * FROM passport_tbl WHERE AppNumber='$userRow[userName]'");
	@$userPass=@mysqli_fetch_array($pass);
?>


<?php 

		@$loan_id = trim($_GET['loan_id']);
		@$loan_id = strip_tags($loan_id);
		@$loan_id = htmlspecialchars($loan_id);


$loanedit=mysqli_query($conn,"SELECT * FROM loanrequest_tbl WHERE loan_id='$loan_id'");
$loaneditget=mysqli_fetch_array($loanedit);



$loan_amount=$loaneditget['loan_amount'];
$loan_duration=$loaneditget['loan_duration'];
$loan_guarantor1=$loaneditget['loan_guarantor1'];
$loan_guarantor2=$loaneditget['loan_guarantor2'];
$loan_status=$loaneditget['loan_status'];
if ($loan_status == 1) {$loan_statusv="APPROVED";} elseif ($loan_status == 0) {$loan_statusv="DELCINED";} else {$loan_statusv="PENDING";}
$loan_date=$loaneditget['loan_date'];

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
   	  </div>	  <div class="col-lg-12">
	
		<div class="row">
		<br><h4 align="center">EDIT LOAN RECORD</h4><br>
			<div id="form-content">
			  <form method="post" id="reg-form" autocomplete="off">
			    
			    
			    
			    
			    
			    
			    
  <div class="form-group">							  <label>Loan ID - </label> <?php echo $loan_id; ?>
</div>
<div class="form-group">							  <label>Loan Date</label>

					<input type="hidden" name="loan_id" id="loan_id" value="<?php echo $playernumber; ?>">
					<input type="date" class="form-control" name="loan_date" id="lname" placeholder="<?php if (@$loan_date <> ""){echo @$loan_date;} else {echo "Enter Loan Date";}?>" value="<?php echo @$loan_date; ?>" required />
				</div>



<div class="form-group">							  <label>Loan Amount/Principal</label>

					<input type="text" onkeyup="this.value = this.value.toUpperCase();" pattern="^[A-Za-z0-9 -]+$" class="form-control" name="loan_amount" id="lname" placeholder="<?php if (@$loan_amount <> ""){echo @$loan_amount;} else {echo "Enter Loan Amount";}?>" value="<?php echo @$loan_amount; ?>" required />
				</div>

<div class="form-group">					
							  <label>Duration</label>
<select name="loan_duration" class="form-control" required>
  <option value="<?php if (@$loan_duration <> ""){echo @$loan_duration;} else {echo "";}?>" selected><?php if (@$loan_duration <> ""){echo @$loan_duration;} else {echo "Select Duration";}?></option>
  <option value="1">1</option>
  <option value="2">2</option>
  <option value="3">3</option>
  <option value="4">4</option>
  <option value="5">5</option>
  <option value="6">6</option>
  <option value="7">7</option>
  <option value="8">8</option>
  <option value="9">9</option>
  <option value="10">10</option>
  <option value="11">11</option>
  <option value="12">12</option>
  <option value="13">13</option>
  <option value="14">14</option>
  <option value="15">15</option>
  <option value="16">16</option>
  <option value="17">17</option>
  <option value="18">18</option>
  <option value="19">19</option>
  <option value="20">20</option>
  <option value="21">21</option>
  <option value="22">22</option>
  <option value="23">23</option>
  <option value="24">24</option>
</select>				
</div>
      

<div class="form-group">					
							  <label>Guarantor 1</label>
<select name="loan_guarantor1" class="form-control" required>
  <option value="<?php if (@$loan_guarantor1 <> ""){echo @$loan_guarantor1;} else {echo "";}?>" selected><?php if (@$loan_guarantor1 <> ""){echo @$loan_guarantor1;} else {echo "Select First Gaurantor";}?></option>
  <?php $memb=mysqli_query($conn,"SELECT * FROM personalinfo_tbl WHERE cust_status='1'"); while ($memRow=mysqli_fetch_array($memb)){?><option value="<?php echo $memRow['cust_id']; ?>"><?php echo $memRow['cust_lname']; ?> <?php echo $memRow['cust_fname']; ?> <?php echo $memRow['cust_oname']; ?></option><?php }?>
</select>				
</div>

<div class="form-group">					
							  <label>Guarantor 2</label>
<select name="loan_guarantor2" class="form-control" required>
  <option value="<?php if (@$loan_guarantor1 <> ""){echo @$loan_guarantor2;} else {echo "";}?>" selected><?php if (@$loan_guarantor2 <> ""){echo @$loan_guarantor2;} else {echo "Select Second Gaurantor";}?></option>
<?php $memb=mysqli_query($conn,"SELECT * FROM personalinfo_tbl WHERE cust_status='1'"); while ($memRow=mysqli_fetch_array($memb)){?><option value="<?php echo $memRow['cust_id']; ?>"><?php echo $memRow['cust_lname']; ?> <?php echo $memRow['cust_fname']; ?> <?php echo $memRow['cust_oname']; ?></option><?php }?>
</select>				
</div>   


<input name="loan_id" type="hidden" value="<?php echo $loan_id; ?>">
				
				
				<div class="form-group">
                <input name="loan_edit" type="checkbox" value="agree" required> I agree to Cooperative Terms and Condition
				</div>
				
				<hr />
				
				<div class="form-group">
					<button class="btn btn-primary">Submit/Save Details</button>
				</div>
			</form>
            
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
			url: 'customerloanupdate.php',
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
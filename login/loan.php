<?php 

require_once '../login/dbconnect.php';
// The length we want the unique reference number to be  
$unique_ref_length = 5;  
  
// A true/false variable that lets us know if we've  
// found a unique reference number or not  
$unique_ref_found = false;  
  
// Define possible characters.  
// Notice how characters that may be confused such  
// as the letter 'O' and the number zero don't exist  
$possible_chars = "0123456789";  
  
// Until we find a unique reference, keep generating new ones  
while (!$unique_ref_found) {  
  
    // Start with a blank reference number  
    $unique_ref = "";  
      
    // Set up a counter to keep track of how many characters have   
    // currently been added  
    $i = 0;  
      
    // Add random characters from $possible_chars to $unique_ref   
    // until $unique_ref_length is reached  
    while ($i < $unique_ref_length) {  
      
        // Pick a random character from the $possible_chars list  
        $char = substr($possible_chars, mt_rand(0, strlen($possible_chars)-1), 1);  
          
        $unique_ref .= $char;  
          
        $i++;  
      
    }  
      
    // Our new unique reference number is generated.  
    // Lets check if it exists or not 
		$con = mysqli_connect('localhost','root','','cooperative');
 
    $query = mysqli_query($con, "SELECT `loan_id` FROM ` loanrequest_tbl` 
              WHERE `cust_id`='".$unique_ref."'");  
    $result = @mysqli_query($query);  
    if (@mysqli_num_rows($result)==0) {  
      
        // We've found a unique number. Lets set the $unique_ref_found  
        // variable to true and exit the while loop  
        $unique_ref_found = true;  
      
    }  
  
}  
$playernumber = 'LID'.$unique_ref;
?>
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
	
		<div class="row">
		<br>
		<h4 align="center">LOAN APPLICATION FORM</h4><br>
			<div id="form-content">
			
			<form method="post" action="loansubmit.php" id="reg-form" autocomplete="off">
				
				






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
  <?php $querysel=mysqli_query($conn,"SELECT * FROM personalinfo_tbl WHERE cust_status='1'"); 
  while ($queryseen=mysqli_fetch_array($querysel)) {?>
  <option value="<?php echo $queryseen['cust_id']; ?>"><?php echo $queryseen['cust_lname']; echo " "; echo $queryseen['cust_fname']; echo " "; echo $queryseen['cust_oname'];   ?></option> <?php } ?>
</select>				
</div>

<div class="form-group">					
							  <label>Guarantor 2</label>
<select name="loan_guarantor2" class="form-control" required>
  <option value="<?php if (@$loan_guarantor2 <> ""){echo @$loan_guarantor2;} else {echo "";}?>" selected><?php if (@$loan_guarantor2 <> ""){echo @$loan_guarantor2;} else {echo "Select Second Gaurantor";}?></option>
  <?php $querysel=mysqli_query($conn,"SELECT * FROM personalinfo_tbl WHERE cust_status='1'"); 
  while ($queryseen=mysqli_fetch_array($querysel)) {?>
  <option value="<?php echo $queryseen['cust_id']; ?>"><?php echo $queryseen['cust_lname']; echo " "; echo $queryseen['cust_fname']; echo " "; echo $queryseen['cust_oname'];   ?></option> <?php } ?>
</select>				
</div>

<div class="form-group">					
							  <label>Guarantor 3</label>
<select name="loan_guarantor3" class="form-control" required>
  <option value="<?php if (@$loan_guarantor3 <> ""){echo @$loan_guarantor3;} else {echo "";}?>" selected><?php if (@$loan_guarantor3 <> ""){echo @$loan_guarantor3;} else {echo "Select Third Gaurantor";}?></option>
  <?php $querysel=mysqli_query($conn,"SELECT * FROM personalinfo_tbl WHERE cust_status='1'"); 
  while ($queryseen=mysqli_fetch_array($querysel)) {?> 
  <option value="<?php echo $queryseen['cust_id']; ?>"><?php echo $queryseen['cust_lname']; echo " "; echo $queryseen['cust_fname']; echo " "; echo $queryseen['cust_oname'];   ?></option> <?php } ?> 
</select>				
</div>        




				
				
				<div class="form-group">
                <input name="loan_agree" type="checkbox" value="agree"> I agree to Cooperative Terms and Condition
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
			url: 'loansubmit.php',
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
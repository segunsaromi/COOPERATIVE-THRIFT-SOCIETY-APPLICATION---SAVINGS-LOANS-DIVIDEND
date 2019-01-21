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
 
    $query = mysqli_query($con, "SELECT `savings_id` FROM ` savingamount_tbl` 
              WHERE `cust_id`='".$unique_ref."'");  
    $result = @mysqli_query($query);  
    if (@mysqli_num_rows($result)==0) {  
      
        // We've found a unique number. Lets set the $unique_ref_found  
        // variable to true and exit the while loop  
        $unique_ref_found = true;  
      
    }  
  
}  
$playernumber = 'SID'.$unique_ref;
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


	@$passave=@mysqli_query($conn,"SELECT * FROM savingamount_tbl WHERE cust_id='$userRow[userName]' ORDER BY SN DESC");
	@$userPassave=@mysqli_fetch_array($passave);
	if ($userPassave['savings_status'] == '0') {$cust_savings1 = $userPassave['cust_savings']." - "."NOT APPROVED"; $cust_savings = $userPassave['cust_savings'];} else {
	$cust_savings = $userPassave['cust_savings'];}

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
		<h4 align="center">MEMBERSHIP INFORMATION FORM</h4><br>
			<div id="form-content">
			
			<form method="post" id="reg-form" autocomplete="off">
				
				








<div class="form-group">					
							  <label>Staff Status</label>
<select name="cust_staffstatus" class="form-control" required>
  <option value="<?php if (@$cust_staffstatus <> ""){echo @$cust_staffstatus;} else {echo "";}?>" selected><?php if (@$cust_staffstatus <> ""){echo @$cust_staffstatus;} else {echo "Staff Status";}?></option>
  <option value="Teaching Staff">Teaching Staff</option>
  <option value="Non Teaching">Non Teaching</option>
</select>				
</div>

<div class="form-group">					
							  <label>Health Status</label>
<select name="cust_healthstatus" class="form-control" required>
  <option value="<?php if (@$cust_healthstatus <> ""){echo @$cust_healthstatus;} else {echo "";}?>" selected><?php if (@$cust_healthstatus <> ""){echo @$cust_healthstatus;} else {echo "Health Status";}?></option>
  <option value="Medical needs">Medical Needs</option>
  <option value="Non Medical Needs">Non Medical Needs</option>
</select>				
</div>
                
				<div class="form-group">							  <label>Staff Number</label>

					AD/R/S.<input type="text" onkeyup="this.value = this.value.toUpperCase();" pattern="[0-9].{3}" maxlength="4" class="form-control" name="cust_staffid" id="lname" placeholder="<?php if (@$cust_staffid <> ""){echo substr("@$cust_staffid",-4);} else {echo "Enter Last 4 digit of your staff number";}?>" value="<?php echo substr("@$cust_staffid",-4); ?>" required />
				</div>


				<div class="form-group">		<input name="savings_id" type="hidden" value="<?php echo $playernumber; ?>">					  <label>Monthly Savings (<?php echo @$cust_savings1; ?>)</label><input name="savings_date" type="hidden" value="<?php echo date('Y-m-d'); ?>">

					<input type="text" onkeyup="this.value = this.value.toUpperCase();" pattern="^[0-9 -]+$" class="form-control" name="cust_savings" id="lname" title="" placeholder="<?php if (@$cust_savings <> ""){echo @$cust_savings;} else {echo "Monthly Savings";}?>" value="<?php echo @$cust_savings; ?>" required />
				</div>



<div class="form-group">					
							  <label>Customer School</label>
<select name="cust_school" class="form-control" required>
  <option value="<?php if (@$cust_school <> ""){echo @$cust_school;} else {echo "";}?>" selected><?php if (@$cust_school <> ""){echo @$cust_school;} else {echo "Select School";}?></option>
  <option value="Technology">Technology</option>
  <option value="Science">Science</option>
  <option value="Environmental">Environmental</option>
  <option value="Liberal Studies">Liberal Studies</option>
  <option value="Management and Business Studies">Management and Business Studies</option>
  <option value="Art, Design and Printing">Art, Design and Printing</option>
  <option value="Technical Education">Technical Education</option>
  <option value="Engineering">Engineering</option>
</select>				
</div>


				<div class="form-group">							  <label>Customer Department</label>

					<input type="text" onkeyup="this.value = this.value.toUpperCase();" pattern="^[A-Za-z0-9 -]+$" class="form-control" name="cust_department" id="lname" placeholder="<?php if (@$cust_department <> ""){echo @$cust_department;} else {echo "Enter Staff Department";}?>" value="<?php echo @$cust_department; ?>" required />
				</div>


				<div class="form-group">
                <label>Next of Kin Record</label>
					<input type="text" onkeyup="this.value = this.value.toUpperCase();" pattern="^[A-Za-z -]+$" class="form-control" name="cust_nok" id="lname" placeholder="<?php if (@$cust_nok <> ""){echo @$cust_nok;} else {echo "Next of Kin Full Name";}?>" value="<?php echo @$cust_nok; ?>" required />
				</div>
				
				<div class="form-group">
					<input type="tel" pattern="[0-9].{10}" class="form-control" maxlength="11" name="cust_noknum" id="lname" value="<?php echo @$cust_noknum; ?>" placeholder="<?php if (@$cust_noknum <> ""){echo @$cust_noknum;} else {echo "Next of Kin Phone No";}?>" required />
				</div>
				
				
				<div class="form-group">
<select name="cust_nokrelationship" class="form-control" required>
  <option value="<?php if (@$cust_nokrelationship <> ""){echo @$cust_nokrelationship;} else {echo "";}?>" selected><?php if (@$cust_nokrelationship <> ""){echo @$cust_nokrelationship;} else {echo "Next of Kin Relationship";}?></option>
  <option value="Father">Father</option>
  <option value="Mother">Mother</option>
  <option value="Spouse">Spouse</option>
  <option value="Brother">Brother</option>
  <option value="Sister">Sister</option>
  <option value="Son">Son</option>
  <option value="Daughter">Daughter</option>
  <option value="Cousin">Cousin</option>
  <option value="Aunt">Aunt</option>
  <option value="Uncle">Uncle</option>
  <option value="Nephew">Nephew</option>
  <option value="Niece">Niece</option>
</select>					
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
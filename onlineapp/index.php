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
 
    $query = mysqli_query($con, "SELECT `cust_id` FROM `personalinfo_tbl` 
              WHERE `cust_id`='".$unique_ref."'");  
    $result = @mysqli_query($query);  
    if (@mysqli_num_rows($result)==0) {  
      
        // We've found a unique number. Lets set the $unique_ref_found  
        // variable to true and exit the while loop  
        $unique_ref_found = true;  
      
    }  
  
}  
$playernumber = 'YCT/ACA/COP/'.$unique_ref;
?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>COOPERATIVE APLICATION FORM</title>
<link rel="stylesheet" href="assets/css/bootstrap.min.css">
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
          <a class="navbar-brand" href="#">Yaba College of Technology</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="../onlineapp/index.php">Application Form</a></li>
            <li><a href="../login/index.php">Sign In</a></li>
            <li><a href="../login/register.php">Sign Up</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav> 


<div class="wrapper">
<div style="background-image:url(ccslogo/header.jpg); background-repeat:no-repeat center center; background-size:cover; height:150px"></div>
	
	<div class="container">
	
	<div class="page-header" align="center">
		<h4>
		<a target="_blank" href="#">
	  APPLICATION FORM</a> - COOPERATIVE &amp; THRIFT SOCIETY</h4>
	</div>
	
	<div class="col-lg-12">
	
		<div class="row">
		
			<div id="form-content">
			
			<form method="post" id="reg-form" autocomplete="off">

<input name="cust_date" type="hidden" value="<?php echo date("Y-m-d");?>">
				
 
<input name="cust_id" type="hidden" value="<?php echo "$playernumber"; ?>">
               
                
                
                
				<div class="form-group">
					<input type="text" onkeyup="this.value = this.value.toUpperCase();" pattern="[A-Za-z\\s]*" class="form-control" name="cust_fname" id="lname" placeholder="First Name" required />
				</div>

				<div class="form-group">
					<input type="text" onkeyup="this.value = this.value.toUpperCase();" pattern="[A-Za-z\\s]*" class="form-control" name="cust_oname" id="lname" placeholder="Other Name" required />
				</div>
				
				<div class="form-group">
					<input type="text" onkeyup="this.value = this.value.toUpperCase();" pattern="[A-Za-z\\s]*" class="form-control" name="cust_lname" id="lname" placeholder="Last Name" required />
				</div>

<div class="form-group">
<select name="cust_maritalstatus" id="lname" class="form-control" required>
  <option value="">Select Marital Status</option>
  <option value="Single">Single</option>
  <option value="Married">Married</option>
  <option value="Divorced">Divorced</option>
</select>				
</div>

<div class="form-group">
<select name="cust_gender" id="lname" class="form-control" required>
  <option value="">Select Sex</option>
  <option value="Male">Male</option>
  <option value="Female">Female</option>
</select>				
</div>
				
				<div class="form-group">
					<input type="cust_email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" class="form-control" name="cust_email" id="lname" placeholder="Your Mail" required />
				</div>
				
				<div class="form-group">
					<input type="tel" pattern="[0-9].{10}" maxlength="11" class="form-control" name="cust_phno" id="lname" placeholder="Phone No." required />
				</div>
				
				<hr />
				
				<div class="form-group">
					<button class="btn btn-primary"> Click to Proceed </button>
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
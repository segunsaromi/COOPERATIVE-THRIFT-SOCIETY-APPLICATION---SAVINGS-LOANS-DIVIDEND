<?php
	ob_start();
	session_start();
	if( isset($_SESSION['user'])!="" ){
		header("Location: home.php");
	}
	include_once 'dbconnect.php';

	$error = false;

	if ( isset($_POST['btn-signup']) ) {
		
		// clean user inputs to prevent sql injections
		$name = trim($_POST['name']);
		$name = strip_tags($name);
		$name = htmlspecialchars($name);
		
		$email = trim($_POST['email']);
		$email = strip_tags($email);
		$email = htmlspecialchars($email);
		
		$pass = trim($_POST['pass']);
		$pass = strip_tags($pass);
		$pass = htmlspecialchars($pass);

		$pass2 = trim($_POST['pass2']);
		$pass2 = strip_tags($pass2);
		$pass2 = htmlspecialchars($pass2);
		
		// basic name validation
		if (empty($name)) {
			$error = true;
			$nameError = "Please enter your Application Number.";
		} else if (strlen($name) <> 17) {
			$error = true;
			$nameError = "Application Number must have 17 Charactrs.";
		} 
		
		//basic email validation
		if (empty($email)) {
			$error = true;
			$emailError = "Please enter valid Phone Number.";
		} else {
			// check email exist or not
			$conn = mysqli_connect('localhost','root','','cooperative');
			$query = "SELECT * FROM personalinfo_tbl WHERE cust_phno='$email' and cust_id='$name'";
			$result = mysqli_query($conn,$query);
			$count = mysqli_num_rows($result);
			if($count!=1){
				$error = true;
				$errTyp = "danger";
				$emailError = "Provided a valid credential.";
				$errMSG = "Provided Phone Number does not exist with the Application Number entered.";
			}
		}
		
		$confirm = mysqli_query($conn,"SELECT * FROM payment_tbl WHERE cust_id='$name' and Status='1' ");
			if (mysqli_num_rows($confirm) < 1){
			$error = true;
			$errTyp = "danger";
			$paymentError = "INVALID APPLICATION NUMBER: <br>It is either your payment was not successful or you have not made payment. If you have made payment then try sign-up after 24 hours or send complaint to ccs.complaint@yabatech.edu.ng.";
			$errMSG = $paymentError;
			$nameError = "Please enter valid Application Number.";
		} 
		// password validation
		if (empty($pass)){
			$error = true;
			$passError = "Please enter password.";
		} else if(strlen($pass) < 6) {
			$error = true;
			$passError = "Password must have atleast 6 characters.";
		}
		
		if (empty($pass2)){
			$error = true;
			$passError2 = "Please confirm password.";
		} else if ($pass <> $pass2){
			$error = true;
			$passError2 = "Password does not match.";
		}

		$conf = mysqli_query($conn,"SELECT * FROM users WHERE userName='$name'");
		if (mysqli_num_rows($conf) == 1){
			$error = true;
			$errTyp = "danger";
			$errMSG = "This Application Number has already been registered. Proceed to Sign-in or/and Try Password recovery if you have forgotten your password";
		} 
		
		// password encrypt using SHA256();
		$password = hash('sha256', $pass);
		
		// if there's no error, continue to signup
		if( !$error ) {
			
			$query = "INSERT INTO users(userName,userEmail,userPass) VALUES('$name','$email','$password')";
			$res = mysqli_query($conn,$query) or die(mysqli_error($conn));
				
			if ($res) {
				$errTyp = "success";
				$errMSG = "Successfully registered, you may login now";
				unset($name);
				unset($email);
				unset($pass);
			} else {
				$errTyp = "danger";
				$errMSG = "Something went wrong, try again later...";	
			}	
				
		}
		
		
	}
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>COOPERATIVE SIGN UP FORM</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script> 
  <script src="assets/js/lga.js"></script>
<link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css"  />
<link rel="stylesheet" href="style.css" type="text/css" />
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
            <li><a href="../onlineapp/index.php">Application Form</a></li>
            <li><a href="../login/index.php">Sign In</a></li>
            <li class="active"><a href="../login/register.php">Sign Up</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav> 
<div style="background-image: url(../onlineapp/ccslogo/header.jpg); background-repeat: no-repeat center center; background-size: cover; height: 150px"></div>
<div class="container">

	<div id="login-form">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">
    
    	<div class="col-md-12">
        
        	<div class="form-group">
            	<h2 class="">Sign Up.</h2>
            </div>
        
        	<div class="form-group">
            	<hr />
            </div>
            
            <?php
			if ( isset($errMSG) ) {
				
				?>
				<div class="form-group">
            	<div class="alert alert-<?php echo ($errTyp=="success") ? "success" : $errTyp; ?>">
				<span class="glyphicon glyphicon-info-sign"></span> <?php echo @$errMSG; ?>
                </div>
            	</div>
                <?php
			}
			?>
            
            <div class="form-group">
            	<div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
            	<input type="text" required pattern="YCT/ACA/COP/.+[0-9]{4}" name="name" onkeyup="this.value = this.value.toUpperCase();" class="form-control" placeholder="Your Cooperative Number (e.g. YCT/ACA/COP/XXXXX)" value="<?php echo @$name; ?>" maxlength="17" />
                </div>
                <span class="text-danger"><?php echo @$nameError; ?></span>
            </div>
            
            <div class="form-group">
            	<div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-phone"></span></span>
            	<input type="tel" pattern="[0-9].{10}" class="form-control" name="email" id="lname" placeholder="Enter Your Phone Number (11 Digits)" value="<?php echo @$email ?>" maxlength="11" required />
                </div>
                <span class="text-danger"><?php echo @$emailError; ?></span>
            </div>
            
            <div class="form-group">
            	<div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
            	<input type="password" name="pass" class="form-control" placeholder="Enter New Password" required maxlength="15" />
                </div>
                <span class="text-danger"><?php echo @$passError; ?></span>
            </div>

            <div class="form-group">
            	<div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
            	<input type="password" name="pass2" class="form-control" placeholder="Confirm New Password" required maxlength="15" />
                </div>
                <span class="text-danger"><?php echo @$passError2; ?></span>
            </div>
            
            <div class="form-group">
            	<hr />
            </div>
            
            <div class="form-group">
            	<button type="submit" class="btn btn-block btn-primary" name="btn-signup">Sign Up</button>
            </div>
            
            <div class="form-group">
            	<hr />
            </div>
            
            <div class="form-group">
            	<a href="index.php">Sign in Here...</a>
            </div>
        
        </div>
   
    </form>
    </div>	

</div>

</body>
</html>
<?php ob_end_flush(); ?>
<?php
	ob_start();
	session_start();
	require_once 'dbconnect.php';
	
	// it will never let you open index(login) page if session is set
	if ( isset($_SESSION['user'])!="" ) {
		header("Location: home.php");
		exit;
	}
	if ( isset($_SESSION['admin'])!="" ) {
		header("Location: admin_detail.php");
		exit;
	}
	
	$error = false;
	
	if( isset($_POST['btn-login']) ) {	
		
		// prevent sql injections/ clear user invalid inputs
		$email = trim($_POST['email']);
		$email = strip_tags($email);
		$email = htmlspecialchars($email);
		
		$pass = trim($_POST['pass']);
		$pass = strip_tags($pass);
		$pass = htmlspecialchars($pass);
		// prevent sql injections / clear user invalid inputs
		
		if(empty($email)){
			$error = true;
			$emailError = "Please enter a valid Application Number.";
		} 
		
		if(empty($pass)){
			$error = true;
			$passError = "Please enter your password.";
		}
		
		//Check if payment is successful
				$con = mysqli_connect('localhost','root','','cooperative');

		$check=mysqli_query($conn, "SELECT * FROM users WHERE userName='$email'");	
		$confirm = mysqli_query($conn,"SELECT * FROM payment_tbl WHERE cust_id='$email' and Status='1' ");
			if (mysqli_num_rows($confirm) < 1){
			$error = true;
			$paymentError = "LOGIN ALERT!!! <br>It is either your payment with this Application Number was not successful or you have not made payment. If you have made payment then try re-login after 24 hours or send complaint to ccs.complaint@yabatech.edu.ng.";
			$errMSG = $paymentError;
			}
			
			elseif ((mysqli_num_rows($confirm) > 0) and (mysqli_num_rows($check) < 1)){
			$error = true;
			$paymentError = "INVALID LOGIN CREDENTIALS: <br><strong>CONGRATULATIONS</strong>!!! Your Payment is <strong>SUCCESSFULL</strong> but you would have to sign up to enter a password before you can login. Click the <strong>'Sign Up Here'</strong> link below to Sign Up before you can login here";
			$errMSG = $paymentError;
			} else {
				$errMSG = "Incorrect Credentials, Try again...";
			}


		// if there's no error, continue to login
		if (!$error) {
			
			$password = hash('sha256', $pass); // password hashing using SHA256
		
			$res=mysqli_query($conn,"SELECT * FROM users WHERE userName='$email'");
			$row=mysqli_fetch_array($res);
			$count = mysqli_num_rows($res); // if uname/pass correct it returns must be 1 row

			$admin=mysqli_query($conn,"SELECT * FROM coop_admin WHERE cust_id='$email' and level='admin'");
			//$adminrow = mysqli_fetch_array($admin); // if uname/pass correct it returns must be 1 row

			if( ($count == 1) && ($row['userPass']==$password) && (mysqli_num_rows($admin) > 0) ) {
				$_SESSION['admin'] = $row['userId'];
				header("Location: admin_detail.php");}
			 elseif( ($count == 1) && ($row['userPass']==$password) && (mysqli_num_rows($admin) == 0)) {
				$_SESSION['user'] = $row['userId'];
				header("Location: home.php");
			} else {
				$errMSG = "Incorrect Credentials, Try again...";
			}
				
		}
		
	}
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>COOPERATIVE SIGN IN FORM</title>
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
          <a class="navbar-brand" href="#">YCT Staff Cooperative Multipurpose Society Ltd.</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li><a href="../onlineapp/index.php">Application Form</a></li>
            <li class="active"><a href="../login/index.php">Sign In</a></li>
            <li><a href="../login/register.php">Sign Up</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav> 
<div style="background-image:url(../onlineapp/ccslogo/header.jpg); background-repeat:no-repeat center center; background-size:cover; height:150px"></div>
<div class="container">
	<div id="login-form">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">
    
    	<div class="col-md-12">
        
        	<div class="form-group">
            	<h2 class="">Sign In.</h2>
            </div>
        
        	<div class="form-group">
            	<hr />
            </div>
            
            <?php
			if ( isset($errMSG) ) {
				
				?>
				<div class="form-group">
            	<div class="alert alert-danger">
				<span class="glyphicon glyphicon-info-sign"></span> <?php echo $errMSG; ?>
                </div>
            	</div>
                <?php
			}
			?>
            
            <div class="form-group">
            	<div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
            	<input type="text" required pattern="YCT/ACA/COP/.+[0-9]{4}" name="email" onkeyup="this.value = this.value.toUpperCase();" class="form-control" placeholder="Your Cooperative Number (e.g. YCT/ACA/COP/XXXXX)" value="<?php echo @$email; ?>" maxlength="17" />
                </div>
                <span class="text-danger"><?php echo @$emailError; ?></span>
            </div>
            
            <div class="form-group">
            	<div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
            	<input type="password" required name="pass" class="form-control" placeholder="Your Password" maxlength="15" />
                </div>
                <span class="text-danger"><?php echo @$passError; ?></span>
            </div>
            
            <div class="form-group">
            	<hr />
            </div>
            
            <div class="form-group">
            	<button type="submit" class="btn btn-block btn-primary" name="btn-login">Sign In</button>
            </div>
            
            <div class="form-group">
            	<hr />
            </div>
            
            <div class="form-group">
            	<a href="register.php">Sign Up Here...</a>
            </div>
        
        </div>
   
    </form>
    </div>	

</div>

</body>
</html>
<?php ob_end_flush(); ?>
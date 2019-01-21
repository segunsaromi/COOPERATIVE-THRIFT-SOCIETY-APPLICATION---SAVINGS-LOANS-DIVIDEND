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
	$conn = mysqli_connect('localhost','root','','ccsapplicationdb');
	$res=mysqli_query($conn,"SELECT * FROM users WHERE userId=".$_SESSION['user']);
	$userRow=mysqli_fetch_array($res);
	$app=mysqli_query($conn,"SELECT * FROM submit_tbl WHERE AppNumber='$userRow[userName]' and Submit='1'");
	if (mysqli_num_rows($app) > 0){header("Location: complete.php");
	exit;}
	?>
    
    
	<?php if  ($_POST){
		if ($_POST['final'] == 'final'){
			$query2 = "UPDATE submit_tbl SET Submit = '1' WHERE AppNumber='$userRow[userName]'";
			$res2 = mysqli_query($conn,$query2);
			header("Location: index.php"); 

		}
		else { 		

			
		}
		
		
		}?>
	
	

	
	
	
<?php ob_end_flush(); ?>	
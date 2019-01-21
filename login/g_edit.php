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

		@$g1yes_id = trim($_GET['g1yes_id']);
		@$g1yes_id = strip_tags($g1yes_id);
		@$g1yes_id = htmlspecialchars($g1yes_id);

		@$g1no_id = trim($_GET['g1no_id']);
		@$g1no_id = strip_tags($g1no_id);
		@$g1no_id = htmlspecialchars($g1no_id);

		@$g2yes_id = trim($_GET['g2yes_id']);
		@$g2yes_id = strip_tags($g2yes_id);
		@$g2yes_id = htmlspecialchars($g2yes_id);

		@$g2no_id = trim($_GET['g2no_id']);
		@$g2no_id = strip_tags($g2no_id);
		@$g2no_id = htmlspecialchars($g2no_id);

		@$g3yes_id = trim($_GET['g3yes_id']);
		@$g3yes_id = strip_tags($g3yes_id);
		@$g3yes_id = htmlspecialchars($g3yes_id);

		@$g3no_id = trim($_GET['g3no_id']);
		@$g3no_id = strip_tags($g3no_id);
		@$g3no_id = htmlspecialchars($g3no_id);

if($g1yes_id<>"" ){
	
$queryedit = mysqli_query($conn,"UPDATE loanrequest_tbl SET lg1_status=1 WHERE loan_id='$g1yes_id'");

	}
elseif ($g1no_id<>"" ){	

$queryedit = mysqli_query($conn,"UPDATE loanrequest_tbl SET lg1_status=0 WHERE loan_id='$g1no_id'");
	
}
elseif ($g2yes_id<>""){
		
$queryedit = mysqli_query($conn,"UPDATE loanrequest_tbl SET lg2_status=1 WHERE loan_id='$g2yes_id'");
	
}
elseif ($g2no_id<>""){
		
$queryedit = mysqli_query($conn,"UPDATE loanrequest_tbl SET lg2_status=0 WHERE loan_id='$g2no_id'");

}

elseif ($g3yes_id<>""){
		
$queryedit = mysqli_query($conn,"UPDATE loanrequest_tbl SET lg3_status=1 WHERE loan_id='$g3yes_id'");
	
}
else {
		
$queryedit = mysqli_query($conn,"UPDATE loanrequest_tbl SET lg3_status=0 WHERE loan_id='$g3no_id'");

}
header('Location: g_history.php');

?>

<?php
	ob_start();
	session_start();
	require_once 'dbconnect.php';
	
	// if session is not set this will redirect to login page
	if( !isset($_SESSION['admin']) ) {
		header("Location: index.php");
		exit;
	}
	// select loggedin users detail
	$conn = mysqli_connect('localhost','root','','cooperative');
	$res=mysqli_query($conn,"SELECT * FROM users WHERE userId=".$_SESSION['admin']);
	$userRow=mysqli_fetch_array($res);


	$ress=mysqli_query($conn,"SELECT * FROM personalinfo_tbl WHERE cust_id='$userRow[userName]'");
	$userRows=mysqli_fetch_array($ress);

	
	
		@$exp_id = trim($_GET['exp_id']);
		@$exp_id = strip_tags($exp_id);
		@$exp_id = htmlspecialchars($exp_id);

?>

<?php

if ($exp_id <> "")
{
	
$query=mysqli_query($conn,"DELETE FROM expenditure_tbl WHERE exp_id='$exp_id'");	
if ($query)
{
	
echo "<script type='text/javascript'>alert('Expenditure with $exp_id has been deleted Successfully!!');</script>
</body>";
header('Location: expenditure.php');	
}
	
	
}


?>
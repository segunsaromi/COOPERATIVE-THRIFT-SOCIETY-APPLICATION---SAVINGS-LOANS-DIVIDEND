
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

	
	
		@$inc_id = trim($_GET['inc_id']);
		@$inc_id = strip_tags($inc_id);
		@$inc_id = htmlspecialchars($inc_id);

?>

<?php

if ($inc_id <> "")
{
	
$query=mysqli_query($conn,"DELETE FROM income_tbl WHERE inc_id='$inc_id'");	
if ($query)
{
	
echo "<script type='text/javascript'>alert('Income with $inc_id has been deleted Successfully!!');</script>
</body>";
header('Location: income_edit.php');	
}
	
	
}


?>
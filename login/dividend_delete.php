
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

	
	
		@$div_id = trim($_GET['div_id']);
		@$div_id = strip_tags($div_id);
		@$div_id = htmlspecialchars($div_id);

?>

<?php

if ($div_id <> "")
{
	
$query=mysqli_query($conn,"DELETE FROM dividend_tbl WHERE div_id='$div_id'");	
$query1=mysqli_query($conn,"UPDATE loanpayment_tbl SET dividend='0' WHERE div_id='$div_id'");
$query2=mysqli_query($conn,"UPDATE loan_tbl SET dividend='0' WHERE div_id='$div_id'");
$query3=mysqli_query($conn,"UPDATE savings_tbl SET dividend='0' WHERE div_id='$div_id'"); 
$query4=mysqli_query($conn,"UPDATE income_tbl SET dividendsavings='0' WHERE div_idsave='$div_id'"); 
$query5=mysqli_query($conn,"UPDATE expenditure_tbl SET dividendsavings='0' WHERE div_idsave='$div_id'"); 
$query6=mysqli_query($conn,"UPDATE income_tbl SET dividendloans='0' WHERE div_idloan='$div_id'"); 
$query7=mysqli_query($conn,"UPDATE expenditure_tbl SET dividendloans='0' WHERE div_idloan='$div_id'"); 
if ($query)
{
	
echo "<script type='text/javascript'>alert('Dividend with $div_id has been deleted Successfully!!');</script>
</body>";
header('Location: dividend_edit.php');	
}
	
	
}


?>
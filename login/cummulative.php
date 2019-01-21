<?php
	ob_start();
	session_start();
	require_once 'dbconnect.php';
	// if session is not set this will redirect to login page
	if( !isset($_SESSION['admin']) ) {
		header("Location: index.php");
		exit;
	}
	$conn = mysqli_connect('localhost','root','','cooperative');

	// select loggedin users detail
	$conn = mysqli_connect('localhost','root','','cooperative');
	$res=mysqli_query($conn,"SELECT * FROM users WHERE userId=".$_SESSION['admin']);
	$userRow=mysqli_fetch_array($res);

?>


<?php 
$conn = mysqli_connect('localhost','root','','cooperative');
$activeloan = mysqli_query($conn,"SELECT * FROM loanrequest_tbl WHERE loan_status='1'");


while ($activerow=mysqli_fetch_array($activeloan)){?>  
<?php 
$activeloan_payment=$activerow['loan_amount'];
@$activeloan_paid=@$activeloan_paid + $activeloan_payment;
?>
<?php }?>

<?php 
$active = mysqli_query($conn,"SELECT * FROM loanrequest_tbl WHERE loan_status='1' and loan_complete='0'");


while ($activero=mysqli_fetch_array($active)){?>  
<?php 
@$numactive = @$numactive + 1;
?>
<?php }?>


<?php 
$conn = mysqli_connect('localhost','root','','cooperative');
$completeloan = mysqli_query($conn,"SELECT * FROM loanrequest_tbl WHERE loan_status='1' and loan_complete='1'");


while ($completerow=mysqli_fetch_array($completeloan)){?>  
<?php 
@$numcomplete = @$numcomplete + 1;
$completeloan_payment=$completerow['loan_amount'];
@$completeloan_paid=@$completeloan_paid + $completeloan_payment;
?>
<?php }?>


<?php 
$conn = mysqli_connect('localhost','root','','cooperative');
$paidloan = mysqli_query($conn,"SELECT * FROM loan_tbl");


while ($paidrow=mysqli_fetch_array($paidloan)){?>  
<?php 
$loan_paid=$paidrow['loan_payment'];
@$totalloan_paid=@$totalloan_paid + $loan_paid;
?>
<?php }?>


<?php $totalloan = $activeloan_paid + $completeloan_paid; ?>

 
 
 
 
<?php 

$saveselect = mysqli_query($conn,"SELECT * FROM savings_tbl");
while ($saverow=mysqli_fetch_array($saveselect)){?>  
<?php
$cust_savings=$saverow['cust_savings'];
@$cust_savingstotal = $cust_savingstotal + $cust_savings;
?>
<?php }?>


<?php 

$activemember = mysqli_query($conn,"SELECT * FROM personalinfo_tbl WHERE cust_status='1'");
while ($getactiverow=mysqli_fetch_array($activemember)){?>  
<?php
@$member_active = @$member_active + 1;
?>
<?php }?>

<?php 

$notmember = mysqli_query($conn,"SELECT * FROM personalinfo_tbl WHERE cust_status='1'");
while ($getnotrow=mysqli_fetch_array($notmember)){?>  
<?php
@$member_not = @$member_not + 1;
?>
<?php }?>
       
<?php 

$expenses = mysqli_query($conn,"SELECT * FROM expenditure_tbl");
while ($expensesrow=mysqli_fetch_array($expenses)){?>  
<?php
$amount = $expensesrow['amount'];
@$totalexp=@$totalexp + $amount;
?>
<?php }?>

<?php 

$profitview = mysqli_query($conn,"SELECT * FROM loanpayment_tbl");
while ($profitrow=mysqli_fetch_array($profitview)){?>  
<?php
$interest = $profitrow['interest'];
@$totalinterest=@$totalinterest + $interest;
?>
<?php }?>

<?php
$totalmoneysaved=$cust_savingstotal;
$totalloanpaid=$totalloan_paid;
$netincome=@$interest - @$totalexp;
echo $netincome;
echo "<br>";
echo $netincome * 0.6;
echo "<br>";
echo ($netincome * 0.6)/$cust_savingstotal;
echo "<br>";
echo (($netincome * 0.6)/$cust_savingstotal)*52000;
?>



<?php ob_end_flush(); ?>
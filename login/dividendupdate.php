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



if( $_POST ){

		$div_class = trim($_POST['div_class']);
		$div_class = strip_tags($div_class);
		$div_class = htmlspecialchars($div_class);



	$ress=mysqli_query($conn,"SELECT * FROM personalinfo_tbl WHERE cust_id='$userRow[userName]'");
	$userRows=mysqli_fetch_array($ress);


	?>
    

<?php 

$profitview = mysqli_query($conn,"SELECT * FROM loanpayment_tbl WHERE dividend='0' and status='1'");
while ($profitrow=mysqli_fetch_array($profitview)){?>  
<?php
$interest = $profitrow['interest'];
@$totalinterest=@$totalinterest + $interest;
?>
<?php }?>



<?php 

$saveselect = mysqli_query($conn,"SELECT * FROM savings_tbl WHERE dividend='0'");
while ($saverow=mysqli_fetch_array($saveselect)){?>  
<?php
$allcust_savings=$saverow['cust_savings'];
@$cust_totalsavings = $cust_totalsavings + $allcust_savings;
?>
<?php }?>



<?php 

$loanselect = mysqli_query($conn,"SELECT * FROM loan_tbl WHERE dividend='0'") or die(mysqli_error($conn));
while ($loanrow=mysqli_fetch_array($loanselect)){?>  
<?php
$allcust_loan=$loanrow['loan_payment'];
@$cust_totalloan = $cust_totalloan + $allcust_loan;
?>
<?php }?>


<?php 

$incomeselectloan = mysqli_query($conn,"SELECT * FROM income_tbl WHERE dividendloans='0'") or die(mysqli_error($conn));
while ($incomerowloan=mysqli_fetch_array($incomeselectloan)){?>  
<?php
$incomeamountloan=$incomerowloan['amount'];
@$cop_totalincomeloan = $cop_totalincomeloan + $incomeamountloan;
?>
<?php }?>


<?php 

$expselectloan = mysqli_query($conn,"SELECT * FROM expenditure_tbl WHERE dividendloans='0'");
while ($exprowloan=mysqli_fetch_array($expselectloan)){
$expamountloan=$exprowloan['amount'];
@$cop_totalexploan = $cop_totalexploan + $expamountlon;
}?>





<?php 

$incomeselectsave = mysqli_query($conn,"SELECT * FROM income_tbl WHERE dividendsavings='0'") or die(mysqli_error($conn));
while ($incomerowsave=mysqli_fetch_array($incomeselectsave)){
$incomeamountsave=$incomerowsave['amount'];
@$cop_totalincomesave = $cop_totalincomesave + $incomeamountsave;
}
?>


<?php 

$expselectsave = mysqli_query($conn,"SELECT * FROM expenditure_tbl WHERE dividendsavings='0'");
while ($exprowsave=mysqli_fetch_array($expselectsave)){
$expamountsave=$exprowsave['amount'];
@$cop_totalexpsave = $cop_totalexpsave + $expamountsave;
 }?>











<?php


if ($_POST['div_class'] == 'savings'){
		$div_id = trim($_POST['div_id']);
		$div_id = strip_tags($div_id);
		$div_id = htmlspecialchars($div_id);

		$div_date = trim($_POST['div_date']);
		$div_date = strip_tags($div_date);
		$div_date = htmlspecialchars($div_date);


$netincome=@$totalinterest + $cop_totalincomesave - @$cop_totalexpsave; 




$query=mysqli_query($conn,"SELECT * FROM personalinfo_tbl WHERE cust_status='1'");
while($queryrow=mysqli_fetch_array($query))
{
@$custid_total=0;
$savingsportion=0;
$divcalc=0;
$dividend=0;

$cust_id=$queryrow['cust_id'];	
$detail= mysqli_query($conn,"SELECT * FROM savings_tbl WHERE cust_id='$cust_id' and dividend='0'") or die(mysqli_error($conn));
if (mysqli_num_rows($detail) > 0){
while ($fetchid=mysqli_fetch_array($detail)){
$savings_id=$fetchid['savings_id'];
	
$cust_savings=$fetchid['cust_savings'];
@$custid_total = $custid_total + $cust_savings;
$SN=$fetchid['SN'];
	
	}  
$savingsportion=$netincome*0.6;
$divcalc=$savingsportion/$cust_totalsavings;
$dividend=$divcalc*$custid_total;

$querydiv=mysqli_query($conn,"INSERT INTO dividend_tbl (div_id,div_class,cust_id,dividend,last_calc,div_date) values ('$div_id','$div_class','$cust_id','$dividend','$SN','$div_date')");

if ($querydiv){$queryup=mysqli_query($conn,"UPDATE savings_tbl SET dividend='1',div_id='$div_id' WHERE cust_id='$cust_id'") or die(mysqli_error($conn));
$queryupa=mysqli_query($conn,"UPDATE income_tbl SET dividendsavings='1',div_idsave='$div_id'") or die(mysqli_error($conn));
$queryupa=mysqli_query($conn,"UPDATE expenditure_tbl SET dividendsavings='1',div_idsave='$div_id'") or die(mysqli_error($conn));  }
	}}
}
?>




<?php


if ($_POST['div_class'] == 'loans'){
		$div_id = trim($_POST['div_id']);
		$div_id = strip_tags($div_id);
		$div_id = htmlspecialchars($div_id);

		$div_date = trim($_POST['div_date']);
		$div_date = strip_tags($div_date);
		$div_date = htmlspecialchars($div_date);

$netincome=@$totalinterest + $cop_totalincomeloan - @$cop_totalexploan; 


$query=mysqli_query($conn,"SELECT * FROM personalinfo_tbl WHERE cust_status='1'");
while($queryrow=mysqli_fetch_array($query))
{
	@$custid_total=0;
	$savingsportion=0;
$divcalc=0;
$dividend=0;

$cust_id=$queryrow['cust_id'];	
$detail= mysqli_query($conn,"SELECT * FROM loan_tbl WHERE cust_id='$cust_id' and dividend='0'") or die(mysqli_error($conn));
if (mysqli_num_rows($detail) > 0){
while ($fetchid=mysqli_fetch_array($detail)){
	
$loan_payment=$fetchid['loan_payment'];
@$custid_total = $custid_total + $loan_payment;
$SN=$fetchid['SN'];
	
	}  

$loanportion=$netincome*0.4;
$divcalc=$loanportion/$cust_totalloan;
$dividend=$divcalc*$custid_total;

//echo $custid_total."-"; echo "<br>";
//echo $loanportion."-"; echo "<br>";
//echo $divcalc."-"; echo "<br>";
//echo $dividend."-"; echo "<br>";
//echo "<br>";echo "<br>";echo "<br>";
$querydiv=mysqli_query($conn,"INSERT INTO dividend_tbl (div_id,div_class,cust_id,dividend,last_calc,div_date) values ('$div_id','$div_class','$cust_id','$dividend','$SN','$div_date')");
if ($querydiv){
$queryupa=mysqli_query($conn,"UPDATE loan_tbl SET dividend='1',div_id='$div_id' WHERE cust_id='$cust_id'") or die(mysqli_error($conn));
$queryupb=mysqli_query($conn,"UPDATE loanpayment_tbl SET dividend='1',div_id='$div_id' WHERE cust_id='$cust_id' and status='1'") or die(mysqli_error($conn));
$queryupa=mysqli_query($conn,"UPDATE income_tbl SET dividendloans='1',div_idloan='$div_id'") or die(mysqli_error($conn));
$queryupa=mysqli_query($conn,"UPDATE expenditure_tbl SET dividendloans='1',div_idloan='$div_id'") or die(mysqli_error($conn)); }
	}}
}
?>






    <table width="100%" border="0" class="table table-striped">
    
    <tr>
    <td colspan="2">
    	<div class="alert alert-info">
    		<strong>Success</strong>, Dividend Has been calculated and shared successfully...
    	</div>
    </td>
    </tr>
   <head>
    <meta http-equiv="refresh" content="1;URL='dividend.php'">
    </head> 
<script src="assets/jquery-1.12.4-jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
    <?php
	
}
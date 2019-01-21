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
	
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>LETTER OF MANADATE</title>
</head>

<body><div>

<table width="700" border="0">
  <tr>
    <td><img name="banner" src="coopbanner.jpg" width="800" height="200" alt="" /></td>
  </tr>
  <tr>
    <td><p><strong>To</strong>:<br />
 The  Branch Manager,<br />
  First  Bank of Nigeria PLC<br />
  Jobowu, Lagos.</p>
  <p>&nbsp;</p>
<p>Dear Sir/Madam,</p>
<h6>&nbsp;</h6>
<h3 align="center"><strong>MANDATE TO PAY</strong></h3>
<p>&nbsp;</p>
<p>The following under listed members of the  above named Cooperative Society have been considered for a loan facility.  </p>
<p>Their  particulars with the amount approved for each person are as specified below.</p></td>
  </tr>
  <tr>
    <td><table width="750" border="1" align="center" cellpadding="0" cellspacing="0">
      <tr style="font:Georgia, 'Times New Roman', Times, serif; font-weight:bold; font-size:12px" align="center">
        <td width="36">S/No</td>
        <td width="236">NAME</td>
        <td width="139">AMOUNT TO BE TRANSFERED</td>
        <td width="126">BANK</td>
        <td width="73">BRANCH</td>
        <td width="126">ACCOUNT NUMBER</td>
      </tr>
   <?php 	$conn = mysqli_connect('localhost','root','','cooperative');
 $mandate=mysqli_query($conn, "SELECT * FROM loanrequest_tbl WHERE print_date='$_SESSION[dateo]' and loan_complete='1'"); 
while($mandate1=mysqli_fetch_array($mandate)){?>  
<?php 
$member=mysqli_query($conn, "SELECT * FROM personalinfo_tbl WHERE cust_id='$mandate1[cust_id]'"); 
$member1=mysqli_fetch_array($member); 
@$number=@$number + 1;
$bank=mysqli_query($conn, "SELECT * FROM bank_tbl WHERE cust_id='$mandate1[cust_id]'"); 
$bank1=mysqli_fetch_array($bank); 


?> 
<tr>
        <td height="30" align="center"><?php echo $number; ?></td>
        <td style="padding-left:5px;"><?php echo $member1['cust_lname']." ". $member1['cust_fname']." ". $member1['cust_oname']; ?></td>
        <td align="center"><?php echo $mandate1['loan_amount']; ?></td>
        <td align="center"><?php echo $bank1['bank_name']; ?></td>
        <td></td>
        <td align="center"><?php echo $bank1['acc_no']; ?></td>
      </tr><?php }?> 
    </table></td>
  </tr>
  <tr>
    <td><p>Thank you for the  anticipated cooperation and positive response.</p><br /><br /><br />
      <p><strong>AMAECHINA, I. O.</strong>           <strong>ADEKUNLE</strong><strong>, </strong><strong>O. O. A. (Mrs.)                   OKOLIE</strong><strong>, </strong><strong>N. P</strong><strong> </strong><br />
      (<em>President</em>)                               (<em>Secretary</em>)                                                       (<em>Treasurer</em>)</p></td>
  </tr>
</table>


</div>
</body>
</html>
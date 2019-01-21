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
<title>LETTER OF DEDUCTION</title>
</head>

<body><div>

<table width="700" border="0">
  <tr>
    <td><img name="banner" src="coopbanner.jpg" width="800" height="200" alt="" /></td>
  </tr>
  <tr>
    <td><p align="right"><?php echo date('Y-m-d'); ?><br />
    <p><strong>To</strong>:<br />
 The Bursar,<br />
  BURSARY UNIT<br />
 Yaba College of Technology,</p>
Yaba, Lagos.</p>
  <p>&nbsp;</p>
<p>Dear Sir/Madam,</p>
<h6>&nbsp;</h6>
<h3 align="center"><strong>RE: AUTHORITY TO MAKE DEDUCTION FROM SALARY</strong></h3>
<p>&nbsp;</p>
<p>The under listed member(s) of the society has/have completed either finished servicing the LOAN collected and wish to NOW  contribute monthly the amount as stipulated below, or is/are indicating interest to join as new members.  The deduction will commence from the month specified. </p></td>
  </tr>
  <tr>
    <td><table width="750" border="1" align="center" cellpadding="0" cellspacing="0">
      <tr style="font:Georgia, 'Times New Roman', Times, serif; font-weight:bold; font-size:12px" align="center">
        <td width="36">S/No</td>
        <td width="236">NAME</td>
        <td width="139">AMOUNT TO BE DEDUCTED</td>
        <td width="126">MONTH OF COMMENCEMENT</td>
        <td width="126">APPROVAL SIGNATURE (FROM CONTRIBUTOR)</td>
      </tr>
   <?php 	$conn = mysqli_connect('localhost','root','','cooperative');
 $mandate=mysqli_query($conn, "SELECT * FROM savingamount_tbl WHERE savings_status='1' and msg='0'"); 
while($mandate1=mysqli_fetch_array($mandate)){?>  
<?php 
$member=mysqli_query($conn, "SELECT * FROM personalinfo_tbl WHERE cust_id='$mandate1[cust_id]'"); 
$member1=mysqli_fetch_array($member); 
@$number=@$number + 1;
$bank=mysqli_query($conn, "SELECT * FROM bank_tbl WHERE cust_id='$mandate1[cust_id]'"); 
$bank1=mysqli_fetch_array($bank); 

$date=date('Y-m-d'); 
if ($mandate and $member and $bank){$msgquery=mysqli_query($conn,"UPDATE savingamount_tbl SET msg='1', print_date='$date' WHERE savings_status='1'");} 


?> 
<tr>
        <td height="30" align="center"><?php echo $number; ?></td>
        <td style="padding-left:5px;"><?php echo $member1['cust_lname']." ". $member1['cust_fname']." ". $member1['cust_oname']; ?></td>
        <td align="center"><?php echo $mandate1['cust_savings']; ?></td>
        <td align="center"><?php echo $mandate1['deduction_month']; ?></td>
        <td align="center"></td>
      </tr><?php }?> 
    </table></td>
  </tr>
  <tr>
    <td><p>Thanks for your anticipated cooperation.


</p><br /><br />
................................................<br />
      <p><strong>ADEKUNLE,  O. O. A. (Mrs.)</strong>           <br />
           (<em>Secretary</em>)                                                       </p></td>
  </tr>
</table>


</div>
</body>
</html>
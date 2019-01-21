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

		$cust_status = trim($_POST['cust_status']);
		$cust_status = strip_tags($cust_status);
		$cust_status = htmlspecialchars($cust_status);

		$cust_fname = trim($_POST['cust_fname']);
		$cust_fname = strip_tags($cust_fname);
		$cust_fname = htmlspecialchars($cust_fname);

		$cust_oname = trim($_POST['cust_oname']);
		$cust_oname = strip_tags($cust_oname);
		$cust_oname = htmlspecialchars($cust_oname);

		$cust_lname = trim($_POST['cust_lname']);
		$cust_lname = strip_tags($cust_lname);
		$cust_lname = htmlspecialchars($cust_lname);

		$cust_maritalstatus = trim($_POST['cust_maritalstatus']);
		$cust_maritalstatus = strip_tags($cust_maritalstatus);
		$cust_maritalstatus = htmlspecialchars($cust_maritalstatus);

		$cust_gender = trim($_POST['cust_gender']);
		$cust_gender = strip_tags($cust_gender);
		$cust_gender = htmlspecialchars($cust_gender);

		$cust_email = trim($_POST['cust_email']);
		$cust_email = strip_tags($cust_email);
		$cust_email = htmlspecialchars($cust_email);

		$cust_phno = trim($_POST['cust_phno']);
		$cust_phno = strip_tags($cust_phno);
		$cust_phno = htmlspecialchars($cust_phno);

		$cust_date = trim($_POST['cust_date']);
		$cust_date = strip_tags($cust_date);
		$cust_date = htmlspecialchars($cust_date);

		$cust_staffstatus = trim($_POST['cust_staffstatus']);
		$cust_staffstatus = strip_tags($cust_staffstatus);
		$cust_staffstatus = htmlspecialchars($cust_staffstatus);

		$cust_healthstatus = trim($_POST['cust_healthstatus']);
		$cust_healthstatus = strip_tags($cust_healthstatus);
		$cust_healthstatus = htmlspecialchars($cust_healthstatus);

		$cust_department = trim($_POST['cust_department']);
		$cust_department = strip_tags($cust_department);
		$cust_department = htmlspecialchars($cust_department);

		$cust_school = trim($_POST['cust_school']);
		$cust_school = strip_tags($cust_school);
		$cust_school = htmlspecialchars($cust_school);

		$cust_nokrelationship = trim($_POST['cust_nokrelationship']);
		$cust_nokrelationship = strip_tags($cust_nokrelationship);
		$cust_nokrelationship = htmlspecialchars($cust_nokrelationship);

		$cust_nok = trim($_POST['cust_nok']);
		$cust_nok = strip_tags($cust_nok);
		$cust_nok = htmlspecialchars($cust_nok);

		$cust_noknum = trim($_POST['cust_noknum']);
		$cust_noknum = strip_tags($cust_noknum);
		$cust_noknum = htmlspecialchars($cust_noknum);

		$cust_id = trim($_POST['cust_id']);
		$cust_id = strip_tags($cust_id);
		$cust_id = htmlspecialchars($cust_id);

		$cust_staffid = trim($_POST['cust_staffid']);
		$cust_staffid = strip_tags($cust_staffid);
		$cust_staffid = htmlspecialchars($cust_staffid);

			$query1 = "UPDATE customer_tbl SET cust_fname='$cust_fname', cust_oname='$cust_oname', cust_lname='$cust_lname', cust_maritalstatus='$cust_maritalstatus', cust_gender='$cust_gender', cust_email='$cust_email', cust_phno='$cust_phno', cust_date='$cust_date' WHERE cust_id='$cust_id'";
			$res1 = mysqli_query($conn,$query1);



			$query = "UPDATE personalinfo_tbl SET cust_fname='$cust_fname', cust_oname='$cust_oname', cust_lname='$cust_lname', cust_maritalstatus='$cust_maritalstatus', cust_gender='$cust_gender', cust_email='$cust_email', cust_phno='$cust_phno', cust_date='$cust_date', cust_status='$cust_status', cust_staffid='$cust_staffid', cust_staffstatus='$cust_staffstatus', cust_healthstatus='$cust_healthstatus', cust_school='$cust_school', cust_department='$cust_department', cust_nok='$cust_nok', cust_noknum='$cust_noknum', cust_nokrelationship='$cust_nokrelationship', cust_staffid='$cust_staffid' WHERE cust_id='$cust_id'";
			$res = mysqli_query($conn,$query);


	?>
    
	<form method="post" id="reg-form" autocomplete="off">
    <table width="100%" border="0" class="table table-striped">
    
    <tr>
    <td colspan="2">
    	<div class="alert alert-info">
    		<strong>Success</strong>, Verify Details Entered...
    	</div>
    </td>
    </tr>
    
    <tr>
    <td width="39%">Customer ID.</td>
    <td width="61%"><strong><?php echo $cust_id; ?></strong></td>
    </tr>

    <tr>
    <td width="39%">Customer Name.</td>
    <td width="61%"><strong><?php echo $cust_fname; ?> <?php echo $cust_oname; ?> <?php echo $cust_lname; ?></strong></td>
    </tr>

    <tr>
    <td width="39%">Marital Status.</td>
    <td width="61%"><strong><?php echo $cust_maritalstatus; ?></strong></td>
    </tr>

    <tr>
    <td width="39%">Gender.</td>
    <td width="61%"><strong><?php echo $cust_gender; ?></strong></td>
    </tr>

    <tr>
    <td width="39%">Email.</td>
    <td width="61%"><strong><?php echo $cust_email; ?></strong></td>
    </tr>

    <tr>
    <td width="39%">Phone Number.</td>
    <td width="61%"><strong><?php echo $cust_phno; ?></strong></td>
    </tr>

    <tr>
      <td width="39%">Entrant Date.</td>
      <td width="61%"><strong><?php echo $cust_date; ?></strong></td>
    </tr>

    <tr>
    <td width="39%">Staff Status.</td>
    <td width="61%"><strong><?php echo $cust_staffstatus; ?></strong></td>
    </tr>

    <tr>
    <td>Health Status</td>
    <td><strong><?php echo $cust_healthstatus; ?></strong></td>
    </tr>

    <tr>
    <td>School</td>
    <td><strong><?php echo $cust_school; ?></strong></td>
    </tr>

    <tr>
    <td>Department</td>
    <td><strong><?php echo $cust_department; ?> </strong></td>
    </tr>

    <tr>
    <td>Next of Kin</td>
    <td><strong><?php echo $cust_nok; ?> </strong></td>
    </tr>

    <tr>
    <td>Next of Kin Phone</td>
    <td><strong><?php echo $cust_noknum; ?></strong></td>
    </tr>
    
    <tr>
    <td>Next of Kin Relationship</td>
    <td><strong><?php echo $cust_nokrelationship; ?></strong></td>
    </tr>

    <tr>
    <td>Customer Status</td>
    <td><strong><?php if (($cust_status=='0') or ($cust_status=='')){echo "<span style='color:#F00'><strong>INACTIVE</strong></span>";} elseif ($cust_status=='1'){echo "<span style='color:#004400'><strong>ACTIVE</strong></span>";} else {echo"<span style='color:#000000'><strong>PENDING</strong></span>";} ?></strong></td>
    </tr>
    
    </table>
				<div class="form-group">
				  <a href="index.php"><button class="btn btn-primary" name="submit"> - RECORD VERIFIED - </button></a>
				</div>
				
			</form>
<script src="assets/jquery-1.12.4-jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>

    <?php
	
}
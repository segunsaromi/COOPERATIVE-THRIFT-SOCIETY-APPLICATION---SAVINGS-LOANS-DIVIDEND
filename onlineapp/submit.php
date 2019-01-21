<?php

if( $_POST ){
	
		$cust_id = trim($_POST['cust_id']);
		$cust_id = strip_tags($cust_id);
		$cust_id = htmlspecialchars($cust_id);

		$cust_date = trim($_POST['cust_date']);
		$cust_date = strip_tags($cust_date);
		$cust_date = htmlspecialchars($cust_date);

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

			$conn = mysqli_connect('localhost','root','','cooperative');

			$query = "INSERT INTO customer_tbl(cust_id,cust_fname,cust_oname,cust_lname,cust_maritalstatus,cust_gender,cust_email,cust_phno,cust_date) VALUES('$cust_id','$cust_fname','$cust_oname','$cust_lname','$cust_maritalstatus','$cust_gender','$cust_email','$cust_phno','$cust_date')";
			$res = mysqli_query($conn,$query);

			$query3 = "INSERT INTO personalinfo_tbl(cust_id,cust_fname,cust_oname,cust_lname,cust_maritalstatus,cust_gender,cust_email,cust_phno,cust_date) VALUES('$cust_id','$cust_fname','$cust_oname','$cust_lname','$cust_maritalstatus','$cust_gender','$cust_email','$cust_phno','$cust_date')";
			$res3 = mysqli_query($conn,$query3);
				
			$query2 = "INSERT INTO payment_tbl(cust_id,Status) VALUES('$cust_id','1')";
			$res2 = mysqli_query($conn,$query2);
	?>
    
	<form method="post" id="reg-form" autocomplete="off">
    <table width="100%" border="0" class="table table-striped">
    
    <tr>
    <td colspan="2">
    	<div class="alert alert-info">
    		<strong>Success</strong>, Customer Successfully Applied...
    	</div>
    </td>
    </tr>
    
    <tr>
    <td>Customer No.</td>
    <td><strong><?php echo $cust_id; ?></strong></td>
    </tr>

    <tr>
    <td>Full Name</td>
    <td><strong><?php echo $cust_lname; ?> <?php echo $cust_oname; ?> <?php echo $cust_fname; ?></strong></td>
    </tr>

    <tr>
    <td>Year of Registration</td>
    <td><strong><?php echo $cust_date; ?></strong></td>
    </tr>


    <tr>
    <td>Gender</td>
    <td><strong><?php echo $cust_gender; ?></strong></td>
    </tr>

    <tr>
    <td>Marital Status</td>
    <td><strong><?php echo $cust_maritalstatus; ?></strong></td>
    </tr>


    <tr>
      <td>Your eMail</td>
      <td><strong><?php echo $cust_email; ?></strong></td>
    </tr>
    
    <tr>
    <td>Contact No</td>
    <td><strong><?php echo $cust_phno; ?></strong></td>
    </tr>

    <tr>
    <td colspan="2" align="center">Please kindly pay the application fee to this account number <br /><br /><strong>Zenith Bank COOPERATIVE SAVINGS LTD. 0022334455</strong></td>
    </tr>
    
    </table>
				<div class="form-group">
				  <a href="login/"><button class="btn btn-primary"> FINISH APPLICATION </button></a>
				</div>
				
			</form>
<script src="assets/jquery-1.12.4-jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>

    <?php
	
}
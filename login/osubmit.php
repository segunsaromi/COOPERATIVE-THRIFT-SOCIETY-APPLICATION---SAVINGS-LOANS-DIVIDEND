<?php if ($_POST) {?>
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
	$conn = mysqli_connect('localhost','root','','ccsapplicationdb');
	$res=mysqli_query($conn,"SELECT * FROM users WHERE userId=".$_SESSION['user']);
	$userRow=mysqli_fetch_array($res);

	$ress=mysqli_query($conn,"SELECT * FROM personalinfo_tbl WHERE AppNumber='$userRow[userName]'");
	$userRows=mysqli_fetch_array($ress);

	$rac=mysqli_query($conn,"SELECT * FROM academicinfo_tbl WHERE AppNumber='$userRow[userName]'");
	$userRac=mysqli_fetch_array($rac);
	
	$fname = $userRows['FirstName'];
	$oname = $userRows['OtherName'];
	$sname = $userRows['SurName'];
	$gender = $userRows['Gender'];
	$dob = $userRows['DateOfBirth'];
	$state = $userRows['State'];
	$lga = $userRows['Lga'];
	$houseadd = $userRows['Address'];
	$email = $userRows['Email'];
	$phoneno = $userRows['PhoneNumber'];
	$level = $userRows['ProgrammeType'];
	$programme = $userRows['ProgrammeName'];
	$session = $userRows['AcademicSession'];
	$prisch = $userRac['PrimarySchool'];
	$prifrom = $userRac['PrimaryFrom'];
	$prito = $userRac['PrimaryTo'];
	$secsch = $userRac['SecondarySchool'];
	$secfrom = $userRac['SecondaryFrom'];
	$secto = $userRac['SecondaryTo'];
	$hname = $userRac['College'];
	$hfrom = $userRac['CollegeFrom'];
	$hto = $userRac['CollegeTo'];
	$hqualification = $userRac['CollegeQualification'];
	$hprogramme = $userRac['CollegeCourse'];
	$programme = $userRows['ProgrammeName'];
	$session = $userRows['AcademicSession'];
	$pgname = $userRows['PgName'];
	$pgnum = $userRows['PgPhone'];
	$pgadd = $userRows['PgAddress'];
	$nokname = $userRows['KinName'];
	$noknum = $userRows['KinPhone'];
	$nokadd = $userRows['KinAddress'];
	$nokrelationship = $userRows['KinRelationship'];

	$pass=mysqli_query($conn,"SELECT * FROM passport_tbl WHERE AppNumber='$userRow[userName]'");
	$userPass=mysqli_fetch_array($pass);


			$queryNo = "SELECT * FROM academicinfo_tbl WHERE AppNumber='$userRow[userName]' and OlevelNumber>'1'";
			$resNo = mysqli_query($conn,$queryNo);
			$queryVer = "SELECT * FROM verification_tbl WHERE AppNumber='$userRow[userName]' and Status='1'";
			$resVer = mysqli_query($conn,$queryVer);
			


?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome - <?php echo $userRow['userName']; ?></title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script> 
  <script src="assets/js/lga.js"></script>
<link rel="stylesheet" href="assets/css/bootstrap.min.css">
<link rel="stylesheet" href="style.css" type="text/css" />
<!--<link rel="stylesheet" type="text/css" href="style.css" />-->
<style>
	.wrapper{
		padding-top: 50px;
	}
	#form-content{
		margin: 0 auto;
		width: 500px;
	}
</style>
</head>
<body>

 


<div class="wrapper">
	
<?php if ($_POST['result'] == 'number'){
	
		$resultno = trim($_POST['resultno']);
		$resultno = strip_tags($resultno);
		$resultno = htmlspecialchars($resultno);

		$conn = mysqli_connect('localhost','root','','ccsapplicationdb');

		
			$check = "SELECT * FROM academicinfo_tbl WHERE AppNumber='$userRow[userName]'";
			$recheck = mysqli_query($conn,$check);
            if (mysqli_num_rows($recheck) == 1){
			$query = "UPDATE academicinfo_tbl SET OlevelNumber='$resultno' WHERE AppNumber='$userRow[userName]'";
			$res = mysqli_query($conn,$query);} else {$query = "INSERT INTO academicinfo_tbl (AppNumber,OlevelNumber) VALUES ('$userRow[userName]','$resultno')";
			$res = mysqli_query($conn,$query);}
		
		
		
		
		
			$query2 = "UPDATE submit_tbl SET Verification = '1' WHERE AppNumber='$userRow[userName]'";
			$res2 = mysqli_query($conn,$query2);
			$query3 = "INSERT INTO verification_tbl(AppNumber,OlevelNumber,Status) VALUES('$userRow[userName]','$resultno','1')";
			$res3 = mysqli_query($conn,$query3);
			
			
			}	
			
			
if ($_POST['result'] == 'olevel'){
	
		$conn = mysqli_connect('localhost','root','','ccsapplicationdb');
	$rescheck=mysqli_query($conn,"SELECT * FROM academicinfo_tbl WHERE AppNumber='$userRow[userName]'");
	$userRowCheck=mysqli_fetch_array($rescheck);

if 	($userRowCheck['OlevelNumber'] > '0'){
	
		$otypea = trim($_POST['otypea']);
		$otypea = strip_tags($otypea);
		$otypea = htmlspecialchars($otypea);
	
		$oyeara = trim($_POST['oyeara']);
		$oyeara = strip_tags($oyeara);
		$oyeara = htmlspecialchars($oyeara);
	
		$onumbera = trim($_POST['onumbera']);
		$onumbera = strip_tags($onumbera);
		$onumbera = htmlspecialchars($onumbera);
	
		$olevels1 = trim($_POST['olevels1']);
		$olevels1 = strip_tags($olevels1);
		$olevels1 = htmlspecialchars($olevels1);
	
		$olevels2 = trim($_POST['olevels2']);
		$olevels2 = strip_tags($olevels2);
		$olevels2 = htmlspecialchars($olevels2);
	
		$olevels3 = trim($_POST['olevels3']);
		$olevels3 = strip_tags($olevels3);
		$olevels3 = htmlspecialchars($olevels3);
	
		$olevels4 = trim($_POST['olevels4']);
		$olevels4 = strip_tags($olevels4);
		$olevels4 = htmlspecialchars($olevels4);
	
		$olevels5 = trim($_POST['olevels5']);
		$olevels5 = strip_tags($olevels5);
		$olevels5 = htmlspecialchars($olevels5);
	
		$olevels6 = trim($_POST['olevels6']);
		$olevels6 = strip_tags($olevels6);
		$olevels6 = htmlspecialchars($olevels6);
	
		$olevels7 = trim($_POST['olevels7']);
		$olevels7 = strip_tags($olevels7);
		$olevels7 = htmlspecialchars($olevels7);
	
		$olevels8 = trim($_POST['olevels8']);
		$olevels8 = strip_tags($olevels8);
		$olevels8 = htmlspecialchars($olevels8);
	
		$olevels9 = trim($_POST['olevels9']);
		$olevels9 = strip_tags($olevels9);
		$olevels9 = htmlspecialchars($olevels9);
	
		$olevelg1 = trim($_POST['olevelg1']);
		$olevelg1 = strip_tags($olevelg1);
		$olevelg1 = htmlspecialchars($olevelg1);
	
		$olevelg2 = trim($_POST['olevelg2']);
		$olevelg2 = strip_tags($olevelg2);
		$olevelg2 = htmlspecialchars($olevelg2);
	
		$olevelg3 = trim($_POST['olevelg3']);
		$olevelg3 = strip_tags($olevelg3);
		$olevelg3 = htmlspecialchars($olevelg3);
	
		$olevelg4 = trim($_POST['olevelg4']);
		$olevelg4 = strip_tags($olevelg4);
		$olevelg4 = htmlspecialchars($olevelg4);
	
		$olevelg5 = trim($_POST['olevelg5']);
		$olevelg5 = strip_tags($olevelg5);
		$olevelg5 = htmlspecialchars($olevelg5);
	
		$olevelg6 = trim($_POST['olevelg6']);
		$olevelg6 = strip_tags($olevelg6);
		$olevelg6 = htmlspecialchars($olevelg6);
	
		$olevelg7 = trim($_POST['olevelg7']);
		$olevelg7 = strip_tags($olevelg7);
		$olevelg7 = htmlspecialchars($olevelg7);
	
		$olevelg8 = trim($_POST['olevelg8']);
		$olevelg8 = strip_tags($olevelg8);
		$olevelg8 = htmlspecialchars($olevelg8);
	
		$olevelg9 = trim($_POST['olevelg9']);
		$olevelg9 = strip_tags($olevelg9);
		$olevelg9 = htmlspecialchars($olevelg9);
	

			$check = "SELECT * FROM olevel1info_tbl WHERE AppNumber='$userRow[userName]'";
			$recheck = mysqli_query($conn,$check);
            if (mysqli_num_rows($recheck) < 1){
				$query3 = "INSERT INTO olevel1info_tbl(AppNumber,OlevelType,ExamYear,ExamNumber,OlevelS1,OlevelS2,OlevelS3,OlevelS4,OlevelS5,OlevelS6,OlevelS7,OlevelS8,OlevelS9,OlevelG1,OlevelG2,OlevelG3,OlevelG4,OlevelG5,OlevelG6,OlevelG7,OlevelG8,OlevelG9) VALUES('$userRow[userName]','$otypea','$oyeara','$onumbera','$olevels1','$olevels2','$olevels3','$olevels4','$olevels5','$olevels6','$olevels7','$olevels8','$olevels9','$olevelg1','$olevelg2','$olevelg3','$olevelg4','$olevelg5','$olevelg6','$olevelg7','$olevelg8','$olevelg9')";
			$res3 = mysqli_query($conn,$query3);
			$query2 = "UPDATE submit_tbl SET Olevel = '1' WHERE AppNumber='$userRow[userName]'";
			$res2 = mysqli_query($conn,$query2);

			}
			else {
				
				$query3 = "UPDATE olevel1info_tbl SET AppNumber='$userRow[userName]',OlevelType='$otypea',ExamYear='$oyeara',ExamNumber='$onumbera',OlevelS1='$olevels1',OlevelS2='$olevels2',OlevelS3='$olevels3',OlevelS4='$olevels4',OlevelS5='$olevels5',OlevelS6='$olevels6',OlevelS7='$olevels7',OlevelS8='$olevels8',OlevelS9='$olevels9',OlevelG1='$olevelg1',OlevelG2='$olevelg2',OlevelG3='$olevelg3',OlevelG4='$olevelg4',OlevelG5='$olevelg5',OlevelG6='$olevelg6',OlevelG7='$olevelg7',OlevelG8='$olevelg8',OlevelG9='$olevelg9' WHERE AppNumber='$userRow[userName]'";
			$res3 = mysqli_query($conn,$query3);
			$query2 = "UPDATE submit_tbl SET Olevel = '1' WHERE AppNumber='$userRow[userName]'";
			$res2 = mysqli_query($conn,$query2);
			
			
			}

}

if 	($userRowCheck['OlevelNumber'] > '1'){
		$otypeb = trim($_POST['otypeb']);
		$otypeb = strip_tags($otypeb);
		$otypeb = htmlspecialchars($otypeb);
	
		$oyearb = trim($_POST['oyearb']);
		$oyearb = strip_tags($oyearb);
		$oyearb = htmlspecialchars($oyearb);
	
		$onumberb = trim($_POST['onumberb']);
		$onumberb = strip_tags($onumberb);
		$onumberb = htmlspecialchars($onumberb);
	
		$olevelsb1 = trim($_POST['olevelsb1']);
		$olevelsb1 = strip_tags($olevelsb1);
		$olevelsb1 = htmlspecialchars($olevelsb1);
	
		$olevelsb2 = trim($_POST['olevelsb2']);
		$olevelsb2 = strip_tags($olevelsb2);
		$olevelsb2 = htmlspecialchars($olevelsb2);
	
		$olevelsb3 = trim($_POST['olevelsb3']);
		$olevelsb3 = strip_tags($olevelsb3);
		$olevelsb3 = htmlspecialchars($olevelsb3);
	
		$olevelsb4 = trim($_POST['olevelsb4']);
		$olevelsb4 = strip_tags($olevelsb4);
		$olevelsb4 = htmlspecialchars($olevelsb4);
	
		$olevelsb5 = trim($_POST['olevelsb5']);
		$olevelsb5 = strip_tags($olevelsb5);
		$olevelsb5 = htmlspecialchars($olevelsb5);
	
		$olevelsb6 = trim($_POST['olevelsb6']);
		$olevelsb6 = strip_tags($olevelsb6);
		$olevelsb6 = htmlspecialchars($olevelsb6);
	
		$olevelsb7 = trim($_POST['olevelsb7']);
		$olevelsb7 = strip_tags($olevelsb7);
		$olevelsb7 = htmlspecialchars($olevelsb7);
	
		$olevelsb8 = trim($_POST['olevelsb8']);
		$olevelsb8 = strip_tags($olevelsb8);
		$olevelsb8 = htmlspecialchars($olevelsb8);
	
		$olevelsb9 = trim($_POST['olevelsb9']);
		$olevelsb9 = strip_tags($olevelsb9);
		$olevelsb9 = htmlspecialchars($olevelsb9);
	
		$olevelgb1 = trim($_POST['olevelgb1']);
		$olevelgb1 = strip_tags($olevelgb1);
		$olevelgb1 = htmlspecialchars($olevelgb1);
	
		$olevelgb2 = trim($_POST['olevelgb2']);
		$olevelgb2 = strip_tags($olevelgb2);
		$olevelgb2 = htmlspecialchars($olevelgb2);
	
		$olevelgb3 = trim($_POST['olevelgb3']);
		$olevelgb3 = strip_tags($olevelgb3);
		$olevelgb3 = htmlspecialchars($olevelgb3);
	
		$olevelgb4 = trim($_POST['olevelgb4']);
		$olevelgb4 = strip_tags($olevelgb4);
		$olevelgb4 = htmlspecialchars($olevelgb4);
	
		$olevelgb5 = trim($_POST['olevelgb5']);
		$olevelgb5 = strip_tags($olevelgb5);
		$olevelgb5 = htmlspecialchars($olevelgb5);
	
		$olevelgb6 = trim($_POST['olevelgb6']);
		$olevelgb6 = strip_tags($olevelgb6);
		$olevelgb6 = htmlspecialchars($olevelgb6);
	
		$olevelgb7 = trim($_POST['olevelgb7']);
		$olevelgb7 = strip_tags($olevelgb7);
		$olevelgb7 = htmlspecialchars($olevelgb7);
	
		$olevelgb8 = trim($_POST['olevelgb8']);
		$olevelgb8 = strip_tags($olevelgb8);
		$olevelgb8 = htmlspecialchars($olevelgb8);
	
		$olevelgb9 = trim($_POST['olevelgb9']);
		$olevelgb9 = strip_tags($olevelgb9);
		$olevelgb9 = htmlspecialchars($olevelgb9);
	
			$check = "SELECT * FROM olevel2info_tbl WHERE AppNumber='$userRow[userName]'";
			$recheck = mysqli_query($conn,$check);
            if (mysqli_num_rows($recheck) < 1){

				$query4 = "INSERT INTO olevel2info_tbl(AppNumber,OlevelType,ExamYear,ExamNumber,OlevelS1,OlevelS2,OlevelS3,OlevelS4,OlevelS5,OlevelS6,OlevelS7,OlevelS8,OlevelS9,OlevelG1,OlevelG2,OlevelG3,OlevelG4,OlevelG5,OlevelG6,OlevelG7,OlevelG8,OlevelG9) VALUES('$userRow[userName]','$otypeb','$oyearb','$onumberb','$olevelsb1','$olevelsb2','$olevelsb3','$olevelsb4','$olevelsb5','$olevelsb6','$olevelsb7','$olevelsb8','$olevelsb9','$olevelgb1','$olevelgb2','$olevelgb3','$olevelgb4','$olevelgb5','$olevelgb6','$olevelgb7','$olevelgb8','$olevelgb9')";
							$res3 = mysqli_query($conn,$query4);
							}
			else {
				
				$query3 = "UPDATE olevel2info_tbl SET AppNumber='$userRow[userName]',OlevelType='$otypeb',ExamYear='$oyearb',ExamNumber='$onumberb',OlevelS1='$olevelsb1',OlevelS2='$olevelsb2',OlevelS3='$olevelsb3',OlevelS4='$olevelsb4',OlevelS5='$olevelsb5',OlevelS6='$olevelsb6',OlevelS7='$olevelsb7',OlevelS8='$olevelsb8',OlevelS9='$olevelsb9',OlevelG1='$olevelgb1',OlevelG2='$olevelgb2',OlevelG3='$olevelgb3',OlevelG4='$olevelgb4',OlevelG5='$olevelgb5',OlevelG6='$olevelgb6',OlevelG7='$olevelgb7',OlevelG8='$olevelgb8',OlevelG9='$olevelgb9' WHERE AppNumber='$userRow[userName]'";
			$res3 = mysqli_query($conn,$query3);
			$query2 = "UPDATE submit_tbl SET Olevel = '1' WHERE AppNumber='$userRow[userName]'";
			$res2 = mysqli_query($conn,$query2);
			
			
			}
}

	}	
	?>    <?php if ($_POST['result'] == 'olevel'){?>
    <table width="100%" border="0" class="table table-striped">
    
    <tr>
    <td colspan="2">
    	<div class="alert alert-info">
    		<strong>Success</strong>, O'Level Details Entered...
    	</div>
    </td>
    </tr>
    <tr>
    <td colspan="2">
    		<h4><strong>O'LEVEL 1 DETAILS</strong></h4>
    </td>
    </tr>
    
    <tr>
    <td width="39%">Exam Type / Year</td>
    <td width="61%"><strong><?php echo $otypea; ?> / <?php echo $oyeara; ?></strong></td>
    </tr>

    <tr>
    <td>Exam Number</td>
    <td><strong><?php echo $onumbera; ?></strong></td>
    </tr>

    <tr>
    <td><?php echo $olevels1; ?></td>
    <td><strong><?php echo $olevelg1; ?></strong></td>
    </tr>

    <tr>
    <td><?php echo $olevels2; ?></td>
    <td><strong><?php echo $olevelg2; ?></strong></td>
    </tr>

    <tr>
    <td><?php echo $olevels3; ?></td>
    <td><strong><?php echo $olevelg3; ?></strong></td>
    </tr>

    <tr>
    <td><?php echo $olevels4; ?></td>
    <td><strong><?php echo $olevelg4; ?></strong></td>
    </tr>

    <tr>
    <td><?php echo $olevels5; ?></td>
    <td><strong><?php echo $olevelg5; ?></strong></td>
    </tr>

    <tr>
    <td><?php echo $olevels6; ?></td>
    <td><strong><?php echo $olevelg6; ?></strong></td>
    </tr>

    <tr>
    <td><?php echo $olevels7; ?></td>
    <td><strong><?php echo $olevelg7; ?></strong></td>
    </tr>

    <tr>
    <td><?php echo $olevels8; ?></td>
    <td><strong><?php echo $olevelg8; ?></strong></td>
    </tr>

    <tr>
    <td><?php echo $olevels9; ?></td>
    <td><strong><?php echo $olevelg9; ?></strong></td>
    </tr>

      
    </table>
 
 
 <?php if 	($userRowCheck['OlevelNumber'] == '2') {?>   <table width="100%" border="0" class="table table-striped">
    
    <tr>
    <td colspan="2">
    		<h4><strong>O'LEVEL 2 DETAILS</strong></h4>
    </td>
    </tr>
    
    <tr>
    <td width="39%">Exam Type / Year</td>
    <td width="61%"><strong><?php echo $otypeb; ?> / <?php echo $oyearb; ?></strong></td>
    </tr>

    <tr>
    <td>Exam Number</td>
    <td><strong><?php echo $onumberb; ?></strong></td>
    </tr>

    <tr>
    <td><?php echo $olevelsb1; ?></td>
    <td><strong><?php echo $olevelgb1; ?></strong></td>
    </tr>

    <tr>
    <td><?php echo $olevelsb2; ?></td>
    <td><strong><?php echo $olevelgb2; ?></strong></td>
    </tr>

    <tr>
    <td><?php echo $olevelsb3; ?></td>
    <td><strong><?php echo $olevelgb3; ?></strong></td>
    </tr>

    <tr>
    <td><?php echo $olevels4; ?></td>
    <td><strong><?php echo $olevelg4; ?></strong></td>
    </tr>

    <tr>
    <td><?php echo $olevelsb5; ?></td>
    <td><strong><?php echo $olevelgb5; ?></strong></td>
    </tr>

    <tr>
    <td><?php echo $olevelsb6; ?></td>
    <td><strong><?php echo $olevelgb6; ?></strong></td>
    </tr>

    <tr>
    <td><?php echo $olevelsb7; ?></td>
    <td><strong><?php echo $olevelgb7; ?></strong></td>
    </tr>

    <tr>
    <td><?php echo $olevelsb8; ?></td>
    <td><strong><?php echo $olevelgb8; ?></strong></td>
    </tr>

    <tr>
    <td><?php echo $olevelsb9; ?></td>
    <td><strong><?php echo $olevelgb9; ?></strong></td>
    </tr>

      
    </table>
	<?php }?>			<div class="form-group">
				  <button class="btn btn-primary" name="submit"> - RECORD VERIFIED - </button>
				</div>
<?php }?>	
<?php if ($_POST['result'] == 'number') {?>  
<table width="100%" border="0" class="table table-striped">
    
    <tr>
    <td colspan="2">
    	<div class="alert alert-info">
    		<strong>Success</strong>, O'Level Sittings Entered...
    	</div>
    </td>
    </tr>
        <tr>
    <td colspan="2"></td>
    </tr>
    <td colspan="2"><div class="form-group">
				  <a href="olevel.php"><button class="btn btn-primary" name="submit"> - CLICK TO ENTER RESULTS - </button></a>
				</div></td>
    </tr>
        <tr>
    <td colspan="2"></td>
    </tr>
</table><?php }?>
</div>


<script src="../onlineapp/assets/jquery-1.12.4-jquery.min.js"></script>
<script src="../onlineapp/assets/js/bootstrap.min.js"></script>

<script type="text/javascript">
$(document).ready(function() {	
	
	// submit form using $.ajax() method
	
	$('#reg-form').submit(function(e){
		
		e.preventDefault(); // Prevent Default Submission
		
		$.ajax({
			url: 'olevel.php',
			type: 'POST',
			data: $(this).serialize() // it will serialize the form data
		})
		.done(function(data){
			$('#form-content').fadeOut('slow', function(){
				$('#form-content').fadeIn('slow').html(data);
			});
		})
		.fail(function(){
			alert('Ajax Submit Failed ...');	
		});
	});
	
	
	/*
	// submit form using ajax short hand $.post() method
	
	$('#reg-form').submit(function(e){
		
		e.preventDefault(); // Prevent Default Submission
		
		$.post('submit.php', $(this).serialize() )
		.done(function(data){
			$('#form-content').fadeOut('slow', function(){
				$('#form-content').fadeIn('slow').html(data);
			});
		})
		.fail(function(){
			alert('Ajax Submit Failed ...');
		});
		
	});
	*/
	
});
</script>
</body>
</html>
<?php ob_end_flush(); ?>

<?php }?>
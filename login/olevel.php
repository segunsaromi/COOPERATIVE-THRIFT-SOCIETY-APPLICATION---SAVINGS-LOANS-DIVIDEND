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

	$app=mysqli_query($conn,"SELECT * FROM submit_tbl WHERE AppNumber='$userRow[userName]' and Submit='1'");
	if (mysqli_num_rows($app) > 0){header("Location: complete.php");
	exit;}

	$ress=mysqli_query($conn,"SELECT * FROM personalinfo_tbl WHERE AppNumber='$userRow[userName]'");
	$userRows=mysqli_fetch_array($ress);

	$rac=mysqli_query($conn,"SELECT * FROM academicinfo_tbl WHERE AppNumber='$userRow[userName]'");
	$userRac=mysqli_fetch_array($rac);
	
	$oresa=mysqli_query($conn,"SELECT * FROM olevel1info_tbl WHERE AppNumber='$userRow[userName]'");
	$oRaca=mysqli_fetch_array($oresa);
	
	$oresb=mysqli_query($conn,"SELECT * FROM olevel2info_tbl WHERE AppNumber='$userRow[userName]'");
	$oRacb=mysqli_fetch_array($oresb);
	
	
	$otypea = $oRaca['OlevelType'];
	$oyeara = $oRaca['ExamYear'];
	$onumbera = $oRaca['ExamNumber'];
	$olevels1 = $oRaca['OlevelS1'];
	$olevels2 = $oRaca['OlevelS2'];
	$olevels3 = $oRaca['OlevelS3'];
	$olevels4 = $oRaca['OlevelS4'];
	$olevels5 = $oRaca['OlevelS5'];
	$olevels6 = $oRaca['OlevelS6'];
	$olevels7 = $oRaca['OlevelS7'];
	$olevels8 = $oRaca['OlevelS8'];
	$olevels9 = $oRaca['OlevelS9'];
	$olevelg1 = $oRaca['OlevelG1'];
	$olevelg2 = $oRaca['OlevelG2'];
	$olevelg3 = $oRaca['OlevelG3'];
	$olevelg4 = $oRaca['OlevelG4'];
	$olevelg5 = $oRaca['OlevelG5'];
	$olevelg6 = $oRaca['OlevelG6'];
	$olevelg7 = $oRaca['OlevelG7'];
	$olevelg8 = $oRaca['OlevelG8'];
	$olevelg9 = $oRaca['OlevelG9'];


	$otypeb = $oRacb['OlevelType'];
	$oyearb = $oRacb['ExamYear'];
	$onumberb = $oRacb['ExamNumber'];
	$olevelsb1 = $oRacb['OlevelS1'];
	$olevelsb2 = $oRacb['OlevelS2'];
	$olevelsb3 = $oRacb['OlevelS3'];
	$olevelsb4 = $oRacb['OlevelS4'];
	$olevelsb5 = $oRacb['OlevelS5'];
	$olevelsb6 = $oRacb['OlevelS6'];
	$olevelsb7 = $oRacb['OlevelS7'];
	$olevelsb8 = $oRacb['OlevelS8'];
	$olevelsb9 = $oRacb['OlevelS9'];
	$olevelgb1 = $oRacb['OlevelG1'];
	$olevelgb2 = $oRacb['OlevelG2'];
	$olevelgb3 = $oRacb['OlevelG3'];
	$olevelgb4 = $oRacb['OlevelG4'];
	$olevelgb5 = $oRacb['OlevelG5'];
	$olevelgb6 = $oRacb['OlevelG6'];
	$olevelgb7 = $oRacb['OlevelG7'];
	$olevelgb8 = $oRacb['OlevelG8'];
	$olevelgb9 = $oRacb['OlevelG9'];


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

<nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Yaba College of Technology</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li><a href="home.php">Profile Status</a></li>
            <li><a href="form.php">Information</a></li>
            <li><a href="imageupload/index.php">Passport</a></li>
            <li><a href="#">SSCE Result</a></li>
            <li><a href="submitapp.php">Submit Application</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
			  <span class="glyphicon glyphicon-user"></span>&nbsp;App Number <strong><?php echo $userRow['userName']; ?> </strong>&nbsp;<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="logout.php?logout"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Sign Out</a></li>
              </ul>
            </li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav> 


<div class="wrapper">
<div style="background-image:url(../onlineapp/ccslogo/header.jpg); background-repeat:no-repeat center center; background-size:cover; height:150px"></div>
	
	<div class="container">
	
	<div class="page-header">
    	<h3>Center for Continuous Studies (Part-Time) 2018/2019 Application</h3>
<table width="100%">   
       <tr>
    <td width="13%"><img name="" src="imageupload/<?php if ($userPass['Passport'] <> "") {echo $userPass['Passport'];} else {echo "no-image.jpg";} ?>" width="60" height="60" alt=""></td>
    <td width="87%"><h5 style="color:#030"><strong> Name:</strong> <?php echo $sname; echo " "; echo $fname; echo " "; echo $oname; ?></h5>         <h5 style="color:#030"><strong> Programme: </strong><?php echo $level; echo " "; echo $programme; echo " "; echo "- "; echo $session; ?> Session</h5> </td>
    </tr>
        
</table>
   	  </div>
	
<?php if (mysqli_num_rows($resVer) < '1') {?>

	<div class="col-lg-12">
	
		<div class="row">
		
			<div id="form-content">
			
			<form method="post" id="reg-form" autocomplete="off">


			  <div class="form-group">
			    <label>
    <input type="radio" name="resultno" value="1" id="RadioGroup1_0" >
    One Olevel Result
  </label>
<br>
  <label>
  <input type="radio" checked name="resultno" value="2" id="RadioGroup1_1" >
    Two Olevel Results</label>
  <input type="hidden" name="result"  value="number">
			  </div> 

                
                
                
			  <hr />
				
				<div class="form-group">
					<button class="btn btn-primary"> Click to Pay </button>
				</div>
				
			</form>
            
            </div>
            
            </div>
		
	</div>
      <?php }?>       
    
    
    
    
    
    
    
    
<?php if (mysqli_num_rows($resVer) > '0') {?>
    <div class="col-lg-12">
	
		<div class="row">
		
			<div id="form-content">
			
			<form method="post" id="reg-form" autocomplete="off">

<div class="form-group">
<h4 align="center"><strong>
  <input type="hidden" name="result" id="result" value="olevel">
  O'Level Results (One)</strong></h4> 							<label>Exam Type</label>

<select name="otypea" id="otypea" class="form-control" required>
							  <option value="<?php if (@$otypea <> ""){echo @$otypea;} else {echo "";}?>" selected><?php if (@$otypea <> ""){echo @$otypea;} else {echo "- Select O'Level Type -";}?></option>
							  <option value='WAEC'>WAEC</option>
							  <option value='NECO'>NECO</option>
							  <option value='NABTEB'>NABTEB</option>

							</select></div> 

             
<div class="form-group"><label>Exam Year </label> <input type="month"  name="oyeara" id="lname" value="<?php echo $oyeara; ?>" required /></div>                
                
      <div class="form-group"><label>Exam Number</label><input type="text" onkeyup="this.value = this.value.toUpperCase();" pattern="^[A-Za-z0-9 -]+$" class="form-control" name="onumbera" id="lname" placeholder="<?php if (@$onumbera <> ""){echo @$onumbera;} else {echo "Exam Number";}?>" value="<?php echo @$onumbera; ?>" required /></div>
<div class="form-group"><label>Subject/Grades</label>
<table width="80%">
  <tr>
    <td><select name="olevels1" id="olevels1" class="form-control" required>
							  <option value="<?php if (@$olevels1 <> ""){echo @$olevels1;} else {echo "";}?>" selected><?php if (@$olevels1 <> ""){echo @$olevels1;} else {echo "- Subject 1 -";}?></option>
							  <option value='Mathematics'>Mathematics</option>
							  <option value='English'>English</option>
							  <option value='Further-Mathematics'>Further-Mathematics</option>
							  <option value='Lit-In-English'>Lit in English</option>
							  <option value='Biology'>Biology</option>
							  <option value='Chemistry'>Chemistry</option>
							  <option value='Physics'>Physics</option>
							  <option value='Agricultural-Science'>Agricultural Science</option>
							  <option value='Economics'>Economics</option>
							  <option value='Geography'>Geography</option>
							  <option value='Government'>Government</option>
							  <option value='C.R.K'>Christian Studies</option>
							  <option value='Islamic-Studies'>Islamic Studies</option>

							</select></td>
    <td><select name="olevelg1" id="olevelg1" class="form-control" required>
							  <option value="<?php if (@$olevelg1 <> ""){echo @$olevelg1;} else {echo "";}?>" selected><?php if (@$olevelg1 <> ""){echo @$olevelg1;} else {echo "- Grade -";}?></option>
							  <option value='A1'>A1</option>
							  <option value='B2'>B2</option>
							  <option value='B3'>B3</option>
							  <option value='C4'>C4</option>
							  <option value='C5'>C5</option>
							  <option value='C6'>C6</option>
							  <option value='P7'>P7</option>
							  <option value='E8'>E8</option>
							  <option value='F9'>F9</option>

							</select></td>
  </tr>
  <tr>
    <td><select name="olevels2" id="olevels2" class="form-control" required>
      <option value="<?php if (@$olevels2 <> ""){echo @$olevels2;} else {echo "";}?>" selected>
        <?php if (@$olevels2 <> ""){echo @$olevels2;} else {echo "- Subject 2 -";}?>
        </option>
      <option value='Mathematics'>Mathematics</option>
      <option value='English'>English</option>
      <option value='Further-Mathematics'>Further-Mathematics</option>
      <option value='Lit-In-English'>Lit in English</option>
      <option value='Biology'>Biology</option>
      <option value='Chemistry'>Chemistry</option>
      <option value='Physics'>Physics</option>
      <option value='Agricultural-Science'>Agricultural Science</option>
      <option value='Economics'>Economics</option>
      <option value='Geography'>Geography</option>
      <option value='Government'>Government</option>
      <option value='C.R.K'>Christian Studies</option>
      <option value='Islamic-Studies'>Islamic Studies</option>
    </select></td>
    <td><select name="olevelg2" id="olevelg2" class="form-control" required>
      <option value="<?php if (@$olevelg2 <> ""){echo @$olevelg2;} else {echo "";}?>" selected>
        <?php if (@$olevelg2 <> ""){echo @$olevelg2;} else {echo "- Grade -";}?>
        </option>
      <option value='A1'>A1</option>
      <option value='B2'>B2</option>
      <option value='B3'>B3</option>
      <option value='C4'>C4</option>
      <option value='C5'>C5</option>
      <option value='C6'>C6</option>
      <option value='P7'>P7</option>
      <option value='E8'>E8</option>
      <option value='F9'>F9</option>
    </select></td>
  </tr>
  <tr>
    <td><select name="olevels3" id="olevels3" class="form-control" required>
      <option value="<?php if (@$olevels3 <> ""){echo @$olevels3;} else {echo "";}?>" selected>
        <?php if (@$olevels3 <> ""){echo @$olevels3;} else {echo "- Subject 3 -";}?>
        </option>
      <option value='Mathematics'>Mathematics</option>
      <option value='English'>English</option>
      <option value='Further-Mathematics'>Further-Mathematics</option>
      <option value='Lit-In-English'>Lit in English</option>
      <option value='Biology'>Biology</option>
      <option value='Chemistry'>Chemistry</option>
      <option value='Physics'>Physics</option>
      <option value='Agricultural-Science'>Agricultural Science</option>
      <option value='Economics'>Economics</option>
      <option value='Geography'>Geography</option>
      <option value='Government'>Government</option>
      <option value='C.R.K'>Christian Studies</option>
      <option value='Islamic-Studies'>Islamic Studies</option>
    </select></td>
    <td><select name="olevelg3" id="olevelg3" class="form-control" required>
      <option value="<?php if (@$olevelg3 <> ""){echo @$olevelg3;} else {echo "";}?>" selected>
        <?php if (@$olevelg3 <> ""){echo @$olevelg3;} else {echo "- Grade -";}?>
        </option>
      <option value='A1'>A1</option>
      <option value='B2'>B2</option>
      <option value='B3'>B3</option>
      <option value='C4'>C4</option>
      <option value='C5'>C5</option>
      <option value='C6'>C6</option>
      <option value='P7'>P7</option>
      <option value='E8'>E8</option>
      <option value='F9'>F9</option>
    </select></td>
  </tr>
  <tr>
    <td><select name="olevels4" id="olevels4" class="form-control" required>
      <option value="<?php if (@$olevels4 <> ""){echo @$olevels4;} else {echo "";}?>" selected>
        <?php if (@$olevels4 <> ""){echo @$olevels4;} else {echo "- Subject 4 -";}?>
        </option>
      <option value='Mathematics'>Mathematics</option>
      <option value='English'>English</option>
      <option value='Further-Mathematics'>Further-Mathematics</option>
      <option value='Lit-In-English'>Lit in English</option>
      <option value='Biology'>Biology</option>
      <option value='Chemistry'>Chemistry</option>
      <option value='Physics'>Physics</option>
      <option value='Agricultural-Science'>Agricultural Science</option>
      <option value='Economics'>Economics</option>
      <option value='Geography'>Geography</option>
      <option value='Government'>Government</option>
      <option value='C.R.K'>Christian Studies</option>
      <option value='Islamic-Studies'>Islamic Studies</option>
    </select></td>
    <td><select name="olevelg4" id="olevelg4" class="form-control" required>
      <option value="<?php if (@$olevelg4 <> ""){echo @$olevelg4;} else {echo "";}?>" selected>
        <?php if (@$olevelg4 <> ""){echo @$olevelg4;} else {echo "- Grade -";}?>
        </option>
      <option value='A1'>A1</option>
      <option value='B2'>B2</option>
      <option value='B3'>B3</option>
      <option value='C4'>C4</option>
      <option value='C5'>C5</option>
      <option value='C6'>C6</option>
      <option value='P7'>P7</option>
      <option value='E8'>E8</option>
      <option value='F9'>F9</option>
    </select></td>
  </tr>
  <tr>
    <td><select name="olevels5" id="olevels5" class="form-control" required>
      <option value="<?php if (@$olevels5 <> ""){echo @$olevels5;} else {echo "";}?>" selected>
        <?php if (@$olevels5 <> ""){echo @$olevels5;} else {echo "- Subject 5 -";}?>
        </option>
      <option value='Mathematics'>Mathematics</option>
      <option value='English'>English</option>
      <option value='Further-Mathematics'>Further-Mathematics</option>
      <option value='Lit-In-English'>Lit in English</option>
      <option value='Biology'>Biology</option>
      <option value='Chemistry'>Chemistry</option>
      <option value='Physics'>Physics</option>
      <option value='Agricultural-Science'>Agricultural Science</option>
      <option value='Economics'>Economics</option>
      <option value='Geography'>Geography</option>
      <option value='Government'>Government</option>
      <option value='C.R.K'>Christian Studies</option>
      <option value='Islamic-Studies'>Islamic Studies</option>
    </select></td>
    <td><select name="olevelg5" id="olevelg5" class="form-control" required>
      <option value="<?php if (@$olevelg5 <> ""){echo @$olevelg5;} else {echo "";}?>" selected>
        <?php if (@$olevelg5 <> ""){echo @$olevelg5;} else {echo "- Grade -";}?>
        </option>
      <option value='A1'>A1</option>
      <option value='B2'>B2</option>
      <option value='B3'>B3</option>
      <option value='C4'>C4</option>
      <option value='C5'>C5</option>
      <option value='C6'>C6</option>
      <option value='P7'>P7</option>
      <option value='E8'>E8</option>
      <option value='F9'>F9</option>
    </select></td>
  </tr>
  <tr>
    <td><select name="olevels6" id="olevels6" class="form-control" required>
      <option value="<?php if (@$olevels6 <> ""){echo @$olevels6;} else {echo "";}?>" selected>
        <?php if (@$olevels6 <> ""){echo @$olevels6;} else {echo "- Subject 6 -";}?>
        </option>
      <option value='Mathematics'>Mathematics</option>
      <option value='English'>English</option>
      <option value='Further-Mathematics'>Further-Mathematics</option>
      <option value='Lit-In-English'>Lit in English</option>
      <option value='Biology'>Biology</option>
      <option value='Chemistry'>Chemistry</option>
      <option value='Physics'>Physics</option>
      <option value='Agricultural-Science'>Agricultural Science</option>
      <option value='Economics'>Economics</option>
      <option value='Geography'>Geography</option>
      <option value='Government'>Government</option>
      <option value='C.R.K'>Christian Studies</option>
      <option value='Islamic-Studies'>Islamic Studies</option>
    </select></td>
    <td><select name="olevelg6" id="olevelg6" class="form-control" required>
      <option value="<?php if (@$olevelg6 <> ""){echo @$olevelg6;} else {echo "";}?>" selected>
        <?php if (@$olevelg6 <> ""){echo @$olevelg6;} else {echo "- Grade -";}?>
        </option>
      <option value='A1'>A1</option>
      <option value='B2'>B2</option>
      <option value='B3'>B3</option>
      <option value='C4'>C4</option>
      <option value='C5'>C5</option>
      <option value='C6'>C6</option>
      <option value='P7'>P7</option>
      <option value='E8'>E8</option>
      <option value='F9'>F9</option>
    </select></td>
  </tr>
  <tr>
    <td><select name="olevels7" id="olevels7" class="form-control" required>
      <option value="<?php if (@$olevels7 <> ""){echo @$olevels7;} else {echo "";}?>" selected>
        <?php if (@$olevels7 <> ""){echo @$olevels7;} else {echo "- Subject 7 -";}?>
        </option>
      <option value='Mathematics'>Mathematics</option>
      <option value='English'>English</option>
      <option value='Further-Mathematics'>Further-Mathematics</option>
      <option value='Lit-In-English'>Lit in English</option>
      <option value='Biology'>Biology</option>
      <option value='Chemistry'>Chemistry</option>
      <option value='Physics'>Physics</option>
      <option value='Agricultural-Science'>Agricultural Science</option>
      <option value='Economics'>Economics</option>
      <option value='Geography'>Geography</option>
      <option value='Government'>Government</option>
      <option value='C.R.K'>Christian Studies</option>
      <option value='Islamic-Studies'>Islamic Studies</option>
    </select></td>
    <td><select name="olevelg7" id="olevelg7" class="form-control" required>
      <option value="<?php if (@$olevelg7 <> ""){echo @$olevelg7;} else {echo "";}?>" selected>
        <?php if (@$olevelg7 <> ""){echo @$olevelg7;} else {echo "- Grade -";}?>
        </option>
      <option value='A1'>A1</option>
      <option value='B2'>B2</option>
      <option value='B3'>B3</option>
      <option value='C4'>C4</option>
      <option value='C5'>C5</option>
      <option value='C6'>C6</option>
      <option value='P7'>P7</option>
      <option value='E8'>E8</option>
      <option value='F9'>F9</option>
    </select></td>
  </tr>
  <tr>
    <td><select name="olevels8" id="olevels8" class="form-control" required>
      <option value="<?php if (@$olevels8 <> ""){echo @$olevels8;} else {echo "";}?>" selected>
        <?php if (@$olevels8 <> ""){echo @$olevels8;} else {echo "- Subject 8 -";}?>
        </option>
      <option value='Mathematics'>Mathematics</option>
      <option value='English'>English</option>
      <option value='Further-Mathematics'>Further-Mathematics</option>
      <option value='Lit-In-English'>Lit in English</option>
      <option value='Biology'>Biology</option>
      <option value='Chemistry'>Chemistry</option>
      <option value='Physics'>Physics</option>
      <option value='Agricultural-Science'>Agricultural Science</option>
      <option value='Economics'>Economics</option>
      <option value='Geography'>Geography</option>
      <option value='Government'>Government</option>
      <option value='C.R.K'>Christian Studies</option>
      <option value='Islamic-Studies'>Islamic Studies</option>
    </select></td>
    <td><select name="olevelg8" id="olevelg8" class="form-control" required>
      <option value="<?php if (@$olevelg8 <> ""){echo @$olevelg8;} else {echo "";}?>" selected>
        <?php if (@$olevelg8 <> ""){echo @$olevelg8;} else {echo "- Grade -";}?>
        </option>
      <option value='A1'>A1</option>
      <option value='B2'>B2</option>
      <option value='B3'>B3</option>
      <option value='C4'>C4</option>
      <option value='C5'>C5</option>
      <option value='C6'>C6</option>
      <option value='P7'>P7</option>
      <option value='E8'>E8</option>
      <option value='F9'>F9</option>
    </select></td>
  </tr>
  <tr>
    <td><select name="olevels9" id="olevels9" class="form-control" required>
      <option value="<?php if (@$olevels9 <> ""){echo @$olevels9;} else {echo "";}?>" selected>
        <?php if (@$olevels9 <> ""){echo @$olevels9;} else {echo "- Subject 9 -";}?>
        </option>
      <option value='Mathematics'>Mathematics</option>
      <option value='English'>English</option>
      <option value='Further-Mathematics'>Further-Mathematics</option>
      <option value='Lit-In-English'>Lit in English</option>
      <option value='Biology'>Biology</option>
      <option value='Chemistry'>Chemistry</option>
      <option value='Physics'>Physics</option>
      <option value='Agricultural-Science'>Agricultural Science</option>
      <option value='Economics'>Economics</option>
      <option value='Geography'>Geography</option>
      <option value='Government'>Government</option>
      <option value='C.R.K'>Christian Studies</option>
      <option value='Islamic-Studies'>Islamic Studies</option>
    </select></td>
    <td><select name="olevelg9" id="olevelg9" class="form-control" required>
      <option value="<?php if (@$olevelg9 <> ""){echo @$olevelg9;} else {echo "";}?>" selected>
        <?php if (@$olevelg9 <> ""){echo @$olevelg9;} else {echo "- Grade -";}?>
        </option>
      <option value='A1'>A1</option>
      <option value='B2'>B2</option>
      <option value='B3'>B3</option>
      <option value='C4'>C4</option>
      <option value='C5'>C5</option>
      <option value='C6'>C6</option>
      <option value='P7'>P7</option>
      <option value='E8'>E8</option>
      <option value='F9'>F9</option>
    </select></td>
  </tr>
</table>
</div>  

<?php if (mysqli_num_rows($resNo) > '0') {?>

<br><br>  <div class="form-group">
<h4 align="center"><strong>O'Level Results (Two)</strong></h4> 							<label>Exam Type</label>

<select name="otypeb" id="otypeb" class="form-control" required>
							  <option value="<?php if (@$otypeb <> ""){echo @$otypeb;} else {echo "";}?>" selected><?php if (@$otypeb <> ""){echo @$otypeb;} else {echo "- Select O'Level Type -";}?></option>
							  <option value='WAEC'>WAEC</option>
							  <option value='NECO'>NECO</option>
							  <option value='NABTEB'>NABTEB</option>

			  </select></div> 

             
<div class="form-group"><label>Exam Year </label> <input type="month"  name="oyearb" id="lname" value="<?php echo $oyearb; ?>" required /></div>                
                
      <div class="form-group"><label>Exam Number</label><input type="text" onkeyup="this.value = this.value.toUpperCase();" pattern="^[A-Za-z0-9 -]+$" class="form-control" name="onumberb" id="lname" placeholder="<?php if (@$onumberb <> ""){echo @$onumberb;} else {echo "Exam Number";}?>" value="<?php echo @$onumberb; ?>" required /></div>
<div class="form-group"><label>Subject/Grades</label>
<table width="80%">
  <tr>
    <td><select name="olevelsb1" id="olevelsb1" class="form-control" required>
							  <option value="<?php if (@$olevelsb1 <> ""){echo @$olevelsb1;} else {echo "";}?>" selected><?php if (@$olevelsb1 <> ""){echo @$olevelsb1;} else {echo "- Subject 1 -";}?></option>
							  <option value='Mathematics'>Mathematics</option>
							  <option value='English'>English</option>
							  <option value='Further-Mathematics'>Further-Mathematics</option>
							  <option value='Lit-In-English'>Lit in English</option>
							  <option value='Biology'>Biology</option>
							  <option value='Chemistry'>Chemistry</option>
							  <option value='Physics'>Physics</option>
							  <option value='Agricultural-Science'>Agricultural Science</option>
							  <option value='Economics'>Economics</option>
							  <option value='Geography'>Geography</option>
							  <option value='Government'>Government</option>
							  <option value='C.R.K'>Christian Studies</option>
							  <option value='Islamic-Studies'>Islamic Studies</option>

							</select></td>
    <td><select name="olevelgb1" id="olevelgb1" class="form-control" required>
							  <option value="<?php if (@$olevelgb1 <> ""){echo @$olevelgb1;} else {echo "";}?>" selected><?php if (@$olevelgb1 <> ""){echo @$olevelgb1;} else {echo "- Grade -";}?></option>
							  <option value='A1'>A1</option>
							  <option value='B2'>B2</option>
							  <option value='B3'>B3</option>
							  <option value='C4'>C4</option>
							  <option value='C5'>C5</option>
							  <option value='C6'>C6</option>
							  <option value='P7'>P7</option>
							  <option value='E8'>E8</option>
							  <option value='F9'>F9</option>

							</select></td>
  </tr>
  <tr>
    <td><select name="olevelsb2" id="olevelsb2" class="form-control" required>
      <option value="<?php if (@$olevelsb2 <> ""){echo @$olevelsb2;} else {echo "";}?>" selected>
        <?php if (@$olevelsb2 <> ""){echo @$olevelsb2;} else {echo "- Subject 2 -";}?>
        </option>
      <option value='Mathematics'>Mathematics</option>
      <option value='English'>English</option>
      <option value='Further-Mathematics'>Further-Mathematics</option>
      <option value='Lit-In-English'>Lit in English</option>
      <option value='Biology'>Biology</option>
      <option value='Chemistry'>Chemistry</option>
      <option value='Physics'>Physics</option>
      <option value='Agricultural-Science'>Agricultural Science</option>
      <option value='Economics'>Economics</option>
      <option value='Geography'>Geography</option>
      <option value='Government'>Government</option>
      <option value='C.R.K'>Christian Studies</option>
      <option value='Islamic-Studies'>Islamic Studies</option>
    </select></td>
    <td><select name="olevelgb2" id="olevelgb2" class="form-control" required>
      <option value="<?php if (@$olevelgb2 <> ""){echo @$olevelgb2;} else {echo "";}?>" selected>
        <?php if (@$olevelgb2 <> ""){echo @$olevelgb2;} else {echo "- Grade -";}?>
        </option>
      <option value='A1'>A1</option>
      <option value='B2'>B2</option>
      <option value='B3'>B3</option>
      <option value='C4'>C4</option>
      <option value='C5'>C5</option>
      <option value='C6'>C6</option>
      <option value='P7'>P7</option>
      <option value='E8'>E8</option>
      <option value='F9'>F9</option>
    </select></td>
  </tr>
  <tr>
    <td><select name="olevelsb3" id="olevelsb3" class="form-control" required>
      <option value="<?php if (@$olevelsb3 <> ""){echo @$olevelsb3;} else {echo "";}?>" selected>
        <?php if (@$olevelsb3 <> ""){echo @$olevelsb3;} else {echo "- Subject 3 -";}?>
        </option>
      <option value='Mathematics'>Mathematics</option>
      <option value='English'>English</option>
      <option value='Further-Mathematics'>Further-Mathematics</option>
      <option value='Lit-In-English'>Lit in English</option>
      <option value='Biology'>Biology</option>
      <option value='Chemistry'>Chemistry</option>
      <option value='Physics'>Physics</option>
      <option value='Agricultural-Science'>Agricultural Science</option>
      <option value='Economics'>Economics</option>
      <option value='Geography'>Geography</option>
      <option value='Government'>Government</option>
      <option value='C.R.K'>Christian Studies</option>
      <option value='Islamic-Studies'>Islamic Studies</option>
    </select></td>
    <td><select name="olevelgb3" id="olevelgb3" class="form-control" required>
      <option value="<?php if (@$olevelgb3 <> ""){echo @$olevelgb3;} else {echo "";}?>" selected>
        <?php if (@$olevelgb3 <> ""){echo @$olevelgb3;} else {echo "- Grade -";}?>
        </option>
      <option value='A1'>A1</option>
      <option value='B2'>B2</option>
      <option value='B3'>B3</option>
      <option value='C4'>C4</option>
      <option value='C5'>C5</option>
      <option value='C6'>C6</option>
      <option value='P7'>P7</option>
      <option value='E8'>E8</option>
      <option value='F9'>F9</option>
    </select></td>
  </tr>
  <tr>
    <td><select name="olevelsb4" id="olevelsb4" class="form-control" required>
      <option value="<?php if (@$olevelsb4 <> ""){echo @$olevelsb4;} else {echo "";}?>" selected>
        <?php if (@$olevelsb4 <> ""){echo @$olevelsb4;} else {echo "- Subject 4 -";}?>
        </option>
      <option value='Mathematics'>Mathematics</option>
      <option value='English'>English</option>
      <option value='Further-Mathematics'>Further-Mathematics</option>
      <option value='Lit-In-English'>Lit in English</option>
      <option value='Biology'>Biology</option>
      <option value='Chemistry'>Chemistry</option>
      <option value='Physics'>Physics</option>
      <option value='Agricultural-Science'>Agricultural Science</option>
      <option value='Economics'>Economics</option>
      <option value='Geography'>Geography</option>
      <option value='Government'>Government</option>
      <option value='C.R.K'>Christian Studies</option>
      <option value='Islamic-Studies'>Islamic Studies</option>
    </select></td>
    <td><select name="olevelgb4" id="olevelgb4" class="form-control" required>
      <option value="<?php if (@$olevelgb4 <> ""){echo @$olevelgb4;} else {echo "";}?>" selected>
        <?php if (@$olevelgb4 <> ""){echo @$olevelgb4;} else {echo "- Grade -";}?>
        </option>
      <option value='A1'>A1</option>
      <option value='B2'>B2</option>
      <option value='B3'>B3</option>
      <option value='C4'>C4</option>
      <option value='C5'>C5</option>
      <option value='C6'>C6</option>
      <option value='P7'>P7</option>
      <option value='E8'>E8</option>
      <option value='F9'>F9</option>
    </select></td>
  </tr>
  <tr>
    <td><select name="olevelsb5" id="olevelsb5" class="form-control" required>
      <option value="<?php if (@$olevelsb5 <> ""){echo @$olevelsb5;} else {echo "";}?>" selected>
        <?php if (@$olevelsb5 <> ""){echo @$olevelsb5;} else {echo "- Subject 5 -";}?>
        </option>
      <option value='Mathematics'>Mathematics</option>
      <option value='English'>English</option>
      <option value='Further-Mathematics'>Further-Mathematics</option>
      <option value='Lit-In-English'>Lit in English</option>
      <option value='Biology'>Biology</option>
      <option value='Chemistry'>Chemistry</option>
      <option value='Physics'>Physics</option>
      <option value='Agricultural-Science'>Agricultural Science</option>
      <option value='Economics'>Economics</option>
      <option value='Geography'>Geography</option>
      <option value='Government'>Government</option>
      <option value='C.R.K'>Christian Studies</option>
      <option value='Islamic-Studies'>Islamic Studies</option>
    </select></td>
    <td><select name="olevelgb5" id="olevelgb5" class="form-control" required>
      <option value="<?php if (@$olevelgb5 <> ""){echo @$olevelgb5;} else {echo "";}?>" selected>
        <?php if (@$olevelgb5 <> ""){echo @$olevelgb5;} else {echo "- Grade -";}?>
        </option>
      <option value='A1'>A1</option>
      <option value='B2'>B2</option>
      <option value='B3'>B3</option>
      <option value='C4'>C4</option>
      <option value='C5'>C5</option>
      <option value='C6'>C6</option>
      <option value='P7'>P7</option>
      <option value='E8'>E8</option>
      <option value='F9'>F9</option>
    </select></td>
  </tr>
  <tr>
    <td><select name="olevelsb6" id="olevelsb6" class="form-control" required>
      <option value="<?php if (@$olevelsb6 <> ""){echo @$olevelsb6;} else {echo "";}?>" selected>
        <?php if (@$olevelsb6 <> ""){echo @$olevelsb6;} else {echo "- Subject 6 -";}?>
        </option>
      <option value='Mathematics'>Mathematics</option>
      <option value='English'>English</option>
      <option value='Further-Mathematics'>Further-Mathematics</option>
      <option value='Lit-In-English'>Lit in English</option>
      <option value='Biology'>Biology</option>
      <option value='Chemistry'>Chemistry</option>
      <option value='Physics'>Physics</option>
      <option value='Agricultural-Science'>Agricultural Science</option>
      <option value='Economics'>Economics</option>
      <option value='Geography'>Geography</option>
      <option value='Government'>Government</option>
      <option value='C.R.K'>Christian Studies</option>
      <option value='Islamic-Studies'>Islamic Studies</option>
    </select></td>
    <td><select name="olevelgb6" id="olevelgb6" class="form-control" required>
      <option value="<?php if (@$olevelgb6 <> ""){echo @$olevelgb6;} else {echo "";}?>" selected>
        <?php if (@$olevelgb6 <> ""){echo @$olevelgb6;} else {echo "- Grade -";}?>
        </option>
      <option value='A1'>A1</option>
      <option value='B2'>B2</option>
      <option value='B3'>B3</option>
      <option value='C4'>C4</option>
      <option value='C5'>C5</option>
      <option value='C6'>C6</option>
      <option value='P7'>P7</option>
      <option value='E8'>E8</option>
      <option value='F9'>F9</option>
    </select></td>
  </tr>
  <tr>
    <td><select name="olevelsb7" id="olevelsb7" class="form-control" required>
      <option value="<?php if (@$olevelsb7 <> ""){echo @$olevelsb7;} else {echo "";}?>" selected>
        <?php if (@$olevelsb7 <> ""){echo @$olevelsb7;} else {echo "- Subject 7 -";}?>
        </option>
      <option value='Mathematics'>Mathematics</option>
      <option value='English'>English</option>
      <option value='Further-Mathematics'>Further-Mathematics</option>
      <option value='Lit-In-English'>Lit in English</option>
      <option value='Biology'>Biology</option>
      <option value='Chemistry'>Chemistry</option>
      <option value='Physics'>Physics</option>
      <option value='Agricultural-Science'>Agricultural Science</option>
      <option value='Economics'>Economics</option>
      <option value='Geography'>Geography</option>
      <option value='Government'>Government</option>
      <option value='C.R.K'>Christian Studies</option>
      <option value='Islamic-Studies'>Islamic Studies</option>
    </select></td>
    <td><select name="olevelgb7" id="olevelgb7" class="form-control" required>
      <option value="<?php if (@$olevelgb7 <> ""){echo @$olevelgb7;} else {echo "";}?>" selected>
        <?php if (@$olevelgb7 <> ""){echo @$olevelgb7;} else {echo "- Grade -";}?>
        </option>
      <option value='A1'>A1</option>
      <option value='B2'>B2</option>
      <option value='B3'>B3</option>
      <option value='C4'>C4</option>
      <option value='C5'>C5</option>
      <option value='C6'>C6</option>
      <option value='P7'>P7</option>
      <option value='E8'>E8</option>
      <option value='F9'>F9</option>
    </select></td>
  </tr>
  <tr>
    <td><select name="olevelsb8" id="olevelsb8" class="form-control" required>
      <option value="<?php if (@$olevelsb8 <> ""){echo @$olevelsb8;} else {echo "";}?>" selected>
        <?php if (@$olevelsb8 <> ""){echo @$olevelsb8;} else {echo "- Subject 8 -";}?>
        </option>
      <option value='Mathematics'>Mathematics</option>
      <option value='English'>English</option>
      <option value='Further-Mathematics'>Further-Mathematics</option>
      <option value='Lit-In-English'>Lit in English</option>
      <option value='Biology'>Biology</option>
      <option value='Chemistry'>Chemistry</option>
      <option value='Physics'>Physics</option>
      <option value='Agricultural-Science'>Agricultural Science</option>
      <option value='Economics'>Economics</option>
      <option value='Geography'>Geography</option>
      <option value='Government'>Government</option>
      <option value='C.R.K'>Christian Studies</option>
      <option value='Islamic-Studies'>Islamic Studies</option>
    </select></td>
    <td><select name="olevelgb8" id="olevelgb8" class="form-control" required>
      <option value="<?php if (@$olevelgb8 <> ""){echo @$olevelgb8;} else {echo "";}?>" selected>
        <?php if (@$olevelgb8 <> ""){echo @$olevelgb8;} else {echo "- Grade -";}?>
        </option>
      <option value='A1'>A1</option>
      <option value='B2'>B2</option>
      <option value='B3'>B3</option>
      <option value='C4'>C4</option>
      <option value='C5'>C5</option>
      <option value='C6'>C6</option>
      <option value='P7'>P7</option>
      <option value='E8'>E8</option>
      <option value='F9'>F9</option>
    </select></td>
  </tr>
  <tr>
    <td><select name="olevelsb9" id="olevelsb9" class="form-control" required>
      <option value="<?php if (@$olevelsb9 <> ""){echo @$olevelsb9;} else {echo "";}?>" selected>
        <?php if (@$olevelsb9 <> ""){echo @$olevelsb9;} else {echo "- Subject 9 -";}?>
        </option>
      <option value='Mathematics'>Mathematics</option>
      <option value='English'>English</option>
      <option value='Further-Mathematics'>Further-Mathematics</option>
      <option value='Lit-In-English'>Lit in English</option>
      <option value='Biology'>Biology</option>
      <option value='Chemistry'>Chemistry</option>
      <option value='Physics'>Physics</option>
      <option value='Agricultural-Science'>Agricultural Science</option>
      <option value='Economics'>Economics</option>
      <option value='Geography'>Geography</option>
      <option value='Government'>Government</option>
      <option value='C.R.K'>Christian Studies</option>
      <option value='Islamic-Studies'>Islamic Studies</option>
    </select></td>
    <td><select name="olevelgb9" id="olevelgb9" class="form-control" required>
      <option value="<?php if (@$olevelgb9 <> ""){echo @$olevelgb9;} else {echo "";}?>" selected>
        <?php if (@$olevelgb9 <> ""){echo @$olevelgb9;} else {echo "- Grade -";}?>
        </option>
      <option value='A1'>A1</option>
      <option value='B2'>B2</option>
      <option value='B3'>B3</option>
      <option value='C4'>C4</option>
      <option value='C5'>C5</option>
      <option value='C6'>C6</option>
      <option value='P7'>P7</option>
      <option value='E8'>E8</option>
      <option value='F9'>F9</option>
    </select></td>
  </tr>
</table>
</div>  

      <?php }?>       
             
			  <hr />
				
				<div class="form-group">
					<button class="btn btn-primary"> - SUBMIT RESULT - </button>
				</div>
				
			</form>
            
            </div>
            
            </div>
		
	</div><?php }?>
  </div>
	
</div>


<script src="../onlineapp/assets/jquery-1.12.4-jquery.min.js"></script>
<script src="../onlineapp/assets/js/bootstrap.min.js"></script>

<script type="text/javascript">
$(document).ready(function() {	
	
	// submit form using $.ajax() method
	
	$('#reg-form').submit(function(e){
		
		e.preventDefault(); // Prevent Default Submission
		
		$.ajax({
			url: 'osubmit.php',
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
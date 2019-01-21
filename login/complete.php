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
	$submit=mysqli_query($conn,"SELECT * FROM submit_tbl WHERE AppNumber='$userRow[userName]'");
	$userSubmit=mysqli_fetch_array($submit);

	$pass=mysqli_query($conn,"SELECT * FROM passport_tbl WHERE AppNumber='$userRow[userName]'");
	$userPass=mysqli_fetch_array($pass);
	
	$checkolevela=mysqli_query($conn,"SELECT * FROM academicinfo_tbl WHERE AppNumber='$userRow[userName]'");
	$smsolevel=mysqli_fetch_array($checkolevela);
			
			if ($smsolevel['OlevelNumber'] > 0){
			$show = 0;
			$show = $show + 1;
			$selectolevela=mysqli_query($conn,"SELECT * FROM olevel1info_tbl WHERE AppNumber='$userRow[userName]'");
			$collectolevela=mysqli_fetch_array($selectolevela);

		$otypea = $collectolevela['OlevelType'];
		$oyeara = $collectolevela['ExamYear'];
		$onumbera = $collectolevela['ExamNumber'];
		$olevels1 = $collectolevela['OlevelS1'];
		$olevels2 = $collectolevela['OlevelS2'];
		$olevels3 = $collectolevela['OlevelS3'];
		$olevels4 = $collectolevela['OlevelS4'];
		$olevels5 = $collectolevela['OlevelS5'];
		$olevels6 = $collectolevela['OlevelS6'];
		$olevels7 = $collectolevela['OlevelS7'];
		$olevels8 = $collectolevela['OlevelS8'];
		$olevels9 = $collectolevela['OlevelS9'];
		$olevelg1 = $collectolevela['OlevelG1'];
		$olevelg2 = $collectolevela['OlevelG2'];
		$olevelg3 = $collectolevela['OlevelG3'];
		$olevelg4 = $collectolevela['OlevelG4'];
		$olevelg5 = $collectolevela['OlevelG5'];
		$olevelg6 = $collectolevela['OlevelG6'];
		$olevelg7 = $collectolevela['OlevelG7'];
		$olevelg8 = $collectolevela['OlevelG8'];
		$olevelg9 = $collectolevela['OlevelG9'];
				
				}

			if ($smsolevel['OlevelNumber'] == 2){
$show = $show + 1;
			$selectolevelb=mysqli_query($conn,"SELECT * FROM olevel2info_tbl WHERE AppNumber='$userRow[userName]'");
			$collectolevelb=mysqli_fetch_array($selectolevelb);

		$otypeb = $collectolevelb['OlevelType'];
		$oyearb = $collectolevelb['ExamYear'];
		$onumberb = $collectolevelb['ExamNumber'];
		$olevelsb1 = $collectolevelb['OlevelS1'];
		$olevelsb2 = $collectolevelb['OlevelS2'];
		$olevelsb3 = $collectolevelb['OlevelS3'];
		$olevelsb4 = $collectolevelb['OlevelS4'];
		$olevelsb5 = $collectolevelb['OlevelS5'];
		$olevelsb6 = $collectolevelb['OlevelS6'];
		$olevelsb7 = $collectolevelb['OlevelS7'];
		$olevelsb8 = $collectolevelb['OlevelS8'];
		$olevelsb9 = $collectolevelb['OlevelS9'];
		$olevelgb1 = $collectolevelb['OlevelG1'];
		$olevelgb2 = $collectolevelb['OlevelG2'];
		$olevelgb3 = $collectolevelb['OlevelG3'];
		$olevelgb4 = $collectolevelb['OlevelG4'];
		$olevelgb5 = $collectolevelb['OlevelG5'];
		$olevelgb6 = $collectolevelb['OlevelG6'];
		$olevelgb7 = $collectolevelb['OlevelG7'];
		$olevelgb8 = $collectolevelb['OlevelG8'];
		$olevelgb9 = $collectolevelb['OlevelG9'];
				
				}

?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>APPLICATION SUCCESSFUL - <?php echo $userRow['userName']; ?></title>
<link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css"  />
<link rel="stylesheet" href="style.css" type="text/css" />
<style>
	.wrapper{
		padding-top: 50px;
	}
	#form-content{
		margin: 0 auto;
		width: 600px;
	}
</style>
    <script language="javascript" type="text/javascript">
        function printDiv(divID) {
            //Get the HTML of div
            var divElements = document.getElementById(divID).innerHTML;
            //Get the HTML of whole page
            var oldPage = document.body.innerHTML;

            //Reset the page's HTML with div's HTML only
            document.body.innerHTML = 
              "<html><head><title></title></head><body>" + 
              divElements + "</body>";

            //Print Page
            window.print();

            //Restore orignal HTML
            document.body.innerHTML = oldPage;

          
        }
    </script>
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
            <li><a href="complete.php">Completed Form</a></li>
            <li><a href="#">Admission Status</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
			  <span class="glyphicon glyphicon-user"></span>&nbsp;Application Number:<strong><?php echo $userRow['userName']; ?> </strong>&nbsp;<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="logout.php?logout"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Sign Out</a></li>
              </ul>
            </li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav> 

	<div id="wrapper">
<div style="background-image: url(../onlineapp/ccslogo/header.jpg); background-repeat: no-repeat center center; background-size: cover; height: 100px"></div>
	<div class="container">
    
    	<div class="page-header">
    	<h3>Center for Continuous Studies (Part-Time) 2018/2019 Application (PRINT FORM)</h3>
    	</div>
        
<?php if (($userSubmit['Payment'] == 1) and ($userSubmit['Information'] == 1) and ($userSubmit['Passport'] == 1) and($userSubmit['Verification'] == 1) and ($userSubmit['Olevel'] == 1)){?>

       <div class="col-lg-12">
<div id="printablediv"> 			<div id="form-content">
            
<table width="100%" border="0" class="table table-striped">
<tr>
  <td height="100" colspan="3"><div style="background-color:#FFF"><img name="" src="logo green(png)2.jpg" width="484" height="117" alt="">  </div></td>
  </tr>
  <tr>
    <td width="32%" rowspan="5"><img name="" src="imageupload/<?php if ($userPass['Passport'] <> "") {echo $userPass['Passport'];} else {echo "no-image.jpg";} ?>" width="115" height="120" alt=""></td>
    <td colspan="2"><strong>Full Name:</strong> <span><?php echo $sname; echo " "; echo $fname; echo " "; echo $oname; ?></span></td>
    </tr>
  <tr>
    <td colspan="2"><strong>Application Number:</strong> <span><?php echo $userRow['userName']; ?></span></td>
    </tr>
  <tr>
    <td colspan="2"><strong>Phone Number:</strong> <span><?php echo $phoneno; ?></span></td>
    </tr>
  <tr>
    <td colspan="2"><strong>Email Address:</strong> <span><?php echo $email; ?></span></td>
    </tr>
  <tr>
    <td colspan="2"><strong>Programme:</strong> <span><?php echo $level; ?> <?php echo $programme; ?> </span></td>
    </tr>
  <tr>
    <td height="52" colspan="3"><strong>PERSONAL INFORMATION (SECTION A)</strong></td>
    </tr>
  <tr>
    <td colspan="3"><table width="100%" border="0">
      <tr>
        <td width="50%"><strong>Date of Birth:</strong> <span><?php echo $dob; ?></span></td>
        <td width="50%"><strong>Gender:</strong> <span><?php echo $gender; ?></span></td>
      </tr>
      <tr>
        <td><strong>State of Origin:</strong> <span><?php echo $state; ?></span></td>
        <td><strong>L.G.A.:</strong> <span><?php echo $lga; ?></span></td>
      </tr>
      <tr>
        <td colspan="2"><strong>Residential Address:</strong> <span><?php echo $houseadd; ?></span></td>
        </tr>
    </table></td>
    </tr>
  <tr>
    <td height="51" colspan="3"><strong>ACADEMIC INFORMATION (SECTION B)</strong></td>
    </tr>
  <tr>
    <td colspan="3"><strong>Primary School:</strong> <span><?php echo $prisch; ?></span></td>
    </tr>
  <tr>
    <td><strong>From:</strong>  <span><?php echo $prifrom; ?></span></td>
    <td width="34%"><strong>To:</strong> <span><?php echo $prito; ?></span></td>
    <td width="34%">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3"><strong>Secondary School:</strong> <span><?php echo $secsch; ?></span></td>
    </tr>
  <tr>
    <td><strong>From:</strong> <span><?php echo $secfrom; ?></span></td>
    <td><strong>To:</strong> <span><?php echo $secto; ?></span></td>
    <td>&nbsp;</td>
  </tr>
 <?php if ($level == 'HND') {?> <tr>
    <td colspan="3"><strong>Higher Institution:</strong> <span><?php echo $hname; ?></span></td>
    </tr>
  <tr>
    <td><strong>From:</strong> <span><?php echo $hfrom; ?></span></td>
    <td><strong>To:</strong> <span><?php echo $hto; ?></span></td>
    <td>&nbsp;</td>
  </tr>
<?php }?>  <tr>
    <td height="49" colspan="3"><strong>PARENTS/GUARDIAN INFORMATION (SECTION C)</strong></td>
    </tr>
  <tr>
    <td colspan="3"><strong>Parent/Guardian Name:</strong> <span><?php echo $pgname; ?></span></td>
    </tr>
  <tr>
    <td colspan="3"><strong>Phone Number:</strong> <span><?php echo $pgnum; ?></span></td>
    </tr>
  <tr>
    <td colspan="3"><strong>Address:</strong> <span><?php echo $pgadd; ?></span></td>
    </tr>
  <tr>
    <td height="46" colspan="3"><strong>NEXT OF KIN INFORMATION (SECTION D)</strong></td>
    </tr>
  <tr>
    <td colspan="3"><strong>Next of Kin Name:</strong> <span><?php echo $nokname; ?></span></td>
    </tr>
  <tr>
    <td colspan="3"><table width="100%" border="0">
      <tr>
        <td><strong>Phone Number:</strong> <span><?php echo $noknum; ?></span></td>
        <td><strong>Relationship:</strong> <span><?php echo $nokrelationship ?></span></td>
      </tr>
    </table></td>
    </tr>
  <tr>
    <td colspan="3"><strong>Address:</strong> <span><?php echo $nokadd; ?></td>
    </tr>
  <tr>
    <td height="45" colspan="3"><strong>O'LEVEL INFORMATION (SECTION E) <?php echo $show; ?> SITTING(s)</strong><span></span></td>
    </tr>
  <tr>
    <td colspan="3"><table width="100%" border="0">
      <tr>
        <td width="50%">
        <table width="100%" border="0" class="table table-striped">
          <tr>
            <td colspan="2"><strong>Exam Name:</strong> <span><?php echo $otypea; ?></span> <strong>Year:</strong> <span><?php echo $oyeara; ?></span></td>
            </tr>          <tr>
            <td colspan="2"><strong>Exam No.:</strong> <span><?php echo $onumbera; ?></span> </td>
            </tr>
         <tr>
            <td width="83%"><strong>Subjects</strong></td>
            <td width="17%"><strong>Grades</strong></td>
          </tr>
          <tr>
            <td><span><?php echo $olevels1; ?></span></td>
            <td><span><?php echo $olevelg1; ?></span></td>
          </tr>
          <tr>
            <td><span><?php echo $olevels1; ?></span></td>
            <td><span><?php echo $olevelg1; ?></span></td>
          </tr>
          <tr>
            <td><span><?php echo $olevels2; ?></span></td>
            <td><span><?php echo $olevelg2; ?></span></td>
          </tr>
          <tr>
            <td><span><?php echo $olevels3; ?></span></td>
            <td><span><?php echo $olevelg3; ?></span></td>
          </tr>
          <tr>
            <td><span><?php echo $olevels4; ?></span></td>
            <td><span><?php echo $olevelg4; ?></span></td>
          </tr>
          <tr>
            <td><span><?php echo $olevels5; ?></span></td>
            <td><span><?php echo $olevelg5; ?></span></td>
          </tr>
          <tr>
            <td><span><?php echo $olevels6; ?></span></td>
            <td><span><?php echo $olevelg6; ?></span></td>
          </tr>
          <tr>
            <td><span><?php echo $olevels7; ?></span></td>
            <td><span><?php echo $olevelg7; ?></span></td>
          </tr>
          <tr>
            <td><span><?php echo $olevels8; ?></span></td>
            <td><span><?php echo $olevelg8; ?></span></td>
          </tr>
          <tr>
            <td><span><?php echo $olevels9; ?></span></td>
            <td><span><?php echo $olevelg9; ?></span></td>
          </tr>
        </table></td>
        <td width="50%">
        
        <?php if ($show == 2) {?><table width="100%" border="0" class="table table-striped">
          <tr>
            <td colspan="2"><strong>Exam Name:</strong> <span><?php echo $otypeb; ?></span> <strong>Year:</strong> <span><?php echo $oyearb; ?></span></td>
          </tr>
          <tr>
            <td colspan="2"><strong>Exam No.:</strong> <span><?php echo $onumberb; ?></span></td>
          </tr>
          <tr>
            <td width="83%"><strong>Subjects</strong></td>
            <td width="17%"><strong>Grades</strong></td>
          </tr>
          <tr>
            <td><span><?php echo $olevelsb1; ?></span></td>
            <td><span><?php echo $olevelgb1; ?></span></td>
          </tr>
          <tr>
            <td><span><?php echo $olevelsb1; ?></span></td>
            <td><span><?php echo $olevelgb1; ?></span></td>
          </tr>
          <tr>
            <td><span><?php echo $olevelsb2; ?></span></td>
            <td><span><?php echo $olevelgb2; ?></span></td>
          </tr>
          <tr>
            <td><span><?php echo $olevelsb3; ?></span></td>
            <td><span><?php echo $olevelgb3; ?></span></td>
          </tr>
          <tr>
            <td><span><?php echo $olevelsb4; ?></span></td>
            <td><span><?php echo $olevelgb4; ?></span></td>
          </tr>
          <tr>
            <td><span><?php echo $olevelsb5; ?></span></td>
            <td><span><?php echo $olevelgb5; ?></span></td>
          </tr>
          <tr>
            <td><span><?php echo $olevelsb6; ?></span></td>
            <td><span><?php echo $olevelgb6; ?></span></td>
          </tr>
          <tr>
            <td><span><?php echo $olevelsb7; ?></span></td>
            <td><span><?php echo $olevelgb7; ?></span></td>
          </tr>
          <tr>
            <td><span><?php echo $olevelsb8; ?></span></td>
            <td><span><?php echo $olevelgb8; ?></span></td>
          </tr>
          <tr>
            <td><span><?php echo $olevelsb9; ?></span></td>
            <td><span><?php echo $olevelgb9; ?></span></td>
          </tr>
        </table><?php }?></td>
      </tr>
    </table></td>
    </tr>
      <tr>
    <td colspan="3"><h6>By Submitting this form you have agreed to our terms and conditions. Ensure you always check here to be updated when you have been offered admission. <strong>NOTE: </strong>Printing must be in colored</h6></td>
    </tr>  
      <tr>
    <td colspan="3"></td>
    </tr>  
</table>

    </div>    
	  </div>
</div>

       <div class="col-lg-12">
			<div id="form-content"><table><tr>
      <td colspan="3">						        <div class="form-group">
          <button class="btn btn-primary" onclick="javascript:printDiv('printablediv')" > - PRINT FORM - </button>
          </div>

  </td>
    </tr></table></div></div>
<?php }?>

    
    </div>
    
    </div>
    
    <script src="assets/jquery-1.11.3-jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    
</body>
</html>
<?php ob_end_flush(); ?>
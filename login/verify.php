<?php

if( $_POST ){

		$dob = trim($_POST['dob']);
		$dob = strip_tags($dob);
		$dob = htmlspecialchars($dob);

		$state = trim($_POST['state']);
		$state = strip_tags($state);
		$state = htmlspecialchars($state);

		$lga = trim($_POST['lga']);
		$lga = strip_tags($lga);
		$lga = htmlspecialchars($lga);

		$houseadd = trim($_POST['houseadd']);
		$houseadd = strip_tags($houseadd);
		$houseadd = htmlspecialchars($houseadd);

		$prisch = trim($_POST['prisch']);
		$prisch = strip_tags($prisch);
		$prisch = htmlspecialchars($prisch);

		$prifrom = trim($_POST['prisch']);
		$prisch = strip_tags($prisch);
		$prisch = htmlspecialchars($prisch);

		$prito = trim($_POST['prito']);
		$prito = strip_tags($prito);
		$prito = htmlspecialchars($prito);

		$secsch = trim($_POST['secsch']);
		$secsch = strip_tags($secsch);
		$secsch = htmlspecialchars($secsch);

		$secfrom = trim($_POST['secfrom']);
		$secfrom = strip_tags($secfrom);
		$secfrom = htmlspecialchars($secfrom);

		$secto = trim($_POST['secto']);
		$secto = strip_tags($secto);
		$secto = htmlspecialchars($secto);

		$pgname = trim($_POST['pgname']);
		$pgname = strip_tags($pgname);
		$pgname = htmlspecialchars($pgname);

		$pgnum = trim($_POST['pgnum']);
		$pgnum = strip_tags($pgnum);
		$pgnum = htmlspecialchars($pgnum);

		$pgadd = trim($_POST['pgadd']);
		$pgadd = strip_tags($pgadd);
		$pgadd = htmlspecialchars($pgadd);

		$nokname = trim($_POST['nokname']);
		$nokname = strip_tags($nokname);
		$nokname = htmlspecialchars($nokname);

		$noknum = trim($_POST['noknum']);
		$noknum = strip_tags($noknum);
		$noknum = htmlspecialchars($noknum);

		$nokadd = trim($_POST['nokadd']);
		$nokadd = strip_tags($nokadd);
		$nokadd = htmlspecialchars($nokadd);

		$nokrelationship = trim($_POST['nokrelationship']);
		$nokrelationship = strip_tags($nokrelationship);
		$nokrelationship = htmlspecialchars($nokrelationship);
    

}
?>
<?php include_once("imageupload/index.php"); ?>
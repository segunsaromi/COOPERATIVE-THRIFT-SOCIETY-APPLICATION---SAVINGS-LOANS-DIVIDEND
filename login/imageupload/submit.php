<?php

if( $_POST ){
	
	$appnumber = $_POST['appnumber'];
	$level = $_POST['select_prog'];
	$programme = $_POST['programme'];
	$session = $_POST['session'];
	$fname = $_POST['txt_fname'];
	$oname = $_POST['txt_oname'];
	$lname = $_POST['txt_lname'];
	$gender = $_POST['gender']; 
	$email = $_POST['txt_email'];
	$phno = $_POST['txt_contact']; 

	?>
    
	<form method="post" id="reg-form" autocomplete="off">
    <table class="table table-striped" border="0">
    
    <tr>
    <td colspan="2">
    	<div class="alert alert-info">
    		<strong>Success</strong>, Candidates Successfully Applied...
    	</div>
    </td>
    </tr>
    
    <tr>
    <td>Application No.</td>
    <td><strong><?php echo $appnumber; ?></strong></td>
    </tr>

    <tr>
    <td>Full Name</td>
    <td><strong><?php echo $lname; ?> <?php echo $oname; ?> <?php echo $fname; ?></strong></td>
    </tr>

    <tr>
    <td>Academic Session</td>
    <td><strong><?php echo $session; ?></strong></td>
    </tr>

    <tr>
    <td>Programme</td>
    <td><strong><?php echo $level; ?> <?php echo $programme; ?></strong></td>
    </tr>

    <tr>
    <td>Gender</td>
    <td><strong><?php echo $gender; ?></strong></td>
    </tr>
    <tr>
      <td>Your eMail</td>
      <td><strong><?php echo $email; ?></strong></td>
    </tr>
    
    <tr>
    <td>Contact No</td>
    <td><strong><?php echo $phno; ?></strong></td>
    </tr>
    
    </table>
				<div class="form-group">
				  <button class="btn btn-primary"> Click to PAY </button>
				</div>
				
			</form>
<script src="assets/jquery-1.12.4-jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>

<script type="text/javascript">
$(document).ready(function() {	
	
	// submit form using $.ajax() method
	
	$('#reg-form').submit(function(e){
		
		e.preventDefault(); // Prevent Default Submission
		
		$.ajax({
			url: 'submit.php',
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
    <?php
	
}
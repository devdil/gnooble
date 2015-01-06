<?php
/*
Author : Diljit Ramachandran <diljitpr@gmail.com> ,Sougata Nair <maxxon15@gmail.com>
Date : 6th January,2015
Last Modified :6th January 2015.

*/

 include '../includes/DatabaseConnect.php';
 include '../includes/config.php';

//name value constants
define('STUDENT',14300);
define('ADMIN',00341);

if ($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['submit']))
	{
		$status = '';
		$name = htmlspecialchars(trim($_POST['name']));
		$department = htmlspecialchars(trim($_POST['department']));
		$emailid = htmlspecialchars(trim($_POST['emailid']));
		$password = htmlspecialchars(trim($_POST['password']));
		$secureid = htmlspecialchars(trim($_POST['secureid']));
		$contactnumber = htmlspecialchars(trim($_POST['contactnumber']));

        // check if the secure id entered is "14300" if yes then set the user type to student else admin
		if ($secureid == STUDENT)
			$type = 'S';
		else if ($secureid == ADMIN)
			$type = 'T';
		else 
			$type = 'Invalid';

		if (!empty($name) && !empty($department) && !empty($password) && !empty($secureid) && !empty($emailid))
			{
					
					if ($type === 'Invalid')
					{
						$status =  'Invalid Secure Id!';
					}
					else
					{
						
						$dbinstance = new DatabaseConnect($config);
						$connection = $dbinstance->connect();
						
						if ($connection)
						{
							$queryString = 'INSERT into UserDetails(Name,EmailId,Department,ContactNumber,Type,Password) VALUES(:username,:emailid,:department,:contactnumber,:type,:password)';
							$bindings = array(
											  'username' => $name,
											  'emailid' => $emailid,
											  'department' => $department,
											  'contactnumber' => $contactnumber,
									          'type' => $type,
									          'password' => $password
									
											 );

							$executequery = $dbinstance->insert($connection,$bindings,$queryString);
							
							 if ($executequery === true)
							 {
							 	$status = 'Successfully Registered!';
							 }
							 
							
							 if ($executequery === 23000) {
                                 $status = 'Email Id already exists!Please choose another one!';
                                 var_dump($executequery);
                             }
						}
								 	
					}
			}
	
			else
			{
                //either of the user fields might be missing.Alert the user with an appropiate message
				$status = 'Please fill up the form correctly!';
			
			}
	}

?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Gnooble: Register</title>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:700,300,600,400' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="../assets/css/main.css">

</head>
<body class="gatekeeper">
	<img src="../assets/images/landing.jpg" class="keeper-bg">
	<div class="container">
		
		<?php if(isset($status) && isset($_POST['submit'])): ?>
		<div class="alert alert-danger alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<p><?php echo $status; ?></p>
		</div>
		<?php endif; ?>

		<form action="/gnooble/register/index.php" method="post" class="form-horizontal col-xs-5 center-block register-form pull-none entry-form">
		  <h1 class="page-header">Gnooble</h1>
		  <h3>Register with an account. <br><small>Its free!</small></h3>
		  <div class="form-group">
		    <label for="input-name" class="col-sm-4 control-label">Full Name</label>
		    <div class="col-sm-8">
		      <input type="text" class="form-control" name="name" id="input-name" placeholder="What is your full name?">
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="input-email" class="col-sm-4 control-label">Email</label>
		    <div class="col-sm-8">
		      <input type="email" class="form-control" name="emailid" input-email" placeholder="Your email address?">
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="input-tel" class="col-sm-4 control-label">Contact Number</label>
		    <div class="col-sm-8">
		      <input type="tel" class="form-control" name="contactnumber" input-tel" placeholder="Your contact number?">
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="input-dept" class="col-sm-4 control-label">Department</label>
		    <div class="col-sm-8">
		    	<select name="department" id="input-dept" class="form-control">
		    		<option value="CSE">Computer Science</option>
		    		<option value="EE">Electrical Engineering</option>
		    		<option value="ECE">Electronics Engineering</option>
		    		<option value="IT">Information Technology</option>
		    		<option value="FT">Food Technology</option>
		    	</select>
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="input-password" class="col-sm-4 control-label">Password</label>
		    <div class="col-sm-8">
		      <input type="password" class="form-control" name="password" id="input-password" placeholder="Password">
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="input-secureid" class="col-sm-4 control-label">Secure ID</label>
		    <div class="col-sm-8">
		      <input type="password" class="form-control" name="secureid" id="input-secureid" placeholder="Secure ID" >
		    </div>
		  </div>
		  
		  <div class="form-group">
		    <div class="col-sm-offset-4 col-sm-8">
		      <button type="submit" class="btn btn-success pull-right">Register</button>
		    </div>
		  </div>

		</form>
	</div>
	

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="../assets/js/bootstrap.min.js"></script>
</body>
</html>
<?php 
include 'DatabaseConnect.php';
include 'config.php';


	if ($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['submit']))
	{
		$status = '';
		$name = htmlspecialchars(trim($_POST['name']));
		$department = htmlspecialchars(trim($_POST['department']));
		$emailid = htmlspecialchars(trim($_POST['emailid']));
		$password = htmlspecialchars(trim($_POST['password']));
		$secureid = htmlspecialchars(trim($_POST['secureid']));
		$contactnumber = htmlspecialchars(trim($_POST['contactnumber']));

		if ($secureid == '14300')
			$type = 'S';
		else if ($secureid == '00341')
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
							 	$status = 'Sucessfully Registered!';
							 }
							 
							
							 if ($executequery === 23000)
								{
							 		$status = 'Email Id already exists!Please choose another one!';
							 		var_dump($executequery);
								}


								 
								 }
								 	
							}
			}
	
			else
			{
				$status = 'Please fill up the form correctly!';
			
			}

		require 'signup.php';

	}


			

?>


<?php 

include '../includes/config.php';
include '../includes/DatabaseConnect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login']))
{

	
	if (!empty($_POST['useremail']) && !empty($_POST['password']))
	{
		$useremail = htmlspecialchars($_POST['useremail']);
		$password = htmlspecialchars($_POST['password']);
		
			//validate user and password from the database
			
				
				
				$dbinstance = new DatabaseConnect($config);
				$connection = $dbinstance->connect();
					
				if ($connection)
				{
					
					$queryString = 'SELECT * FROM UserDetails WHERE EmailId = :useremail AND Password = :password';
					$bindings = array(
										'useremail' => $useremail,
										'password'  =>  $password
								 );
					$result = $dbinstance->read($connection,$bindings,$queryString);
						
					if (($result->rowCount())>0)
					{
						$rows = $result->fetchAll();
						session_start();
						$_SESSION['username'] = $rows[0]['Name'];
						$_SESSION['emailid'] = $rows[0]['EmailId'];
						$_SESSION['department'] = $rows[0]['Department'];
						$_SESSION['userid'] = $rows[0]['UserId'];
							unset($status);
						  //redirect to student.php if the user is a student else welcome.php for teachers
						  	 if ($rows[0]['Type']=='S')
						  	 	header('Location: student/student.php');
						  	 else
						  	 	header('Location: admin/welcome.php');
						
					}
				
					else
					{
						$status = 'Invalid Login Credentials !';
					}
				
				} 

		}
	else
		//the user has submitted empty form .Notify :Empty Form Submitted
	$status = 'Empty Form Submitted!';
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Gnooble: Login</title>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:700,300,600,400' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="../assets/css/main.css">

</head>
<body class="gatekeeper">
	<img src="../assets/images/landing.jpg" class="keeper-bg">
	<div class="container">
		<?php if (!empty($status) && isset($status)): ?>
			<div class="alert alert-danger alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<p>
					<?php echo "Alert! ".$status; ?>
				</p>  
			</div>
		<?php endif; ?>
		<form class="col-xs-4 login-form center-block pull-none entry-form">
		  <h1 class="page-header">Gnooble</h1>
		  <h3>Login</h3>
		  <div class="form-group">
		    <label for="email">Email address</label>
		    <input type="email" class="form-control" id="email" placeholder="Enter your email">
		  </div>
		  <div class="form-group">
		    <label for="pass">Password</label>
		    <input type="password" class="form-control" id="pass" placeholder="Password">
		  </div>
		  
		  <button type="submit" class="btn btn-success pull-right">Submit</button>
		</form>
	</div>
	

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="../assets/js/bootstrap.min.js"></script>
</body>
</html>
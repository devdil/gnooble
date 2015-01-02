<?php
include 'config.php';
include 'DatabaseConnect.php';

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
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Bootstrap 3, from LayoutIt!</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">

	<!--link rel="stylesheet/less" href="less/bootstrap.less" type="text/css" /-->
	<!--link rel="stylesheet/less" href="less/responsive.less" type="text/css" /-->
	<!--script src="js/less-1.3.3.min.js"></script-->
	<!--append ‘#!watch’ to the browser URL, then refresh the page. -->
	
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">

  <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
  <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
  <![endif]-->

  <!-- Fav and touch icons -->
  <link rel="apple-touch-icon-precomposed" sizes="144x144" href="img/apple-touch-icon-144-precomposed.png">
  <link rel="apple-touch-icon-precomposed" sizes="114x114" href="img/apple-touch-icon-114-precomposed.png">
  <link rel="apple-touch-icon-precomposed" sizes="72x72" href="img/apple-touch-icon-72-precomposed.png">
  <link rel="apple-touch-icon-precomposed" href="img/apple-touch-icon-57-precomposed.png">
  <link rel="shortcut icon" href="img/favicon.png">
  
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/scripts.js"></script>
</head>

<body>
<div class="container">
	<div class="row clearfix">
		<div class="col-md-12 column">
			<nav class="navbar navbar-default" role="navigation">
				<div class="navbar-header">
					 <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"> <span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button> <a class="navbar-brand" href="index.php">Home</a>
				</div>
				
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav">
						
						<li>
							<a href="features.php">Features</a>
						</li>
						<li>
							<a href="downloads.php">Downloads</a>
						</li>
						<li>
							<a href="usage.php">Usage</a>
						</li>
						<li class="dropdown">
							 <a href="#" class="dropdown-toggle" data-toggle="dropdown">Practice<strong class="caret"></strong></a>
							<ul class="dropdown-menu">
								<li>
									<a href="#">Action</a>
								</li>
								<li>
									<a href="#">Another action</a>
								</li>
								<li>
									<a href="#">Something else here</a>
								</li>
								<li class="divider">
								</li>
								<li>
									<a href="#">Separated link</a>
								</li>
								<li class="divider">
								</li>
								<li>
									<a href="#">One more separated link</a>
								</li>
							</ul>
						</li>
					</ul>
					<form class="navbar-form navbar-left" role="search">
						<div class="form-group">
							<input class="form-control" type="text">
						</div> <button type="submit" class="btn btn-default">Submit</button>
					</form>
					<ul class="nav navbar-nav navbar-right">
						<li>
							<a href="aboutus.php">About Us</a>
						</li>
						<li>
							<a href="contactus.php">Contact Us</a>
						</li>
						<li>
							<a href="signup.php">Register</a>
						</li>
						<li>
							<a href="signin.php">Login</a>
						</li>
					</ul>
				</div>
				
			</nav>
			
		</div>
	</div>
	<div class="row clearfix" align="center">
		
		<img class="img-circle" alt="140x140" height="140" width="140" src="images/url.png" align="middle" />
		<form class="form-horizontal" method="post" action="signin.php" >
<fieldset>

<!-- Form Name -->
<legend>AutoCode : Sign In</legend>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="useremail">Email Address</label>  
  <div class="col-md-4">
  <input id="useremail" name="useremail" placeholder="Your Email" class="form-control input-md" required="" type="text">
    
  </div>
</div>

<!-- Password input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="password">Password</label>
  <div class="col-md-4">
    <input id="password" name="password" placeholder="" class="form-control input-md" required="" type="password">
    
  </div>
</div>

<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="login"></label>
  <div class="col-md-4">
    <button id="login" name="login" class="btn btn-primary">Log In</button>
  </div>
</div>
<div class="alert alert-success alert-dismissable">
				 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<h4>
					<?php if (!empty($status) && isset($status)) echo "Alert!" ?>
				</h4>  <?php if (!empty($status)) { echo $status;} ?> <a href="#" class="alert-link"></a>
			</div>
</fieldset>
</form>
			
		
		<div class="col-md-4 column">
			
		</div>
	</div>
</div>
</body>
</html>

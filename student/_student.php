<?php 
		session_start();
		if (!isset($_SESSION['username']))
		{
			header('Location: ../signin.php');
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
	
	<link href="../css/bootstrap.min.css" rel="stylesheet">
	<link href="../css/style.css" rel="stylesheet">

  <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
  <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
  <![endif]-->

  <!-- Fav and touch icons -->
  <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../img/apple-touch-icon-144-precomposed.png">
  <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../img/apple-touch-icon-114-precomposed.png">
  <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../img/apple-touch-icon-72-precomposed.png">
  <link rel="apple-touch-icon-precomposed" href="../img/apple-touch-icon-57-precomposed.png">
  <link rel="shortcut icon" href="img/favicon.png">
  
	<script type="text/javascript" src="../js/jquery.min.js"></script>
	<script type="text/javascript" src="../js/bootstrap.min.js"></script>
	<script type="text/javascript" src="../js/scripts.js"></script>
</head>

<body>
	<br>
	<br>
<div class="container">
	<div class="row clearfix">
		<div class="col-md-12 column">
			<ul class="nav nav-pills">
				<li>
					<a href="student.php">Home</a>
				</li>
					<li class="dropdown">
							 <a href="#" class="dropdown-toggle" data-toggle="dropdown">Practice<strong class="caret"></strong></a>
							<ul class="dropdown-menu">
						<li>
							<a href="practice.php">Practice Programming</a>
						</li>
						<li>
							<a href="mysubmissions.php">MySubmissions</a>
						</li>
						<li>
							<a href="grade.php">My Grade</a>
						</li>
						<li class="divider">
						</li>
						<li>
							<a href="#">Separated link</a>
						</li>
					</ul>
				</li>
				<li class="enabled">
					<a href="notification.php">Notifications</a>
				</li>
				<li class="dropdown pull-right">
					 <a href="#" data-toggle="dropdown" class="dropdown-toggle">Account<strong class="caret"></strong></a>
					<ul class="dropdown-menu">
						<li>
							<a href="logout.php">Logout</a>
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
					</ul>
				</li>
			</ul>
			<h3 class="text-success">
				Welcome <?php echo $_SESSION['username'] ?>
			</h3>
			<div class="page-header">
				<h1>
					Autocode will help you earn a better career<small> -- Practice Efficiently and Smartly!<br></small>
				</h1>
			</div>
			<h2>
				About AutoCode
			</h2>
			<p>
				This awesome application will train you right from scratch to be an efficient programmer and earn a good career.
				Modern trends suggest that everyone should be able to read/write code because it helps you to think.Job trends have changed
				dramatically and surveys show that there will be heavy demands for engineers with good programming and problem solving capabilites.
				
			</p>
			<p>If you are an absolute begineer who has great passion to learn programming,dont worry we'have got it all covered.Our automated system will help to achieve this.
			   Automated Aiding tools which will help you analyze,decompose and solve problems efficiently and effectively.
		</div>
	</div>
</div>
</body>
</html>

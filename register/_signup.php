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
	<div class="row clearfix">
	
	
			<form class="form-horizontal" method="post" action="register.php">
<fieldset>

<!-- Form Name -->
<legend>Register</legend>
	<?php if (isset ($status) && isset($_POST['submit']) ) : ?>
<h3 class="text-danger"><?php echo $status;?></h3>
<?php endif;?>
<!-- Text input-->
<div class="control-group">
  <label class="control-label" for="name">Whats Your Name </label>
  <div class="controls">
    <input id="name" name="name" placeholder="your name" class="input-xlarge" required="" type="text" required>
    
  </div>
</div>

<!-- Text input-->
<div class="control-group">
  <label class="control-label" for="emailid">Email Address</label>
  <div class="controls">
    <input id="emailid" name="emailid" placeholder="" class="input-xlarge" required="" type="text" type="email" required>
  
  </div>
</div>

<!-- Text input-->
<div class="control-group">
  <label class="control-label" for="contactnumber">Contact Number</label>
  <div class="controls">
    <input id="contactnumber" name="contactnumber" placeholder="" class="input-xlarge" required="" type="text" required>
    
  </div>
</div>

<!-- Select Basic -->
<div class="control-group">
  <label class="control-label" for="selectbasic" >Select Department</label>
  <div class="controls">
    <select id="selectbasic" name="department" class="input-xlarge" required>
      <option value="CSE">Computer Science and Engineering</option>
      <option value="ECE">Electronics and Telecommunication</option>
      <option value="ELC">Electrical Engineering</option>
      <option value="IT">Information Technology</option>
    </select>
  </div>
</div>

<!-- Password input-->
<div class="control-group">
  <label class="control-label" for="password" >Password</label>
  <div class="controls">
    <input id="password" name="password" placeholder="" class="input-xlarge" type="password" required>

  </div>
</div>

<!-- Password input-->
<div class="control-group">
  <label class="control-label" for="secureid">SecureId</label>
  <div class="controls">
    <input id="secureid" name="secureid" placeholder="" class="input-xlarge" required="" type="password" required>
    
  </div>
</div>

<!-- Button -->
<div class="control-group">
  <label class="control-label" for="submit"></label>
  <div class="controls">
    <button id="submit" name="submit" class="btn btn-primary">Register</button>
  </div>
</div>

</fieldset>
</form>

		
	</div>
</div>
</body>
</html>


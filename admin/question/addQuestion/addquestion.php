<?php

include '../../../includes/Authenticate.php';
include '../../../classes/student.php';

//check whether the user is logged in or not,
if (!Authenticate::isLoggedIn())
{
	Authenticate::logout();
}
//protects the student section
if (Authenticate::getUserType() != "ADMIN")
{
	Authenticate::redirect();
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
					<a href="welcome.php">Home</a>
				</li>
					<li class="dropdown">
							 <a href="#" class="dropdown-toggle" data-toggle="dropdown">Practice<strong class="caret"></strong></a>
							<ul class="dropdown-menu">
						<li>
							<a href="addquestion.php">Add Practice Questions</a>
						</li>
						<li>
							<a href="scoreboard.php">View Scoreboard</a>
						</li>
						<li>
							<a href="submissions.php">My Submissions</a>
						</li>
						<li class="divider">
						</li>
						<li>
							<a href="#">Test Questions</a>
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
				
			</div>
			<form class="form-horizontal" method="post" action="addquestion.php" enctype="multipart/form-data">
<fieldset>

<!-- Form Name -->
<legend>Add Practice Question</legend>
<p class="text-primary" align="center"><?php if (isset($status)) echo $status;?></p>
<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="questionname">QuestionName</label>  
  <div class="col-md-4">
  <input id="questionname" name="questionname" placeholder="QuestionName" class="form-control input-md" required="" type="text">
    
  </div>
</div>

<!-- Textarea -->
<div class="form-group">
  <label class="col-md-4 control-label" for="questionStatement">Problem Statement</label>
  <div class="col-md-4">                     
    <textarea class="form-control" id="questionStatement" name="questionstatement"></textarea>
  </div>
</div>

<!-- File Button --> 
<div class="form-group">
  <label class="col-md-4 control-label" for="expectedinput">Input Test Cases</label>
  <div class="col-md-4">
    <input id="expectedinput" name="expectedinput" class="input-file" type="file">
  </div>
</div>

<!-- File Button --> 
<div class="form-group">
  <label class="col-md-4 control-label" for="expectedoutput">Output Test Cases</label>
  <div class="col-md-4">
    <input id="expectedoutput" name="expectedoutput" class="input-file" type="file">
  </div>
</div>

<!-- Select Basic -->
<div class="form-group">
  <label class="col-md-4 control-label" for="difficultylevel">Assign Difficuly level</label>
  <div class="col-md-4">
    <select id="difficultylevel" name="difficultylevel" class="form-control">
      <option value="Easy">Easy</option>
      <option value="Medium">Medium</option>
      <option value="Hard">Hard</option>
    </select>
  </div>
</div>

<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="addquestion"></label>
  <div class="col-md-4">
    <button id="addquestion" name="addquestion" class="btn btn-primary">Add Question</button>
  </div>
</div>

</fieldset>
</form>
		
		</div>
	</div>
</div>
</body>
</html>

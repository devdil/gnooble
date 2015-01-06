<?php


session_start();

if (!isset($_SESSION['username']))
{
	header('Location: ../signin.php');
}


include '../DatabaseConnect.php';
include '../config.php';

$dbinstance = new DatabaseConnect($config);
$connection = $dbinstance->connect();

$dbinstance = new DatabaseConnect($config);
$connection = $dbinstance->connect();
	
if ($connection)
{

	$queryString = 'SELECT Name,EmailId,Department,Status,Memory,Time,SourceCode FROM Scoreboard WHERE UserId=:uid and questionId=:qid';
	$bindings = array(
			'qid' => $_GET['id'],
	        'uid' => $_SESSION['userid']
	);
		
	$result = $dbinstance->read($connection,$bindings,$queryString);

	$numberOfRows = $result->rowCount();
	if ($numberOfRows>0)
	{
		$queryResult = $result->fetchAll();
	}

	else
	{
		$status = 'Something might be wrong wih the Database!';
	}

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
			
				Welcome <?php echo $_SESSION['username']; ?>
					
			</h3>
			 <h3>
				Submission Details :<br />
			</h3>
			<div class="panel-group" id="panel-704477">
				<div class="panel panel-default">
					<div class="panel-heading">
						 <a class="panel-title" data-toggle="collapse" data-parent="#panel-704477" href="#panel-element-116874">Source Code</a>
					</div>
					<div id="panel-element-116874" class="panel-collapse collapse in">
						<div class="panel-body">
							<?php echo nl2br($queryResult[0]['SourceCode']);?>
						</div>
					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading">
						 <a class="panel-title" data-toggle="collapse" data-parent="#panel-704477" href="#panel-element-16640">Status</a>
					</div>
					<div id="panel-element-16640" class="panel-collapse collapse">
						<div class="panel-body">
							<?php echo  $queryResult[0]["Status"]; ?>
						</div>
					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading">
						 <a class="panel-title" data-toggle="collapse" data-parent="#panel-704477" href="#panel-element-16640">Memory</a>
					</div>
					<div id="panel-element-16640" class="panel-collapse collapse">
						<div class="panel-body">
							<?php echo $queryResult[0]["Memory"]; ?>
						</div>
					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading">
						 <a class="panel-title" data-toggle="collapse" data-parent="#panel-704477" href="#panel-element-16640">Time</a>
					</div>
					<div id="panel-element-16640" class="panel-collapse collapse">
						<div class="panel-body">
							<?php echo $queryResult[0]["Time"];?>
						</div>
					</div>
				</div>
			</div>
			
		</div>
	</div>
</div>
</body>
</html>

	
<?php 
		include '../../includes/DatabaseConnect.php';
		include '../../includes/config.php';
		session_start();
		
		if (!isset($_SESSION['username']))
		{
			header('Location: ../../login/');
		}
		
		$dbinstance = new DatabaseConnect($config);
		$connection = $dbinstance->connect();
		$dbinstance = new DatabaseConnect($config);
		$connection = $dbinstance->connect();
			
		if ($connection)
		{
		
			
			$queryString = 'SELECT questionName,questionStatement,assignedBy,difficulty,solvedBy FROM PracticeQuestions where questionId=:qid';
			$bindings = array('qid' => $_GET['id']);
			
			$result = $dbinstance->read($connection,$bindings,$queryString);
			
			$bindings = array('qid' => $_GET['id']);
			
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
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Gnooble: Student</title>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:700,300,600,400' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="../../assets/css/main.css">

</head>
<body>

<nav class="navbar navbar-default navbar-inverse navbar-fixed-top">
	<div class="container-fluid">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="#">Gnooble</a>
		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
						<?php echo $_SESSION['username']; ?>
						<span class="caret"></span></a>
					<ul class="dropdown-menu" role="menu">
						<li><a href="#">Settings</a></li>
						<li><a href="#">Scoreboard</a></li>
						<li class="divider"></li>
						<li><a href="#">Logout</a></li>
					</ul>
				</li>
			</ul>
		</div><!-- /.navbar-collapse -->
	</div><!-- /.container-fluid -->
</nav>

<div class="container-fluid">
	<div class="row">
		<section class="col-sm-3 col-md-2 sidebar"><ul class="nav nav-sidebar">
				<li><a href="/student/">Home <span class="sr-only">(current)</span></a></li>
				<li class="active"><a href="/student/practice/">Practice</a></li>
				<li><a href="/student/submissions/">MySubmissions</a></li>
				<li><a href="/student/tutorials/">Tutorials</a></li>
				<li><a href="/student/algorithms/">Algorithms and Data Structures</a></li>
				<li><a href="/student/algorithms/">Notifications</a></li>
			</ul>
			<ul class="nav nav-sidebar">
				<li><a href="">Nav item</a></li>
				<li><a href="">Nav item again</a></li>
				<li><a href="">One more nav</a></li>
				<li><a href="">Another nav item</a></li>
				<li><a href="">More navigation</a></li>
			</ul>
			<ul class="nav nav-sidebar">
				<li><a href="">Nav item again</a></li>
				<li><a href="">One more nav</a></li>
				<li><a href="">Another nav item</a></li>
			</ul>
		</section>
		<section class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
		  <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
		  	<h1 class="page-header">Question : <?php echo $queryResult[0]['questionName']; ?></h1>
		  	<p>Statement : </p>
				<p><?php echo nl2br($queryResult[0]['questionStatement']);?></p>
		  </div>
		  <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
			  <form>
				  <label>Select Language:</label>
				  <select name="language" id="language">
					  <option value="1">C</option>
					  <option value="5">Python</option>
					  <option value="3">Java</option>
				  </select>
				  <input type="submit" value="Compile and Check" class="btn btn-default btn-primary"  name="submit" id="compile">
				  <textarea rows="30" cols="150" name="sourcecode" id="sourcecode" style="width: 601px; height: 384px; overflow-y: scroll; background: none repeat scroll 0% 0% rgb(68, 68, 68); color: aliceblue;"></textarea>
				  <br>


			  </form>
		  </div>
		</section>
	</div>	
	</div>
	

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="../assets/js/bootstrap.min.js"></script>

</body>
</html>
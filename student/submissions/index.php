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
			
		$queryString = 'SELECT * FROM PracticeQuestions NATURAL JOIN (SELECT questionId,Status,Memory,Time FROM Scoreboard where UserId=:userid) AS Score';
		$bindings = array(
				'userid' => $_SESSION['userid']
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
				<li><a href="/student/practice/">Practice</a></li>
				<li class="active"><a href="/student/submissions/">MySubmissions</a></li>
				<li><a href="/student/tutorials/">Tutorials</a></li>
				<li><a href="/student/algorithms/">Algorithms and Data Structures</a></li>
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
		  <h1 class="page-header">Submissions</h1>
		  <p class="lead">Your recent submissions</p>

		  <div class="table-responsive">
		    <table class="table">
		      <thead>
		        <tr>
		          <th>Question No.</th>
		          <th>Question</th>
		          <th>Assigned By</th>
		          <th>Difficulty</th>
		          <th>Solved By</th>
		        </tr>
		      </thead>
		      <tbody>
		        <tr>
		          <td>1,001</td>
		          <td>Lorem</td>
		          <td>ipsum</td>
		          <td>dolor</td>
		          <td>sit</td>
		        </tr>
		        <tr>
		          <td>1,002</td>
		          <td>amet</td>
		          <td>consectetur</td>
		          <td>adipiscing</td>
		          <td>elit</td>
		        </tr>
		        <tr>
		          <td>1,003</td>
		          <td>Integer</td>
		          <td>nec</td>
		          <td>odio</td>
		          <td>Praesent</td>
		        </tr>
		        <tr>
		          <td>1,003</td>
		          <td>libero</td>
		          <td>Sed</td>
		          <td>cursus</td>
		          <td>ante</td>
		        </tr>
		        <tr>
		          <td>1,004</td>
		          <td>dapibus</td>
		          <td>diam</td>
		          <td>Sed</td>
		          <td>nisi</td>
		        </tr>
		        <tr>
		          <td>1,005</td>
		          <td>Nulla</td>
		          <td>quis</td>
		          <td>sem</td>
		          <td>at</td>
		        </tr>
		        <tr>
		          <td>1,006</td>
		          <td>nibh</td>
		          <td>elementum</td>
		          <td>imperdiet</td>
		          <td>Duis</td>
		        </tr>
		        <tr>
		          <td>1,007</td>
		          <td>sagittis</td>
		          <td>ipsum</td>
		          <td>Praesent</td>
		          <td>mauris</td>
		        </tr>
		        <tr>
		          <td>1,008</td>
		          <td>Fusce</td>
		          <td>nec</td>
		          <td>tellus</td>
		          <td>sed</td>
		        </tr>
		        <tr>
		          <td>1,009</td>
		          <td>augue</td>
		          <td>semper</td>
		          <td>porta</td>
		          <td>Mauris</td>
		        </tr>
		        <tr>
		          <td>1,010</td>
		          <td>massa</td>
		          <td>Vestibulum</td>
		          <td>lacinia</td>
		          <td>arcu</td>
		        </tr>
		        <tr>
		          <td>1,011</td>
		          <td>eget</td>
		          <td>nulla</td>
		          <td>Class</td>
		          <td>aptent</td>
		        </tr>
		        <tr>
		          <td>1,012</td>
		          <td>taciti</td>
		          <td>sociosqu</td>
		          <td>ad</td>
		          <td>litora</td>
		        </tr>
		        <tr>
		          <td>1,013</td>
		          <td>torquent</td>
		          <td>per</td>
		          <td>conubia</td>
		          <td>nostra</td>
		        </tr>
		        <tr>
		          <td>1,014</td>
		          <td>per</td>
		          <td>inceptos</td>
		          <td>himenaeos</td>
		          <td>Curabitur</td>
		        </tr>
		        <tr>
		          <td>1,015</td>
		          <td>sodales</td>
		          <td>ligula</td>
		          <td>in</td>
		          <td>libero</td>
		        </tr>
		      </tbody>
		    </table>
		  </div>
		</section>
	</div>	
	</div>
	

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="../../assets/js/bootstrap.min.js"></script>
</body>
</html>
<?php

include '../../includes/Authenticate.php';
include '../../classes/student.php';

//check whether the user is logged in or not,
if (!Authenticate::isLoggedIn())
{
	Authenticate::logout();
}
//protects the student section
if (Authenticate::getUserType() != "STUDENT")
{
	Authenticate::redirect();
}

$queryResult = Student::getMySubmissions($_SESSION['userid']);


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
						<li><a href="../../../logout/">Logout</a></li>
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
				<li><a href="/student/algorithms/">Training</a></li>
			</ul>

		</section>
		<section class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
			<h1 class="page-header">My Submissions</h1>
			<p class="lead">Here are your submissions.</p>


			<div class="table-responsive">
				<table class="table">
					<thead>
					<tr>
						<th>Question Name</th>
						<th>Status</th>
						<th>Difficulty</th>
						<th>View SourceCode</th>
					</tr>
					</thead>
					<?php if ($queryResult): ?>
					<tbody>
					<?php foreach($queryResult as $result): ?>
						<tr>
							<td><?php echo $result["questionName"]; ?></td>
							<td style="color:<?php if ($result["Status"] == 'Solved') echo "#398439";
							                       if ($result["Status"] == 'Failed') echo "#c12e2a";
							                       if ($result["Status"] == 'Attempted')echo "#eb9316";?>">
												<?php echo $result["Status"]; ?>
							</td>
							<td><?php switch($result["difficulty"])
								{
									case 20:
										echo "Easy";
										break;
									case 50:
										echo "Medium";
										break;
									case 100:
										echo "Hard";
										break;
									default:
										echo "Not Assigned";
								}
								?>
							</td>
							<td><?php echo "<a href='source/index.php?qid=".$result["questionId"]."'"."</a>"."View Code";?></td>
						</tr>
					<?php endforeach; ?>

					</tbody>
					<?php endif; ?>
				</table>
			</div>


		</section>
	</div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="../../assets/js/bootstrap.min.js"></script>
</body>
</html>
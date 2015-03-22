<?php

include '../../../includes/Authenticate.php';
include '../../../classes/Admin.php';

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
$scoreboardType = $_GET['type'];
	if ($scoreboardType=== 'cgf')
		$queryResult = Admin::viewScoreboardBySourceCodeLength($_GET['qid']);
	elseif (($scoreboardType=== 'prc'))
		$queryResult = Admin::viewScoreboard($_GET['qid']);

$index = 0;

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Gnooble: Student</title>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:700,300,600,400' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="../../../assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="../../../assets/css/main.css">
	<script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

		ga('create', 'UA-59768309-1', 'auto');
		ga('send', 'pageview');

	</script>

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
		<section class="col-sm-3 col-md-2 sidebar">
			<ul class="nav nav-sidebar">
				<li><a href="../../">Home<span class="sr-only">(current)</span></a></li>
				<li><a href="../../question/">Practice Questions</a></li>
				<li><a href="../../submissions/">My Submissions</a></li>
				<li><a href="../../Challenges/">Challenges</a></li>
			</ul>
		</section>
		<section class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
			<h1 class="page-header">Scoreboard</h1>
			<p class="lead">Here are the latest standings.</p>
<?php if ($queryResult != false): ?>
			<?php if(($_GET['type'])=== 'cgf'): ?>
				<div class="table-responsive">
					<table class="table">
						<thead>
						<tr>
							<th>Student Rank</th>
							<th>Name</th>
							<th>EmailId</th>
							<th>ContactNumber</th>
							<th>Status</th>
							<th>Solved In(secs)</th>
							<th>SourceCode Length</th>
							<th>Time</th>
							<th>Memory</th>

						</tr>
						</thead>
						<?php foreach($queryResult as $result): ?>
							<tr>
								<td><?php echo ++$index; ?></td>
								<td><?php echo $result["Name"]; ?></td>
								<td><?php echo $result["EmailId"]; ?></td>
								<td><?php echo $result["ContactNumber"]; ?></td>

								<td  class="alert <?php if ($result["Status"] == 'Solved') echo "alert-success";
								if ($result["Status"] == 'Failed') echo "alert-danger";
								if ($result["Status"] == 'Attempted')echo "alert-warning";?>">
									<?php echo $result["Status"]; ?>
								</td>
								<td><?php echo $result["solvedIn"]  ?></td>
								<td><?php echo $result["lengthSourceCode"]  ?></td>
								<td><?php echo $result["Time"]  ?></td>
								<td><?php echo $result["Memory"]  ?></td>

							</tr>
						<?php endforeach; ?>

						</tbody>
					</table>
				</div>
				<?php endif;?>
			<?php if(($_GET['type'])=== 'prc'): ?>
			<div class="table-responsive">
				<table class="table">
					<thead>
					<tr>
						<th>Student Rank</th>
						<th>Name</th>
						<th>Status</th>
						<th>Solved In(secs)</th>
						<th>Time</th>
						<th>Memory</th>

					</tr>
					</thead>
					<?php foreach($queryResult as $result): ?>
						<tr>
							<td><?php echo ++$index; ?></td>
							<td><?php echo $result["Name"]; ?></td>
							<td><?php echo $result["EmailId"]; ?></td>
							<td><?php echo $result["ContactNumber"]; ?></td>
							<td  style="color:<?php if ($result["Status"] == 'Solved') echo "#398439";
													if ($result["Status"] == 'Failed') echo "#c12e2a";
													if ($result["Status"] == 'Attempted')echo "#eb9316";?>">
								<?php echo $result["Status"]; ?>
							</td>
							<td><?php echo $result["solvedIn"]  ?></td>
							<td><?php echo $result["Time"]  ?></td>
							<td><?php echo $result["Memory"]  ?></td>

						</tr>
					<?php endforeach; ?>

					</tbody>
				</table>
			</div>
				<?php endif;?>
<?php endif; ?>
		</section>
	</div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="../../../assets/js/bootstrap.min.js"></script>
</body>
</html>
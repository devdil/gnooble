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
//view all the questions by challenge Id

$queryResult = Admin::viewQuestionsByChallengeId($_GET['cid']);



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
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">John Doe <span class="caret"></span></a>
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
	<div class="table-responsive">
		<table class="table">
			<thead>
			<tr>
				<th>Sl no</th>
				<th>Question</th>
				<th>Difficulty</th>
				<th>Scoreboard</th>
			</tr>
			</thead>
			<?php if (($queryResult)): ?>
				<tbody>
				<?php foreach($queryResult as $result): ?>
					<tr>
						<td><?php echo ++$index; ?></td>
						<td><?php echo "<a href='../editor/editor.php?id=".$result["questionId"]."&type=prc"."'"."</a>".$result["questionName"]; ?></td>
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
						<td><?php echo "<a href='../scoreboard/index.php?qid=".$result["questionId"]."&type=".$_GET['type']."'"."</a>"."Scoreboard"; ?></td>
					</tr>
				<?php endforeach; ?>

				</tbody>
			<?php endif; ?>
		</table>
	</div>

<?php endif; ?>
		</section>
	</div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="../../../assets/js/bootstrap.min.js"></script>
</body>
</html>
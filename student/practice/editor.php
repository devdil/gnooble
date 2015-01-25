<?php
include '../../includes/Authenticate.php';
include '../../classes/student.php';

			//check whether the user is logged in or not,
			if (!Authenticate::isLoggedIn())
				{
					Authenticate::logout();
				}
			//protects the student section
			if (Authenticate::getUserType() == "ADMIN")
				{
					Authenticate::redirect();
				}


			$queryResult = Student::getQuestion($_GET['id']);
		
		


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
	<script>
		$(document).ready(function(){
			$('form').on('submit', function (e) {
				$("#compile").attr("disabled", "disabled");
				e.preventDefault();

				$.ajax({
					url:"http://localhost/autocode/student/validatecode.php?qid=<?php echo $_GET['id'];?>",
					type : "POST",
					crossDomain: true,
					data: $('form').serialize(),
					dataType: "json",
					success:function(result){
						alert("Compiling Source Code");
						$('#status').find('p').html("TestCases : "+result.testcases);
						$('#output').find('p').html(result['output']);
						$('#memory').find('p').html(result['memory']);
						$('#time').find('p').html(result['time']);
						$('#compilemessage').find('p').html(((result['compilemessage']).replace(/\n/g,"<br>")));
						$('#error').find('p').html(result['error']);
						$("#compile").removeAttr("disabled")
					},
					error: function (msg) {
						console.log(msg);
						$("#compile").removeAttr("disabled");
					}
				});

			});
		});
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
<!--		 <h1 class="page-header">Practice</h1>-->
		 <p class="lead"><strong>Question:</strong> <?php echo $queryResult[0]['questionName']; ?></p>


		 <div role="tabpanel" class="col-md-6 col-sm-12">

			<!-- Nav tabs -->
			<ul class="nav nav-tabs" role="tablist">
			   <li role="presentation" class="active"><a href="#problem" aria-controls="problem" role="tab" data-toggle="tab">Problem</a></li>
			   <li role="presentation"><a href="#hint" aria-controls="hint" role="tab" data-toggle="tab">Hint</a></li>
			   <li role="presentation"><a href="#solution" aria-controls="solution" role="tab" data-toggle="tab">Solution</a></li>
			   <li role="presentation"><a href="#readings" aria-controls="readings" role="tab" data-toggle="tab">Readings</a></li>
			</ul>

			<!-- Tab panes -->
			<div class="tab-content">
			   <div role="tabpanel" class="tab-pane fade in active" id="problem">
				  <p><?php echo nl2br($queryResult[0]['questionStatement']); ?></p>
			   </div>
			   <div role="tabpanel" class="tab-pane fade" id="hint">
				  <p>This section contains hints</p>
			   </div>
			   <div role="tabpanel" class="tab-pane fade" id="solution">
				  <p>This section contains solutions</p>
			   </div>
			   <div role="tabpanel" class="tab-pane fade" id="readings">
				  <p>This section contains readings</p>
			   </div>
			</div>

		 </div>

		 <hr class="hidden-md hidden-lg visible-sm-12 visible-xs-12"/>

		 <div class="col-md-6 col-sm-12">
			<h3 class="visible-sm-12 visible-xs-12 mobile-editor-head"><strong>Solve the problem below</strong></h3>
			<form class="answer-form">
			   <label for="language">Select Language:</label>
			   <select name="language" id="language">
				  <option value="1">C</option>
				  <option value="5">Python</option>
				  <option value="3">Java</option>
			   </select>
			   <input type="submit" value="Compile and Check" class="btn btn-default btn-success pull-right" name="submit" id="compile">
			   <textarea class="form-control" name="sourcecode" id="sourcecode" placeholder="Type in your solution here..."></textarea>

			</form>

			<hr class="hidden-md hidden-lg visible-sm-12 visible-xs-12"/>
			<h4 class="visible-sm-12 visible-xs-12 mobile-editor-head"><strong>Output</strong></h4>

			<div class="alert alert-default output-msg">
			   <ul class="list-unstyled">
				  <li id="status">
					 <strong>Status: </strong>
					 <p>Submit yout code to check status</p>
				  </li>
				  <li id="output">
					 <strong>Output: </strong>
					 <p>No output yet</p>
				  </li>
				  <li id="memory">
					 <strong>Memory: </strong>
					 <p>No memory consumed yet</p>
				  </li>
				  <li id="time">
					 <strong>Time: </strong>
					 <p>No time consumed yet</p>
				  </li>
				  <li id="compilemessage">
					 <strong>Message: </strong>
					 <p>Nothing to report</p>
				  </li>
				  <li id="error">
					 <strong>Error: </strong>
					 <p>No errors!</p>
				  </li>
			   </ul>
			</div>
		 </div>
	  </section>
   </div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="../../assets/js/bootstrap.min.js"></script>
</body>
</html>
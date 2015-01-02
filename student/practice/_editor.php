<?php 
		include '../DatabaseConnect.php';
		include '../config.php';
		session_start();
		
		if (!isset($_SESSION['username']))
		{
			header('Location: ../signin.php');
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
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script>
				$(document).ready(function(){
					$('form').on('submit', function (e) {
						$("#compile").attr("disabled", "disabled")
				          e.preventDefault();
						  
						    $.ajax({
						    		url:"http://localhost/autocode/student/validatecode.php?qid=<?php echo $_GET['id'];?>",
						    		type : "POST",
						  			crossDomain: true,
						  			data: $('form').serialize(),
						  			dataType: "json",
						  			success:function(result){
									alert("Compiling Source Code");
										$('#status').html("TestCases : "+result.testcases);
										$('#output').html("Output :"+result['output']);
										$('#memory').html("Memory :"+result['memory']);
										$('#time').html("Time :"+result['time']);
										$('#compilemessage').html("Compilation Message :"+((result['compilemessage']).replace(/\n/g,"<br>")));
										$('#error').html("Error :"+result['error']);
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
			
			
		<br><br>
		
		</div>
	
		<div class="col-md-6 column">
			<div class="tabbable" id="tabs-478371">
				<ul class="nav nav-tabs">
					<li class="active">
						<a href="#panel-805009" data-toggle="tab">Problem</a>
					</li>
					<li>
						<a href="#panel-805010" data-toggle="tab">Hint</a>
					</li>
					<li>
						<a href="#panel-805011" data-toggle="tab">Solution</a>
					</li>
					<li>
						<a href="#panel-805012" data-toggle="tab">Readings</a>
					</li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane active" id="panel-805009"  style="border: 1px solid #CCC;
padding: 20px;
height: 375px;
overflow-y: scroll;">
						
				<h4>Question : <?php echo $queryResult[0]['questionName']; ?></h4>
		<h4>Statement:</h4>
		<p><?php echo nl2br($queryResult[0]['questionStatement']);?></p>
		
			<br><br>
					</div>
					<div class="tab-pane" id="panel-805010">
						<p>
							Howdy, I'm in Section 10.
						</p>
					</div>
					<div class="tab-pane" id="panel-805011">
						<p>
							Howdy, I'm in Section 11.
						</p>
					</div>
					<div class="tab-pane" id="panel-805012">
						<p>
							Howdy, I'm in Section 12.
						</p>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-6 column">
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
	</div>
	
	<p id="status" class="text-success"></p>
		<p id="output" ></p>
		<p id="memory"></p>
		<p id="time"></p>
		<p id="compilemessage" class="text-danger"></p>
		<p id="error"></p>
</div>
</body>
</html>
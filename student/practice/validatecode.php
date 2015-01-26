<?php

include '../../classes/Validator.php';
include '../../includes/Authenticate.php';
include '../../compiler/Compiler.php';
include '../../classes/student.php';

if (!Authenticate::isLoggedIn())
{
	Authenticate::logout();
}
//protects the student section
if (Authenticate::getUserType() == "ADMIN")
{
	Authenticate::redirect();
}
	if (!empty($_POST['sourcecode']))
	{
		
		$sourceCode = $_POST['sourcecode'];
		$language = $_POST['language'];

		$queryResult = Validator::getTestCases($_GET['qid']);
		$result = Validator::validateCode($sourceCode,$language,$queryResult[0]["inputCases"],$queryResult[0]["outputCases"]);

		$memory           = $result->getMemory();
		$time             = $result->getTime();
		$output           = $result->getOutput();
		$error            = $result->getError();
		$output           = $result->getOutput();
		$compileMessage   = $result->getCompileMessage();
						
						
								
								
						
	}
	else
	{
		$qstring = "gnooble.org/student/practice/validatecode.php?id=".$_GET['qid'];
		header($qstring);
		exit();
	
	}

	// algorithm 1: show the output,compilation message,memory and time needed by his program to the user
	 //make sure when he traverses he has his source code into the page.
	
	if ($result->isPassed())
		{
			
			  $status = 'All Test Cases Passed!';

			  //check whether the user has already solved the question

			   $isSolved = Student::isSolvedQuestion($_SESSION['emailid'],$_GET['qid']);

			// if the user hasn't solved the question then update the scoreboard

				if (!$isSolved)
				{
					Student::updateUsersSolved($_GET['qid']);
					Student::updateMyScoreBoard($_GET['qid'], $_SESSION['username'],$_SESSION['emailid'],$_SESSION['department'],"Solved",$memory,$time,$sourceCode,$_SESSION['userid']);

				}
		
		}

	else
	{
	
			$status = 'All Test Cases Failed!';
	}
	
	$json_output = array(
					"testcases" => $status,
					"output" => $output,
					"time" =>  $time,
					"memory" => $memory,
					"compilemessage" => $compileMessage,
					"error" => $error
				
		
				);
	echo json_encode($json_output);
	
	
	 ?>
	


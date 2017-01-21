<?php

include '../../classes/Validator.php';
include '../../includes/Authenticate.php';
include '../../compiler/Compiler.php';
include '../../classes/student.php';

ini_set('display_startup_errors',1);
ini_set('display_errors',1);
error_reporting(-1);


if (!Authenticate::isLoggedIn())
{
	Authenticate::logout();
}
//protects the student section
if (Authenticate::getUserType() != "STUDENT")
{
	Authenticate::redirect();
}
if (!empty($_POST['sourcecode']))
{
	$sourceCode = ($_POST['sourcecode']);
	$language = $_POST['language'];
	$lengthSourceCode = strlen($sourceCode);
	//retrieve the number of test cases
	$queryResult = Validator::getTestCases($_GET['qid']);
	$isSample = Validator::getIsSample($queryResult);
	$result = Validator::validateCode($sourceCode,$language,$queryResult);

//		$memory           = $result->getMemory();
//		$time             = $result->getTime();
//		$output           = $result->getOutput();
//		$error            = $result->getError();
//		$output           = $result->getOutput();
//		$compileMessage   = $result->getCompileMessage();





}
else
{
	$qstring = "gnooble.org/student/practice/editor/editor.php?id=".$_GET['qid'];
	header($qstring);
	exit();

}

// algorithm 1: show the output,compilation message,memory and time needed by his program to the user
//make sure when he traverses he has his source code into the page.
//get an array of booleans
$isPassed = $result->isPassed();
$jsonOutput = array();
$areAllPassed = true;
$flag_compile_message = true;
$compilerOutput = array();
$avgTime = 0;
$avgMem = 0;
for( $index = 0 ; $index < count($isPassed); $index++)
{
	if ($isPassed[$index] == "Failed")
		$areAllPassed = false;

	$avgMem += $result->getMemory($index);
	$avgTime += $result->getTime($index);

	$statusEachTestCase = array(

		"isPassed" => $isPassed[$index],
		"time" =>  $result->getTime($index),
		"memory" => $result->getMemory($index),
		"error" => $result->getError($index),
		"sample" =>$isSample[$index],
		"message" => $result->getMessage($index),
		"expectedOutput" => $result->getOutputCase($index),
		"codeOutput" => $result->getOutput($index),
		"stderror" => $result->getError($index)

	);
	$jsonOutput[$index] = $statusEachTestCase;

}

$avgMem = $avgMem/$index;
$avgTime = $avgTime/$index;
$compilerOutput["compilationMessage"] = $result->getCompileMessage();
$compilerOutput["compilationResult"] = $jsonOutput;
$isSolved = Student::isSolvedQuestion($_SESSION['userid'],$_GET['qid']);
date_default_timezone_set('Asia/Kolkata');
$solvedTime = date('Y-m-d H:i:s');
if ($areAllPassed)
{

	$status = 'All Test Cases Passed!';

	//check whether the user has already solved the question
	//get the time



	// if the user hasn't solved the question then update the scoreboard
	if($_GET['type']=='cgf')
	{
		if(Student::isSolvedQuestion($_SESSION['userid'],$_GET['qid']) === false)
		   Student::updateCorrectSubmissionTime($_SESSION['userid'],$_GET['qid'],$solvedTime);
		Student::updateMyCustomScoreBoard($_GET['qid'],$_SESSION['userid'],'Solved',$sourceCode,$solvedTime,$avgTime,$avgMem,$lengthSourceCode);
	}

	if($_GET['type']=='prc')
	{
		if(Student::isSolvedQuestion($_SESSION['userid'],$_GET['qid']) === false)
		   Student::updateCorrectSubmissionTime($_SESSION['userid'],$_GET['qid'],$solvedTime);
		Student::updateMyScoreBoard($_GET['qid'],$_SESSION['userid'],"Solved",$sourceCode,$solvedTime,$avgTime,$avgMem);
	}
}
else
{

	$status = 'All Test Cases Failed!';
	if($_GET['type']=='prc')
	{

		Student::updateMyScoreBoard($_GET['qid'],$_SESSION['userid'],"Attempted",$sourceCode,$solvedTime,$avgTime,$avgMem);
	}

	if($_GET['type']=='cgf')
	{
		//Student::updateMyCustomScoreBoard($_GET['qid'],$_SESSION['userid'],'Failed',$sourceCode,'0000-00-00 00:00:00',$avgMem,$avgTime,$lengthSourceCode);
	}

}

//$jsonOutput[count($jsonOutput)] = array ("status" => $status);



//echo json_encode($json_output);
//echo json_encode($jsonOutput);
echo json_encode($compilerOutput);


?>
	


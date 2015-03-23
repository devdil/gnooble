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
if (Authenticate::getUserType() != "ADMIN")
{
	Authenticate::redirect();
}
if (!empty($_POST['sourcecode']))
{

	$sourceCode = ($_POST['sourcecode']);
	$language = $_POST['language'];
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
	$qstring = "gnooble.org/admin/editor/editor.php?id=".$_GET['qid'];
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

if ($areAllPassed)
{

	$status = 'All Test Cases Passed!';

	//check whether the user has already solved the question
	//get the time

}
else
{

	$status = 'All Test Cases Failed!';

}

//$jsonOutput[count($jsonOutput)] = array ("status" => $status);



//echo json_encode($json_output);
//echo json_encode($jsonOutput);
echo json_encode($compilerOutput);


?>
	


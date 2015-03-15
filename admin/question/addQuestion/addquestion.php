<?php

include '../../../classes/Validator.php';
include '../../../includes/Authenticate.php';
include '../../../classes/Admin.php';

if (!Authenticate::isLoggedIn())
{
	Authenticate::logout();
}
//protects the student section
if (Authenticate::getUserType() != "ADMIN")
{
	Authenticate::redirect();
}
if(isset($_POST['type'])) {

	if ($_POST['type'] === 'Question') {

		$inputCases = array();
		$outputCases = array();
		$index = 1;
		$inputTestCaseNumber = 'input-inputTestCase-'.$index;
		$outputTestCaseNumber = 'output-outputTestCase-'.$index;
		$questionName = htmlspecialchars($_POST['input-qName']);
		$questionStatement = htmlspecialchars($_POST['input-qDesc']);
		//$inputCases[0] = trim(str_replace("\r\n","\n",$_POST['input-inputTestCase-1']));
		//$outputCases[1] =trim(str_replace("\r\n","\n",$_POST['output-outputTestCase-1']));

		while (!empty($_POST[$inputTestCaseNumber]) && !empty($_POST[$outputTestCaseNumber])) {
			$inputCases[$index-1] = trim(str_replace("\r\n", "\n", $_POST[$inputTestCaseNumber]));
			$outputCases[$index-1] = trim(str_replace("\r\n", "\n", $_POST[$outputTestCaseNumber]));
			$index = $index + 1;
			$inputTestCaseNumber = 'input-inputTestCase-'.$index;
			$outputTestCaseNumber= 'output-outputTestCase-'.$index;

		}




		$userId = $_SESSION['userid'];
		//assign difficult a integer value corresponding to their difficulty.
		switch ($_POST['difficulty']) {
			case "Easy":
				$difficulty = 20;
				break;
			case "Medium":
				$difficulty = 50;
				break;
			case "Difficult":
				$difficulty = 100;
				break;
		}
		if (isset($_POST["challengeId"]))
		{
			    $challengeId = $_POST['challengeId'];
			    $isChallengeQuestionAddSuccessful = Admin::addChallengeQuestions($challengeId,$questionName,$questionStatement,$inputCases,$outputCases,$difficulty,$userId);
			    if($isChallengeQuestionAddSuccessful)
				{
					$status = array("result" => "QSuccess", "outcome" => "Challenge Question Added Successfully!");
				}
			else
			{
				$status = array("result" => "QFailed", "outcome" => "Challenge Question Could not be Added");
			}
		}
		else {

			$isQuestionAddSuccessful = Admin::addQuestion($questionName, $questionStatement, $inputCases, $outputCases, $difficulty, $userId);
			// var_dump($isQuestionAddSuccessful);
			if ($isQuestionAddSuccessful)
				$status = array("result" => "QSuccess", "outcome" => "Question Added Successfully!");
			else
				$status = array("result" => "QFailed", "outcome" => "Question Could not be Added");

		}
	}
	if($_POST['type'] === 'Challenge') {


		$challengeName = htmlspecialchars($_POST['input-qName']);
		$challengeStatement = htmlspecialchars($_POST['input-qDesc']);
		$startDate = $_POST['startDate'];
		$endDate = $_POST['endDate'];
		$userId = $_SESSION['userid'];
		$type = $_POST['cType'];
		//assign difficult a integer value corresponding to their difficulty.
		$isChallengeAddSuccessful = Admin::addChallenge($challengeName, $challengeStatement, $startDate, $endDate, $type, $userId);
		// var_dump($isQuestionAddSuccessful);
		if (!$isChallengeAddSuccessful) {
			$status = array("result" => "CFailed","outcome" => "Challenge Could not be Added!");;
		} else {
			$status = array("result" => "CSuccess","outcome" => $isChallengeAddSuccessful);
		}
	}


	echo json_encode($status);


	}
else
	echo json_encode($_POST);

?>
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
if(isset($_POST['type']))
{
	if($_POST['type'] === 'Question')
	{
		$questionName = htmlspecialchars($_POST['input-qName']);
		$questionStatement= htmlspecialchars($_POST['input-qDesc']);
		$inputCases = trim(str_replace("\r\n","\n",$_POST['input-inputTestCase']));
		$outputCases =trim(str_replace("\r\n","\n",$_POST['output-outputTestCase']));
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

		$isQuestionAddSuccessful = Admin::addQuestion($questionName,$questionStatement,$inputCases,$outputCases,$difficulty,$userId);
		// var_dump($isQuestionAddSuccessful);
		if ($isQuestionAddSuccessful)
			$status  = 'Question Added Successfully!';
		else
			$status = 'Something Went Wrong!Please Try Again';
	}
	if($_POST['type'] === 'Challenge')
	{
		$challengeName      = htmlspecialchars($_POST['input-qName']);
		$challengeStatement = htmlspecialchars($_POST['input-qDesc']);
		$startDate          = $_POST['startDate'];
		$endDate            = $_POST['endDate'];
		$userId             = $_SESSION['userid'];
		$type               = $_POST['cType'];
		//assign difficult a integer value corresponding to their difficulty.
		$isChallengeAddSuccessful = Admin::addChallenge($challengeName,$challengeStatement,$startDate,$endDate,$userId,$type);
		// var_dump($isQuestionAddSuccessful);
		if ($isChallengeAddSuccessful)
			$status  = 'Challenge Added Successfully!';
		else
			$status = 'Something Went Wrong!Please Try Again';

	}

	echo json_encode($status);


}
else
	echo json_encode($_POST);

?>
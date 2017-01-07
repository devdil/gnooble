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
			$status = array("result" => "CFailed","outcome" => "Challenge Could not be Added!","challengeId"=>$isChallengeAddSuccessful);;
		} else {
			$status = array("result" => "CSuccess","outcome" => "Challenge Successfully Added!","challengeId"=>$isChallengeAddSuccessful);
		}
	}


	echo json_encode($status);


	}
else
	echo json_encode($_POST);

?>
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

		$challengeId = $_GET['cid'];
		$challengeName = htmlspecialchars($_POST['input-qName']);
		$challengeStatement = htmlspecialchars($_POST['input-qDesc']);
		$startDate = $_POST['startDate'];
		$endDate = $_POST['endDate'];
		$type = $_POST['cType'];
		//assign difficult a integer value corresponding to their difficulty.
		$isChallengeUpdateSuccessful = Admin::UpdateChallengeInfo($challengeId,$challengeName,$challengeStatement,$startDate,$endDate,$type);
		// var_dump($isQuestionAddSuccessful);
		if (!$isChallengeUpdateSuccessful) {
			$status = array("result" => "CFailed","outcome" => "Challenge Could not be Added!");;
		} else {
			$status = array("result" => "CSuccess","outcome" => "Update Successful!");
		}
		echo json_encode($status);
	}


	}
else
	echo json_encode($_POST);

?>
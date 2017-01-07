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
$testCases = Admin::getTestCasesByQuestionId($_GET['qid']);

if(isset($_POST['type'])) {

    if ($_POST['type'] === 'Question') {
        $questionId = $_GET['qid'];
        $questionName = htmlspecialchars($_POST['input-qName']);
        $questionStatement = htmlspecialchars($_POST['input-qDesc']);
        $inputCases = array();
        $outputCases = array();
        $testCaseIds = array();
        $index = 0;
        foreach ($testCases as $testCase) {
            $inputTestCaseNumber = 'input-inputTestCase-' . $testCase['tid'];
            $outputTestCaseNumber = 'output-outputTestCase-' . $testCase['tid'];

            if (!empty($_POST[$inputTestCaseNumber]) && !empty($_POST[$outputTestCaseNumber])) {
                $inputCases[$index] = trim(str_replace("\r\n", "\n", $_POST[$inputTestCaseNumber]));
                $outputCases[$index] = trim(str_replace("\r\n", "\n", $_POST[$outputTestCaseNumber]));
                $testCaseIds[$index] = $testCase['tid'];
                $index = $index + 1;

            }
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
        $isQuestionUpdateSuccessful = Admin::updateQuestionByQuestionId($questionId, $questionName, $questionStatement, $inputCases,$outputCases, $difficulty,$testCaseIds);


       if ($isQuestionUpdateSuccessful) {
            $status = array("result" => "QSuccess", "outcome" => "Question Updated Successfully!");
        } else {
            $status = array("result" => "QFailed", "outcome" => "Question Update Failed!");
        }
        echo json_encode($status);
    }
}


?>
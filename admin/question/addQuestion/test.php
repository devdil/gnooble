<?php
/**
 * Created by PhpStorm.
 * User: diljit
 * Date: 5/2/15
 * Time: 2:06 PM
 */
include '../../../includes/Authenticate.php';
include '../../../classes/Admin.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add']))
{

   // if (!empty($_POST['input-qName']) && !empty($_POST['input-qDesc']))
   // {
        echo "saddsadsadsa";
        var_dump($_POST);

        $questionName = htmlspecialchars($_POST['qName']);
        $questionStatement= htmlspecialchars($_POST['qDesc']);
        $inputCases = trim(str_replace("\r\n","\n",file_get_contents($_FILES['inputTestCase']['tmp_name'])));
        $outputCases =trim(str_replace("\r\n","\n",file_get_contents($_FILES['outputTestCase']['tmp_name'])));
        $userId = 1;

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

        //validate user and password from the database

        $isQuestionAddSuccessful = Admin::addQuestion($questionName,$questionStatement,$inputCases,$outputCases,$difficulty,$userId);
        var_dump($isQuestionAddSuccessful);
        if ($isQuestionAddSuccessful)
            $status  = 'Question Added Successfully!';
        else
            $status = 'Please Check your form fields. and their values';


   // }

}


?>


<html>

<body>
<p><?php if (isset($status)) echo $status;?></p>
<form action="test.php" method="post" enctype="multipart/form-data">
    <label>QuestionName</label>
    <input type="text" id="qName" name="qName"><br>
    <label>QuestionDesc</label>
    <textarea id="qDesc" name="qDesc"></textarea><br>
    <label>Input TestCase</label>
    <input type="file" id="inputTestCase" id="inputTestCase"><br>
    <label>Output TestCase</label>
    <input type="file" id="outputTestCase" name="outputTestCase"><br>
    <label for="difficulty" class="col-sm-2 control-label">Difficulty Level</label>
        <select id="difficulty" name="difficulty">
            <option value="Easy">Easy</option>
            <option value="Medium">Medium</option>
            <option value="Hard">Hard</option>
        </select><br>
    <input id="add" type="submit" name="add">Submit</input>
</form>
</body>
</html>



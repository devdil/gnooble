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
if (Authenticate::getUserType() != "STUDENT")
{
    Authenticate::redirect();
}
if (!empty($_POST['sourcecode'])) {

    $sourceCode = ($_POST['sourceCode']);
    $isUpdateSourceCodeSuccessful = Student::updateSourceCode($sourceCode);
    if ($isUpdateSourceCodeSuccessful)
    {
        echo json_encode("Saved SourceCode");
    }
    else
    {
        echo json_encode("Problems in Saving SourceCode");
    }

}

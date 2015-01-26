<?php
/**
 * Created by PhpStorm.
 * User: diljit
 * Date: 26/1/15
 * Time: 12:31 PM
 */


class Validator
{


    public static function getTestCases($qId)
    {
        $db =  DatabaseManager::getConnection();
        $query = 'SELECT inputCases,outputCases FROM PracticeQuestions WHERE questionId=:qid';
        $bindings = array('qid' => $qId);
        return  $db->select($query,$bindings);

    }

    public static function validateCode($sourceCode,$language,$inputTestCases,$outputCases)
    {
        $compilerInstance = new Compiler($sourceCode,$language,$inputTestCases,$outputCases);
        $compilerInstance->compile();
        return $compilerInstance;

    }




}

?>
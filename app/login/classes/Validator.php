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
        $query = 'SELECT inputCase,outputCase,isSample FROM TestCases WHERE qid=:qid';
        $bindings = array('qid' => $qId);
        return  $db->select($query,$bindings);

    }

    public static function validateCode($sourceCode,$language,$testCases)
    {
        $inputTestCases = self::bindTestCases($testCases,true);
        $outputTestCases = self::bindTestCases($testCases,false);
        $compilerInstance = new Compiler($sourceCode,$language,$inputTestCases,$outputTestCases);
        $compilerInstance->compile();
        return $compilerInstance;

    }

    public static function bindTestCases($testCases,$isInput)
    {
        if ($isInput)
            $isInput = 'inputCase';
        else
            $isInput = 'outputCase';
        $inputTestCase = array();
        $index = 0;
        foreach($testCases as $testCase)
        {

                if (!isset($inputTestCase[$index]))
                    $inputTestCase[$index] = $testCase[$isInput];

                $index = $index +1;
        }
        return $inputTestCase;

    }

    public static function getIsSample($query)
    {
        $isSample = array();
        $index = 0;
        foreach ($query as $queryItem) {

            if (!isset($isSample[$index])) {
                if ($queryItem['isSample'] === 'Y')
                    $isSample[$index] = true;
                else
                    $isSample[$index] = false;
                $index = $index + 1;
            }

        }
        return $isSample;
    }






}


//$result = Validator::getTestCases(20);
//var_dump(Validator::bindTestCases($result));

?>
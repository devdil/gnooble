<?php


class Admin
{
    public static function addQuestion($questionName,$questionStatement,$inputCases,$outputCases,$difficulty,$userId)
    {
        $db = DatabaseManager::getConnection();
        $queryString = 'INSERT INTO  PracticeQuestions(questionName,questionStatement,difficulty,UserId) VALUES(:qName,:qDesc,:diff,:userId)';

        $bindings = array(
            'qName' => $questionName,
            'qDesc' => $questionStatement,
            'diff' => $difficulty,
            'userId'=> $userId

        );
        $isInsertSuccessful = $db->insert($queryString,$bindings);
        $questionId = $db->getLastInsertId();
        $isTestCaseSuccessful = self::addTestCases($questionId,$inputCases,$outputCases,'Y');

        return $isInsertSuccessful && $isTestCaseSuccessful;


    }

    public static function addChallenge($challengeName,$challengeDesc,$startDate,$endDate,$userId,$type)
    {
        $db = DatabaseManager::getConnection();
        $queryString = 'INSERT INTO  Challenge(cId,cName,cDesc,startDate,endDate,Type) VALUES(:cName,:cDesc,:startDate,:endDate,:userId,:type)';

        $bindings = array(
            'cName' => $challengeName,
            'cDesc' => $challengeDesc,
            'startDate' => $startDate,
            'endDate'=> $endDate,
            'userId'=>$userId,
            'type' => $type

        );
        $isInsertSuccessful = $db->insert($queryString,$bindings);
        $challengeId = $db->getLastInsertId();
        return $isInsertSuccessful;
    }


    public static function addTestCases($questionId,$inputCases,$outputCases,$isSample)
    {
        $db = DatabaseManager::getConnection();
        $queryString = 'INSERT INTO TestCases(qId,inputCase,outputCase,isSample) VALUES(:qId,:inputCase,:outputCase,:isSample)';

        $bindings = array(

            'qId' => $questionId,
            'inputCase' => $inputCases,
            'outputCase' => $outputCases,
             'isSample' => $isSample
        );

        return $db->insert($queryString,$bindings);
    }
}
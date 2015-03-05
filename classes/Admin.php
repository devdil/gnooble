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

    public static function addChallenge($challengeName,$challengeDesc,$startDate,$endDate,$type,$userId)
    {
        $db = DatabaseManager::getConnection();
        $queryString = 'INSERT INTO  Challenge(cName,cDesc,startDate,endDate,Type,userId) VALUES(:cName,:cDesc,:startDate,:endDate,:type,:userId)';

        $bindings = array(
            'cName' => $challengeName,
            'cDesc' => $challengeDesc,
            'startDate' => $startDate,
            'endDate'=> $endDate,
            'userId'=>$userId,
            'type' => $type

        );
        $isInsertSuccessful = $db->insert($queryString,$bindings);
        if ($isInsertSuccessful)
        {
            $challengeId = $db->getLastInsertId();
            return $challengeId;

        }
        else
            return false;
    }

    public static function addChallengeQuestions($challengeId,$questionName,$questionStatement,$inputCases,$outputCases,$difficulty,$userId)
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

        if ($isInsertSuccessful && $isTestCaseSuccessful)
        {
            $queryString = 'INSERT INTO ChallengeQuestions(cId,questionId) VALUES(:cid,:questionId)';
            $bindings = array(
                'cid' => $challengeId,
                'questionId' => $questionId

            );
            $isChallengeQuestionAddSuccessful = $db->insert($queryString,$bindings);
            return $isChallengeQuestionAddSuccessful;
        }
        else
            return false;


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
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
        $isTestCaseSuccessfulFlag=false;
        for($index=0;$index<count($inputCases);$index++)
        {
            $isTestCaseSuccessful = self::addTestCases($questionId,$inputCases[$index],$outputCases[$index],'Y');
            if($isInsertSuccessful)
                $isTestCaseSuccessfulFlag = true;


        }

        return $isInsertSuccessful && $isTestCaseSuccessfulFlag;


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
        $isTestCaseSuccessfulFlag=false;
        for($index=0;$index<count($inputCases);$index++)
        {
            $isTestCaseSuccessful = self::addTestCases($questionId,$inputCases[$index],$outputCases[$index],'Y');
            if($isInsertSuccessful)
                $isTestCaseSuccessfulFlag = true;


        }

        if ($isInsertSuccessful && $isTestCaseSuccessfulFlag)
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

    public static function updateTestCase($testCaseId,$inputCases,$outputCases,$isSample)
    {
        $db = DatabaseManager::getConnection();
        $queryString = 'UPDATE TestCases SET inputCase=:inputCase,outputCase=:outputCase WHERE tid=:testCaseId';

        $bindings = array(

            'testCaseId' => $testCaseId,
            'inputCase' => $inputCases,
            'outputCase' => $outputCases
        );

        return $db->insert($queryString,$bindings);

    }

    public static function viewChallengesByUser($userId)
    {

        $db = DatabaseManager::getConnection();
        $queryString = 'SELECT * FROM Challenge WHERE userId=:userId ';

        $bindings = array(

            'userId' => $userId
        );

        return $db->select($queryString,$bindings);


    }

    public static function viewChallengeByChallengeId($challengeId)
    {
        $db = DatabaseManager::getConnection();
        $queryString = 'SELECT * FROM Challenge WHERE cId=:cId';

        $bindings = array(

            'cId' => $challengeId
        );


        return $db->select($queryString,$bindings);

    }
    public static function getQuestionByQuestionId($questionId)
    {
        $db = DatabaseManager::getConnection();
        $queryString = 'SELECT *
                        FROM PracticeQuestions
                        WHERE questionId=:questionId';

        $bindings = array(

            'questionId' => $questionId
        );


        return $db->select($queryString,$bindings);

    }
    public static function getTestCasesByQuestionId($questionId)
    {
        $db = DatabaseManager::getConnection();
        $queryString = 'SELECT *
                        FROM TestCases
                        WHERE qid=:questionId';

        $bindings = array(

            'questionId' => $questionId
        );


        return $db->select($queryString,$bindings);

    }
    public static function updateQuestionByQuestionId($questionId,$questionName,$questionStatement,$inputCase,$outputCase,$difficulty,$testCaseIds)
    {

        $db = DatabaseManager::getConnection();
        $queryString = 'UPDATE PracticeQuestions SET questionName=:qName,questionStatement=:qDesc,difficulty=:diff WHERE questionId=:questionId';

        $bindings = array(
            'qName' => $questionName,
            'qDesc' => $questionStatement,
            'diff' => $difficulty,
            'questionId'=> $questionId

        );
        $isUpdateSuccessful = $db->insert($queryString,$bindings);
        $isTestCaseSuccessfulFlag=false;
        for($index=0;$index<count($testCaseIds);$index++)
        {
            $isTestCaseSuccessful = self::updateTestCase($testCaseIds[$index],$inputCase[$index],$outputCase[$index],'Y');
            if($isTestCaseSuccessful)
                $isTestCaseSuccessfulFlag = true;


        }

        return $isUpdateSuccessful && $isTestCaseSuccessfulFlag;


    }

    public static function viewPracticeQuestionsByUser($userId)
    {
        $db = DatabaseManager::getConnection();
        $queryString = 'SELECT * FROM PracticeQuestions WHERE UserId=:userId ';

        $bindings = array(

            'userId' => $userId
        );

        return $db->select($queryString,$bindings);

    }

    public static function viewQuestionsByChallengeId($challengeId)
    {
        $db = DatabaseManager::getConnection();
        $queryString = "SELECT *
                        FROM PracticeQuestions JOIN ChallengeQuestions
                        ON PracticeQuestions.questionId=ChallengeQuestions.questionId
                        WHERE ChallengeQuestions.cId=:challengeId";

        $bindings = array(

            'challengeId' => $challengeId
        );

        return $db->select($queryString,$bindings);
    }
    public static function viewScoreboardBySourceCodeLength($questionId)
    {

        $db    =  DatabaseManager::getConnection();
        $query = 'SELECT Scoreboard.status as Status,UserDetails.Name as Name,UserDetails.EmailId as EmailId,UserDetails.ContactNumber as ContactNumber,ABS(TIMESTAMPDIFF(SECOND,Scoreboard.endTime,Scoreboard.startTime)) as solvedIn,Scoreboard.Time as Time,Scoreboard.Memory as Memory,Scoreboard.startTime as startTime,Scoreboard.endTime as endTime,Scoreboard.charsInCode as lengthSourceCode
                  FROM Scoreboard join UserDetails
                  ON Scoreboard.UserId = UserDetails.UserId
                  where Scoreboard.questionId=:qid
                  ORDER BY (CASE WHEN solvedIn IS NULL then 1 ELSE 0 END),lengthSourceCode ASC
                  ';

        $bindings = array('qid' => $questionId);

        return $db->select($query,$bindings);

    }
    public static function viewScoreboard($questionId)
    {
        $db    =  DatabaseManager::getConnection();
        $query = 'SELECT Scoreboard.status as Status,UserDetails.Name as Name,UserDetails.EmailId as EmailId,UserDetails.ContactNumber as ContactNumber,ABS(TIMESTAMPDIFF(SECOND,Scoreboard.endTime,Scoreboard.startTime)) as solvedIn,Scoreboard.Time as Time,Scoreboard.startTime as startTime,Scoreboard.endTime as endTime,Scoreboard.Memory as Memory
                  FROM Scoreboard join UserDetails
                  ON Scoreboard.UserId = UserDetails.UserId
                  where Scoreboard.questionId=:qid
                  ORDER BY (CASE WHEN solvedIn IS NULL then 1 ELSE 0 END),solvedIn ASC
                  ';

        $bindings = array('qid' => $questionId);

        return $db->select($query,$bindings);
    }
    public static function UpdateChallengeInfo($challengeId,$challengeName,$challengeStatement,$startDate,$endDate,$type)
    {

        $db = DatabaseManager::getConnection();
        $queryString = 'UPDATE Challenge SET cName=:cName,cDesc=:cDesc,startDate=:startDate,endDate=:endDate,Type=:type WHERE cId=:challengeId';

        $bindings = array(
            'cName' => $challengeName,
            'cDesc' => $challengeStatement,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'challengeId'=> $challengeId,
            'type'=> $type

        );
        $isUpdateSuccessful = $db->insert($queryString,$bindings);
        return $isUpdateSuccessful;
    }
}
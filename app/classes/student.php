<?php
/**
 * Created by PhpStorm.
 * User: diljit
 * Date: 22/1/15
 * Time: 8:11 PM
 */
//require_once '../includes/Database.php';

class Student
{

    public static function viewPracticeQuestions()
    {
        $db =  DatabaseManager::getConnection();
        $query = "SELECT count(Scoreboard.UserId) as attempted,AuthoredBy,PracticeQuestions.questionId as questionId,questionName,difficulty,SUM(CASE WHEN Scoreboard.Status = 'Solved' THEN 1 ELSE 0 END) AS solved
                     FROM
                          (SELECT UserDetails.Name as AuthoredBY,questionId,questionName,difficulty,isPrivate
                           FROM UserDetails JOIN PracticeQuestions
                           ON UserDetails.UserId = PracticeQuestions.UserId )AS PracticeQuestions LEFT OUTER JOIN Scoreboard
                      ON Scoreboard.questionId = PracticeQuestions.questionId
                      WHERE PracticeQuestions.isPrivate='N'
                      GROUP BY questionId";

        return  $db->select($query);
    }

    public static function getQuestion($questionID)
    {

        $db    =  DatabaseManager::getConnection();
        $query = 'SELECT questionName,questionStatement FROM PracticeQuestions where questionId=:qid';
        $bindings = array('qid' => $questionID);

        return $db->select($query,$bindings);

    }

    public static function isSolvedQuestion($userId,$questionId)
    {

        $db    =  DatabaseManager::getConnection();
        $query = 'SELECT Status FROM Scoreboard WHERE UserId=:userId and questionId=:qid';
        $bindings = array(
            'userId' =>$userId,
            'qid' => $questionId
        );
        $result = $db->select($query,$bindings);

        if ($result[0]['Status'] === 'Solved')
            return true;
        else
            return false;

    }

    public static function register()
    {

    }

    public static function updateScore()
    {


    }

    public static function validateSourceCode()
    {

    }

    public static function updateUsersSolved($questionId)
    {

        $db = DatabaseManager::getConnection();
        $queryString = 'UPDATE PracticeQuestions SET solvedBy=solvedBy+1 where questionId=:qid';

        $bindings = array(
            'qid' => $questionId
        );
        $db->insert($queryString, $bindings);

    }

    public static function updateMyScoreBoard($questionId,$userId,$status,$sourceCode,$solvedTime,$Time,$Memory)
    {
        $db    =  DatabaseManager::getConnection();
        $queryString = 'UPDATE Scoreboard SET Status=:status,SourceCode=:sourceCode,Time=:time,Memory=:memory WHERE questionID=:qid and UserId=:userId';
        $bindings = array(
            'qid' => $questionId,
            'status'=> $status,
            'sourceCode'=> $sourceCode,
            'userId' => $userId,
            'time' => $Time,
            'memory' => $Memory
        );

        $db->insert($queryString,$bindings);

    }
    public static function viewScoreboard($questionId)
    {
        $db    =  DatabaseManager::getConnection();
        $query = "SELECT Scoreboard.status as Status,UserDetails.UserId,UserDetails.Name as Name,ABS(TIMESTAMPDIFF(SECOND,Scoreboard.endTime,Scoreboard.startTime)) as solvedIn,Scoreboard.Time as Time,Scoreboard.Memory as Memory
                  FROM Scoreboard join UserDetails
                  ON Scoreboard.UserId = UserDetails.UserId
                  where Scoreboard.questionId=:qid
                  ORDER BY (CASE WHEN Scoreboard.status='Solved' then 1 ELSE 0 END) DESC,solvedIn ASC,Time ASC,Memory ASC
                  ";

        $bindings = array('qid' => $questionId);

        return $db->select($query,$bindings);
    }

    public static function getQuestionsSolved($userId)
    {
        $db    =  DatabaseManager::getConnection();
        $query = 'SELECT count(DISTINCT questionId) as questionsSolved
                  FROM Scoreboard
                  WHERE Scoreboard.UserId=:uid';

        $bindings = array('uid' => $userId);

        return $db->select($query,$bindings);
    }
    public static function getMySubmissions($userId)
    {
        $db    =  DatabaseManager::getConnection();
        $query = 'SELECT PracticeQuestions.questionName as questionName,PracticeQuestions.difficulty as difficulty,Scoreboard.Status as Status,Scoreboard.questionId as questionId
                  FROM Scoreboard join PracticeQuestions ON Scoreboard.questionId = PracticeQuestions.questionId
                  WHERE Scoreboard.UserId=:uid';

        $bindings = array('uid' => $userId);

        return $db->select($query,$bindings);
    }
    public static function isUserInScoreboard($userId,$questionId)
    {

        $db    =  DatabaseManager::getConnection();
        $query = 'SELECT questionId,UserId
                  FROM Scoreboard
                  WHERE UserId=:uid AND questionID=:qid';

        $bindings = array('uid' => $userId,'qid' => $questionId);

        return $db->select($query,$bindings);
    }

    public static function insertIntoScoreboard($questionId,$userId,$startTime,$endTime)
    {
        $db = DatabaseManager::getConnection();
        $queryString = 'INSERT INTO  Scoreboard(questionId,Status,UserId,startTime,endTime,Time,Memory) VALUES(:qid,:status,:userid,:startTime,:endTime,:Time,:Memory)';

        $bindings = array(
            'qid' => $questionId,
            'status' => 'Attempted',
            'userid' => $userId,
            'startTime' => $startTime,
            'endTime' => $endTime,
            'Time' => "NA",
            'Memory' => "NA"

        );
        $db->insert($queryString,$bindings);

    }

    public static function getUserDetails($userId)
    {
        $db = DatabaseManager::getConnection();
        $queryString = 'SELECT UserId,Name,EmailId,Department,ContactNumber FROM UserDetails WHERE UserId=:userId';

        $bindings = array(
            'userId' => $userId

        );
        return $db->select($queryString,$bindings);

    }

    public static function viewDetailsSourceCode($qId,$userId)
    {
        $db = DatabaseManager::getConnection();
        $queryString = 'SELECT SourceCode,Status,startTime,endTime FROM Scoreboard WHERE UserId=:userId and questionId=:qid';

        $bindings = array(
            'userId' => $userId,
            'qid'=> $qId

        );
        return $db->select($queryString,$bindings);

    }

    public static function viewChallenges()
    {
        $db = DatabaseManager::getConnection();
        $queryString = 'SELECT * FROM Challenge';

        return $db->select($queryString);
    }

    public static function viewChallengeQuestions($challengeId)
    {
        $db = DatabaseManager::getConnection();
        $queryString = 'SELECT PracticeQuestions.questionId as questionId,PracticeQuestions.questionName as questionName,PracticeQuestions.difficulty as difficulty
                  FROM ChallengeQuestions join PracticeQuestions ON ChallengeQuestions.questionId = PracticeQuestions.questionId
                  WHERE ChallengeQuestions.cId=:cId';

        $bindings = array(
            'cId'=> $challengeId

        );
        return $db->select($queryString,$bindings);
    }

    public static function updateMyCustomScoreBoard($questionId,$userId,$status,$sourceCode,$solvedTime,$Time,$Memory,$length)
    {
        $db    =  DatabaseManager::getConnection();
        $queryString = 'UPDATE Scoreboard SET Status=:status,SourceCode=:sourceCode,endTime=:endTime,Time=:time,Memory=:memory,charsInCode=:len WHERE questionID=:qid and UserId=:userId';
        $bindings = array(
            'qid' => $questionId,
            'status'=> $status,
            'sourceCode'=> $sourceCode,
            'userId' => $userId,
            'time' => $Time,
            'memory' => $Memory,
            'len' => $length
        );

        $db->insert($queryString,$bindings);

    }

    public static function viewScoreboardBySourceCodeLength($questionId)
    {

        $db    =  DatabaseManager::getConnection();
        $query = 'SELECT Scoreboard.status as Status,UserDetails.UserId,UserDetails.Name as Name,ABS(TIMESTAMPDIFF(SECOND,Scoreboard.endTime,Scoreboard.startTime)) as solvedIn,Scoreboard.Time as Time,Scoreboard.Memory as Memory,Scoreboard.charsInCode as lengthSourceCode
                  FROM Scoreboard join UserDetails
                  ON Scoreboard.UserId = UserDetails.UserId
                  where Scoreboard.questionId=:qid
                  ORDER BY (CASE WHEN solvedIn IS NULL then 1 ELSE 0 END),lengthSourceCode ASC
                  ';

        $bindings = array('qid' => $questionId);

        return $db->select($query,$bindings);

    }

    public static function updateSourceCode($sourceCode)
    {
        $db    =  DatabaseManager::getConnection();
        $queryString = 'UPDATE Scoreboard SET SourceCode=:sourceCode WHERE questionID=:qid and UserId=:userId';
        $bindings = array(
            'sourceCode'=> $sourceCode
        );

        $db->insert($queryString,$bindings);
    }


    public static function getSourceCode($userId,$questionId)
    {
        $db    =  DatabaseManager::getConnection();
        $query = 'SELECT SourceCode
                  FROM Scoreboard
                  WHERE questionId=:questionId AND UserId=:userId
                  ';

        $bindings = array(
            'questionId' => $questionId,
            'userId' => $userId
                );

        return $db->select($query,$bindings);

    }

    public static function updateCorrectSubmissionTime($userId,$questionId,$solvedTime)
    {
        $db    =  DatabaseManager::getConnection();
        $queryString = 'UPDATE Scoreboard SET endTime=:solvedTime WHERE questionID=:qid and UserId=:userId';

        $bindings = array(
            'questionId' => $questionId,
            'userId' => $userId,
            'solvedTime'=> $solvedTime
        );

        return $db->insert($queryString,$bindings);

    }







}




?>
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
           $query = 'SELECT count(Scoreboard.UserId) as solvedBy,AuthoredBy,Scoreboard.questionId as questionId,questionName,questionStatement,difficulty
                     FROM
                          (SELECT UserDetails.Name as AuthoredBY,questionId,questionName,questionStatement,difficulty
                           FROM UserDetails JOIN PracticeQuestions
                           ON UserDetails.UserId = PracticeQuestions.UserId )AS PracticeQuestions JOIN Scoreboard
                      ON Scoreboard.questionId = PracticeQuestions.questionId
                      GROUP BY questionId ';
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

            if ($result[0]['Status'] == 'Solved')
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

    public static function updateMyScoreBoard($questionId,$userId,$status,$sourceCode)
    {
        $db    =  DatabaseManager::getConnection();
        $queryString = 'UPDATE Scoreboard SET Status=:status,SourceCode=:sourceCode WHERE questionID=:qid and UserId=:userId';
        $bindings = array(
            'qid' => $questionId,
            'status'=> $status,
            'sourceCode'=> $sourceCode,
            'userId' => $userId
        );

        $db->insert($queryString,$bindings);

    }






}




?>
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
           $query = 'SELECT questionId,questionName,assignedBy,difficulty,solvedBy FROM PracticeQuestions';
           return  $db->select($query);


    }

    public static function getQuestion($questionID)
    {

        $db    =  DatabaseManager::getConnection();
        $query = 'SELECT questionName,questionStatement,assignedBy,difficulty,solvedBy FROM PracticeQuestions where questionId=:qid';
        $bindings = array('qid' => $questionID);

        return $db->select($query,$bindings);

    }

    public static function isSolvedQuestion($emailId,$questionId)
    {

            $db    =  DatabaseManager::getConnection();
            $query = 'SELECT Status FROM Scoreboard WHERE EmailId=:emailid and questionId=:qid';
            $bindings = array(
                                    'emailid' =>$emailId,
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

    public static function updateMyScoreBoard($questionId,$username,$emailID,$department,$status,$memory,$time,$sourceCode,$userId)
    {
        $db    =  DatabaseManager::getConnection();
        $queryString = 'INSERT INTO Scoreboard VALUES(:qid,:Name,:EmailId,:Department,:Status,:Memory,:Time,:SourceCode,:UserId)';
        $bindings = array(
            'qid' => $questionId,
            'Name' => $username,
            'EmailId'=>$emailID,
            'Department'=>$department,
            'Status'=> $status,
            'Memory'=> $memory,
            'Time'=>  $time,
            'SourceCode'=> $sourceCode,
            'UserId' => $userId
        );

        $db->insert($queryString,$bindings);

    }






}




?>
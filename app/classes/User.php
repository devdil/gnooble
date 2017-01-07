<?php
/**
 * Created by PhpStorm.
 * User: diljit
 * Date: 23/1/15
 * Time: 12:20 PM
 */

class User
{
    const STUDENT = "14300";
    const ADMIN =  "00341";

    public static function register($name,$emailid,$department,$contactnumber,$type,$password)
    {
        $db = DatabaseManager::getConnection();
        $query = 'INSERT into UserDetails(Name,EmailId,Department,ContactNumber,Type,Password) VALUES(:username,:emailid,:department,:contactnumber,:type,:password)';
        $bindings = array(

            'username' => $name,
            'emailid' => $emailid,
            'department' => $department,
            'contactnumber' => $contactnumber,
            'type' => $type,
            'password' => $password

        );

        return  $db->insert($query,$bindings);
    }

    public static function viewPracticeQuestions()
    {
        $db =  DatabaseManager::getConnection();
        $query = "SELECT count(Scoreboard.UserId) as attempted,AuthoredBy,PracticeQuestions.questionId as questionId,questionName,difficulty,SUM(CASE WHEN Scoreboard.Status = 'Solved' THEN 1 ELSE 0 END) AS solved
                     FROM
                          (SELECT UserDetails.Name as AuthoredBY,questionId,questionName,difficulty
                           FROM UserDetails JOIN PracticeQuestions
                           ON UserDetails.UserId = PracticeQuestions.UserId )AS PracticeQuestions LEFT OUTER JOIN Scoreboard
                      ON Scoreboard.questionId = PracticeQuestions.questionId
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

    public static function viewScoreboard($questionId)
    {
        $db    =  DatabaseManager::getConnection();
        $query = 'SELECT Scoreboard.status as Status,UserDetails.Name as Name
                  FROM Scoreboard join UserDetails
                  ON Scoreboard.UserId = UserDetails.UserId
                  where Scoreboard.questionId=:qid';

        $bindings = array('qid' => $questionId);

        return $db->select($query,$bindings);
    }

    public static function isValidUser($secureid)
    {
        if ($secureid === self::STUDENT || $secureid === self::ADMIN )
            return true;
        else
            return false;

    }

    public function getUserType($secureId)
    {
        if ($secureId === self::STUDENT)
            return 'S';
         else
             return 'T';

    }


}
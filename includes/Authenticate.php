<?php
/**
 * User: Diljit Ramachandran
 * Date: 6/1/15
 * Time: 1:57 PM
 * Last Modified : 19th Jan,2015
 */
session_start();

class Authenticate
{

    public static function isLoggedIn()
    {
        return isset($_SESSION['username']);
    }

    public static function login($databaseQuery)
    {
        if (($databaseQuery->rowCount()) > 0) {

            $rows = $databaseQuery->fetchAll();
            $_SESSION['username'] = $rows[0]['Name'];
            $_SESSION['emailid'] = $rows[0]['EmailId'];
            $_SESSION['department'] = $rows[0]['Department'];
            $_SESSION['userid'] = $rows[0]['UserId'];
            self::setUserType($rows[0]['Type']);
            return isset($_SESSION['username']);
        }

        return false;
    }



    public static function redirect()
    {
        //redirect to the admin if the userType is admin else to student if the user type is user
        //redirect to student.php if the user is a student else welcome.php for teachers
        if (self::getUserType() == "STUDENT")
            header('Location: ../student/');
        else
            header('Location: ../admin/');
    }

    public static function getUserType()
        {
            return $_SESSION['type'];

        }

    public static function setUserType($userType)
    {
        if($userType == 'S')
            $_SESSION['type'] = "STUDENT";
        else
            $_SESSION['type'] = "ADMIN";

    }


    public static function logout()
    {
        session_start();
        session_destroy();
        $_SESSION = array();
        header('Location: ../login/');
    }




}
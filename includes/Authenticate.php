<?php
/**
 * Created by PhpStorm.
 * User: Diljit Ramachandran
 * Date: 6/1/15
 * Time: 1:57 PM
 */

class Authenticate
{
    private $isLogged = false;

    public function __construct()
    {

        session_start();

    }
    public function isLoggedIn()
    {
        return isset($_SESSION['username']);
    }

    public function login($name,$emailId,$department,$userID,$type)
    {
        $_SESSION['username']   = $name;
        $_SESSION['emailid']    = $emailId;
        $_SESSION['department'] = $department;
        $_SESSION['userid']     = $userID;
        $_SESSION['type']       = $type;

    }

    public function redirect()
    {
        //redirect to the admin if the userType is admin else to student if the user type is user
        //redirect to student.php if the user is a student else welcome.php for teachers
        if ($_SESSION['Type']=='S')
            header('Location: ../student/');
        else
            header('Location: ../admin/');


    }

    public function logout()
    {
        session_start();
        session_destroy();
        $_SESSION = array();
        $this->isLogged = false;
        header('Location: ../login/');
    }




}
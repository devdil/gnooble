<?php
/**
 * User: Diljit Ramachandran
 * Date: 6/1/15
 * Time: 1:57 PM
 */

class Authenticate
{
    private $isLogged;
    private $userType;

    public function __construct()
    {
        session_start();
        $this->isLogged = false;


    }
    public function isLoggedIn()
    {
        return $this->isLogged;
    }

    public function login($name,$emailId,$department,$userID,$type)
    {
        $_SESSION['username']   = $name;
        $_SESSION['emailid']    = $emailId;
        $_SESSION['department'] = $department;
        $_SESSION['userid']     = $userID;
        $_SESSION['type']       = $type;

        $this->isLogged = true;

    }

    public function redirect()
    {
        //redirect to the admin if the userType is admin else to student if the user type is user
        //redirect to student.php if the user is a student else welcome.php for teachers
        if ($_SESSION['type']=='S') {
            $this->setUserType("Student");
            header('Location: ../student/');
        }
        else{
            $this->setUserType("Admin");
            header('Location: ../admin/');
        }



    }

    public function getUserType($userType)
        {
                $this->userType = $userType;

        }

    public function setUserType($userType)
    {
            return $this->userType;
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
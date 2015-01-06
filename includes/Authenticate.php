<?php
/**
 * Created by PhpStorm.
 * User: diljit
 * Date: 6/1/15
 * Time: 1:57 PM
 */

class Authenticate
{
    private $isLogged = false;

    public function __construct()
    {

    }


    public function isLoggedIn()
    {
        return isset($_SESSION['username']);
    }

    public function login()
    {

    }

    public function logout()
    {
        session_start();

        session_destroy();
        $_SESSION = array();
        header('Location: ../login/');
    }




}
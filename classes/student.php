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

    public static function getQuestion()
    {



    }

    public static function register()
    {

    }






}





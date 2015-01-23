<?php
/**
 * Created by PhpStorm.
 * User: diljit
 * Date: 22/1/15
 * Time: 9:47 PM
 */

include 'student.php';
require_once '../includes/Authenticate.php';

$results = Authenticate::login("test@gmail.com","123456");
echo "<br><br>";
var_dump($results);
?>
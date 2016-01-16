
/**
 * Created by PhpStorm.
 * User: rediet
 * Date: 1/14/2016
 * Time: 6:07 PM
 */
<?php
    session_start();
    if($_SESSION['user']){

    }
    else{
        header("location:firstPage.php");
    }
    mysql_connect("localhost", "root", "") or die(mysql_error());
    mysql_select_db("ecalendar") or die("Cannot connect to database");
    $taskID = $_GET['taskID'];
    mysql_query("DELETE FROM tasks WHERE id='$taskID'");
    $date = $_SESSION['date'];
    header('location:home.php?date='.$date);
?>
/**
 * Created by PhpStorm.
 * User: rediet
 * Date: 1/13/2016
 * Time: 10:33 PM
 */

<?php
    session_start();
    if($_SESSION['user']){

    }
    else{
        header("location:firstPage.php");
    }
    $user = $_SESSION['user'];

    mysql_connect("localhost","root","") or die(mysql_error());
    mysql_select_db("ecalendar") or die("Cannot connect to database");
    $query = mysql_query("Select * FROM users WHERE username = '$user'");
    $row = mysql_fetch_assoc($query);
    $userID = $row['id'];
    $task = mysql_real_escape_string($_POST['task']);
    $sTime = mysql_real_escape_string($_POST['sTime']);
    $eTime = mysql_real_escape_string($_POST['eTime']);
    Print '</br>';
    Print $task;
    Print '</br>';
    Print $sTime;
    Print '</br>';
    Print $eTime;
    $today = date('Y-m-d');
    mysql_query("INSERT INTO tasks(userid,task,sTime,eTime,date) VALUES ('$userID', '$task', '$sTime', '$eTime', '$today')");
    header("location:home.php");
?>
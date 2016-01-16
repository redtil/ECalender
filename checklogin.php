/**
 * Created by PhpStorm.
 * User: rediet
 * Date: 1/11/2016
 * Time: 9:45 PM
 */
<?php
    session_start();
    $username = mysql_real_escape_string($_POST['username']);
    $password = mysql_real_escape_string($_POST['password']);

    mysql_connect("localhost","root","") or die(mysql_error());
    mysql_select_db("ecalendar") or die("Cannot connect to db");
    $query = mysql_query("Select * from users WHERE username = '$username' ");
    $exists = mysql_num_rows($query);
    $table_users = "";
    $table_password = "";
    if($exists > 0){
        while($row = mysql_fetch_assoc($query)){
            $table_users = $row['username'];
            $table_password = $row['password'];
        }
        if(($username == $table_users) && ($password == $table_password)){
            $_SESSION['user'] = $username;
            header("location: home.php");
        }
        else{
            Print '<script>alert("Incorrect password");</script>';
            Print '<script> window.location.assign("login.php");</script>';
        }
    }
    else{
        Print '<script> alert("Incorrect username");</script>';
        Print '<script> window.location.assign("login.php"); </script>';
    }
?>

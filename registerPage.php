/**
 * Created by PhpStorm.
 * User: rediet
 * Date: 1/11/2016
 * Time: 9:44 PM
 */

<?php
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $username = mysql_real_escape_string($_POST["username"]);
        $password = mysql_real_escape_string($_POST["password"]);

        $bool = true;
        mysql_connect("localhost","root","") or die (mysql_error());
        mysql_select_db("ecalendar") or die("cannot connect to database");
        $query = mysql_query("Select * from users");

        while($row = mysql_fetch_array($query)){
            $table_users = $row["username"];
            if($username == $table_users) {
                $bool = false;
                Print '<script> alert("Username already used"); </script>';
                Print '<script> window.location.assign("register.php"); </script>';
            }
        }

        if($bool){
            mysql_query("INSERT INTO users(username,password) VALUES ('$username','$password')");
            session_start();
            $_SESSION['user'] = $username;
            header("location: home.php");
        }
    }
?>

<?php
    session_start();
    if($_SESSION['user']){

    }
    else{
        header("location:firstPage.php");
    }
    $user = $_SESSION['user'];

?>
<html>
<head>
</head>
<body>
<h2> Welcome <?php Print "$user" ?></h2>
    <a href = "logout.php">Logout</a><br/><br/>
    <?php
        Print '<form action = "home.php" method = "GET">';
            Print '</br>';
            Print 'Choose a date:';
            Print '<input type = "date" name = "date" required = "required"/>';
            Print '<input type = "submit" value = "Choose"/>';
        Print '</form>';
        Print 'The date you have chosen is:  ';
        $chosenDate = $_GET['date'];
        Print $chosenDate;
    ?>
    <h2 align = "left">Your activities for the chosen day:</h2>
    <table border = "2px">
        <tr>
            <th>Activity/Task</th>
            <th>Start Time</th>
            <th>End Time</th>
            <th>Update</th>
        </tr>

        <?php
            mysql_connect("localhost","root","") or die(mysql_error());
            mysql_select_db("ecalendar") or die("Cannot connect to database");
            $query = mysql_query("Select * from users  WHERE username = '$user'");
            $row = mysql_fetch_assoc($query);
            $userID = $row['id'];
            $tasks = mysql_query("Select * from tasks WHERE userid = '$userID'");
            $today = date('Y-m-d');
            $date = $_GET['date'];
            $_SESSION['date'] = $date;

            while($tasksRow = mysql_fetch_assoc($tasks)){
                if($tasksRow['date'] == $date){
                    Print '<tr>';
                        Print '<td align = "center">'.$tasksRow['task']."</td>";
                        Print '<td align = "center">'.$tasksRow['sTime']."</td>";
                        Print '<td align = "center">'.$tasksRow['eTime']."</td>";
                        Print '<td align = "center"><button><a href="#" onclick="deleteFunction('.$tasksRow['id'].')">Delete</a></button> </td>';
                    Print '</tr>';
                }
            }
            Print '<tr>';
                Print '<form action = "saveTask.php?id='.$userID. '&date='. $date.'" method = "POST" >';
                Print '<td align = "center"><input type = "text" name = "task" required = "required"/></td>';
                Print '<td align = "center"><input type = "time" name = "sTime" required = "required"/></td>';
                Print '<td align = "center"><input type = "time" name = "eTime" required = "required"/></td>';
                Print '<td align = "center"><input type = "submit" value = "Save"/></td>';
                Print '</form>';
            Print '</tr>';
        ?>
    </table>
    <script>
        function deleteFunction(taskID){
            var r = confirm("Are you sure you want delete this task/activity?");
            if(r == true){
                window.location.assign("delete.php?taskID=" + taskID);
            }
        }
    </script>
</body>
</html>



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
<p> Welcome <?php Print "$user" ?></p>
    Today is:
    <?php
        echo date('Y-m-d');
        Print '<form action = "chooseDate.php" method = "GET">';
            Print 'Choose a date:';
            Print '<input type = "date" name = "date" required = "required"/>';
            Print '<input type = "submit" value = "Choose"/>';
        Print '</form>'
    ?>
    <h2 align = "left">Today's activities:</h2>
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
            while($tasksRow = mysql_fetch_assoc($tasks)){

                if($tasksRow['date'] == $today){

                    Print '<tr>';
                        Print '<td align = "center">'.$tasksRow['task']."</td>";
                        Print '<td align = "center">'.$tasksRow['sTime']."</td>";
                        Print '<td align = "center">'.$tasksRow['eTime']."</td>";
                        Print '<td align = "center"><button><a href="#" onclick="deleteFunction('.$tasksRow['id'].')">Delete</a></button> </td>';
                    Print '</tr>';
                }
            }
            Print '<tr>';
                Print '<form action = "saveTask.php?id='.$userID. '" method = "POST" >';
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



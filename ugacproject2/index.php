<!DOCTYPE html>
<html>
<head>
    <title>Student Information Management System</title>
    <style>
         body{
            margin:10px 150px;
            max-width:1400px;
            min-width:900px;
         }
        
                h1{
                font-size: 30px;
                color: #fff;
                text-transform: uppercase;
                font-weight: 300;
                text-align: center;
                margin-bottom: 15px;
                }
        table{
        width:100%;
        table-layout: fixed;
        }
        th{
        padding: 20px 0px;
        text-align: left;
        font-weight: 500;
        font-size: 20px;
        color: #fff;
        text-transform: uppercase;
        }
        td{
        padding: 10px;
        text-align: left;
        vertical-align:middle;
        font-weight: 300;
        font-size: 17px;
        color: #fff;
        border-bottom: solid 1px rgba(255,255,255,0.1);
        }


        /* demo styles */

        @import url(https://fonts.googleapis.com/css?family=Roboto:400,500,300,700);
        body{
        /* background: -webkit-linear-gradient(left, #25c984, #19b7c4); */
        background-image: linear-gradient(to right, #8360c3, #2ebf91);
        font-family: 'Roboto', sans-serif;
        }
        section{
        margin: 50px;
        }
        a{
            color:#79f392;
        }
        a:hover{
            color:blue;
        }
    </style>
</head>
<body>
    <h1>Student Information </h1>
    <?php
    // Connect to the database
    $host = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'student';

    $conn = mysqli_connect($host, $username, $password, $database);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Retrieve student information from the database
    $sql = "SELECT * FROM student";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // Display student information in a table
        echo "<table>";
        echo "<tr><th>Name</th><th>Roll Number</th><th>Department</th><th>Hostel</th><th>Action</th></tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['name'] . "</td>";
            echo "<td>" . $row['roll_number'] . "</td>";
            echo "<td>" . $row['department'] . "</td>";
            echo "<td>" . $row['hostel'] . "</td>";
            echo "<td><a href = 'edit.php?id=". $row['id'] ." '> Edit </a> | <a href='delete.php?id=". $row['id']. "'>Delete</a></td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No students found.";
    }

    // Close the database connection
    mysqli_close($conn);
    ?>

    <br>
    <a href="add.php">Add a new student</a>
</body>
</html>

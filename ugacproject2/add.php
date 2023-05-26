<!DOCTYPE html>
<html>
<head>
    <title>Add Student</title>
    <style>
        body {
        width: 100%;
        height: 100vh;
        margin: 0;
        background-image: linear-gradient(to right, #8360c3, #2ebf91);
        font-family: 'Roboto', sans-serif;
        color: #f5f6f7;
        font-size: 16px;
        }
        
        form {
        width: 30vw;
        max-width: 143px;
        min-width: 153px;
        margin: 5px auto;
        }
        h2{
            margin:10px;
            text-align: center;
        }
        input{
            width:100px;
        }
    </style>
</head>
<body>
    <?php
    // Check if the form is submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Connect to the database
        $host = 'localhost';
        $username = 'root';
        $password = '';
        $database = 'student';

        $conn = mysqli_connect($host, $username, $password, $database);
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Get the form data
        $name = $_POST['name'];
        $rollNumber = $_POST['roll_number'];
        $department = $_POST['department'];
        $hostel = $_POST['hostel'];

        // Insert the student into the database
        $sql = "INSERT INTO student (name, roll_number, department, hostel) VALUES ('$name', '$rollNumber', '$department', '$hostel')";
        if (mysqli_query($conn, $sql)) {
            echo "Student added successfully.";
            header("Location: index.php");
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

        // Close the database connection
        mysqli_close($conn);
    }
    ?>

    <h2>Add Student</h2>
   
    <form method="POST" action="">
        <label for="name">Name:</label>
        <input type="text" name="name" required><br><br>

        <label for="roll_number">Roll Number:</label>
        <input type="text" name="roll_number" required><br><br>

        <label for="department">Department:</label>
        <input type="text" name="department" required><br><br>

        <label for="hostel">Hostel:</label>
        <input type="text" name="hostel" required><br><br>

        <input type="submit" value="Add Student" >
    </form>
</body>
</html>

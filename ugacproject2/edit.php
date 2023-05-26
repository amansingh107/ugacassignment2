<!DOCTYPE html>
<html>
<head>
    <title>Edit Student</title>
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
        $database = 'your_database';

        $conn = mysqli_connect($host, $username, $password, $database);
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Get the form data
        $id = $_POST['id'];
        $name = $_POST['name'];
        $rollNumber = $_POST['roll_number'];
        $department = $_POST['department'];
        $hostel = $_POST['hostel'];

        // Update the student in the database
        $sql = "UPDATE student SET name='$name', roll_number='$rollNumber', department='$department', hostel='$hostel' WHERE id=$id";
        if (mysqli_query($conn, $sql)) {
            echo "Student updated successfully.";
        } else {
            echo "Error updating student: " . mysqli_error($conn);
        }

        // Close the database connection
        mysqli_close($conn);
    } else {
        // Check if the student ID is provided
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            // Connect to the database
            $host = 'localhost';
            $username = 'root';
            $password = '';
            $database = 'student';

            $conn = mysqli_connect($host, $username, $password, $database);
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }

            // Retrieve the student from the database
            $sql = "SELECT * FROM student WHERE id=$id";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);

                // Display the edit form
                ?>
                <h2>Edit Student</h2>
                <form method="POST" action="">
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

                    <label for="name">Name:</label>
                    <input type="text" name="name" value="<?php echo $row['name']; ?>" required><br><br>

                    <label for="roll_number">Roll Number:</label>
                    <input type="text" name="roll_number" value="<?php echo $row['roll_number']; ?>" required><br><br>

                    <label for="department">Department:</label>
                    <input type="text" name="department" value="<?php echo $row['department']; ?>" required><br><br>

                    <label for="hostel">Hostel:</label>
                    <input type="text" name="hostel" value="<?php echo $row['hostel']; ?>" required><br><br>

                    <input type="submit" value="Update Student">
                </form>
                <?php
            } else {
                echo "No student found with the provided ID.";
            }

            // Close the database connection
            mysqli_close($conn);
        } else {
            echo "Invalid student ID.";
        }
    }
    ?>
</body>
</html>

<!DOCTYPE html>
<html>
<head>
    <title>Delete Student</title>
</head>
<body>
    <?php
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

        // Delete the student from the database
        $sql = "DELETE FROM student WHERE id=$id";
        if (mysqli_query($conn, $sql)) {
            echo "Student deleted successfully.";
            header("Location: index.php");
        } else {
            echo "Error deleting student: " . mysqli_error($conn);
        }

        // Close the database connection
        mysqli_close($conn);
    } else {
        echo "Invalid student ID.";
    }
    ?>
</body>
</html>

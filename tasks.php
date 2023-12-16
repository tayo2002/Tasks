<?php
$host = "localhost";
$user = "tayo";
$password = "tayo";
$dbname = "Tasks";

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to sanitize input
function sanitizeInput($conn, $data) {
    return mysqli_real_escape_string($conn, $data);
}

// Corrected opening PHP tag
if (isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] == "POST")  {
    // Retrieve form data
    $taskName = sanitizeInput($conn, $_POST["taskName"]);
    $description = sanitizeInput($conn, $_POST["description"]);
    $dueDate = sanitizeInput($conn, $_POST["dueDate"]);

    //Insert the data into the 'Tasks' table
    $sql = "INSERT INTO tasks (taskName, description, dueDate) VALUES ('$taskName', '$description', '$dueDate')";

    if ($conn->query($sql) === TRUE) {
        echo "<p>Task inserted successfully!</p>";
    }else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Display the submitted task details
    echo "<p><strong>Task Name:</strong> $taskName</p>";
    echo "<p><strong>Description:</strong> $description</p>";
    echo "<p><strong>Due Date:</strong> $dueDate</p>";
} else {
    echo "<p>No task submitted.</p>";
}

// Close connection
$conn->close();
?>

<?php
// Database configuration
$host = 'localhost'; // Database host
$dbname = 'your_database_name'; // Replace with your database name
$username = 'your_username'; // Replace with your database username
$password = 'your_password'; // Replace with your database password

// Create a connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect form data
    $firstname = $conn->real_escape_string($_POST['firstname']);
    $lastname = $conn->real_escape_string($_POST['lastname']);
    $total = $conn->real_escape_string($_POST['total']);
    $start_date = $conn->real_escape_string($_POST['start-date']);
    $end_date = $conn->real_escape_string($_POST['end-date']);
    $email = $conn->real_escape_string($_POST['email']);
    $message = $conn->real_escape_string($_POST['message']);

    // Validate start and end date
    if (strtotime($start_date) > strtotime($end_date)) {
        die("Error: Start date must be before end date.");
    }

    // SQL query to insert the data into your table
    $sql = "INSERT INTO your_table_name (firstname, lastname, total, start_date, end_date, email, message) 
            VALUES ('$firstname', '$lastname', '$total', '$start_date', '$end_date', '$email', '$message')";

    if ($conn->query($sql) === TRUE) {
        echo "Data submitted successfully!";
        // Redirect to the thank you page
        header("Location: thankyou.html");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>

<?php
// Database configuration
$host = 'group3bow.czptxhzjxjrt.us-east-1.rds.amazonaws.com'; // Database host
$dbname = 'mybowhotels'; // Replace with your database name
$username = 'admin'; // Replace with your database username
$password = 'Jcricket963.$'; // Replace with your database password

// Create a connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Identify the form type
$form_type = $_POST['form_type'];

if ($_SERVER['REQUEST_METHOD'] == 'POST'){


// Check if the form is submitted
if ($form_type == 'booking_form')

        // Validate start and end date
        if (strtotime($start_date) > strtotime($end_date)) {
            die("Error: Start date must be before end date.");
        }
 {
    // Collect form data
    $name = $conn->real_escape_string($_POST['firstname']);
    $total = $conn->real_escape_string($_POST['total']);
    $start_date = $conn->real_escape_string($_POST['start_date']);
    $end_date = $conn->real_escape_string($_POST['end_date']);
    $email = $conn->real_escape_string($_POST['email']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $message = $conn->real_escape_string($_POST['message']);



    // SQL query to insert the data into your table
    $sql = "INSERT INTO bookingtable (firstname, total, start_date, end_date, email, message) 
            VALUES ('$firstname', '$total', '$start_date', '$end_date', '$email', '$message')";

    if ($conn->query($sql) === TRUE) {
        echo "Data submitted successfully!";
        // Redirect to the thank you page
        header("Location: thankyou.html");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

} elseif($form_type == 'contact_form'){

    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $query = $conn->real_escape_string($_POST['query']);

    // SQL query to insert data into the database
    $sql = "INSERT INTO contact_table (name, email, phone, query) VALUES ('$name', '$email', '$phone', '$query')";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        echo "Thank you! Your details have been saved successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}


// Close the database connection
$conn->close();
?>

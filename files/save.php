<?php
# database connection portion
$host = "localhost";
$db   = "lamp_stack_delicious_and_stuff";
$user = "cluck";
$pass = "cluckchair";

# new mysqli database connection
$conn = new mysqli($host, $user, $pass, $db);

# if fails then stop execution 
if ($conn->connect_error) {
    die("DB Connection failed: " . $conn->connect_error);
}

# get data from post request
$name    = $_POST['name'] ?? ''; # get name from form submission
$message = $_POST['message'] ?? ''; # get message from form submission

# check if values are empty or not
if (!empty($name) && !empty($message)) { 
    $stmt = $conn->prepare("INSERT INTO guestbook (name, message) VALUES (?, ?)");
    $stmt->bind_param("ss", $name, $message);
    $stmt->execute();
    $stmt->close();
}

# redirect back to main guestbook page
header("Location: index.php");
exit;

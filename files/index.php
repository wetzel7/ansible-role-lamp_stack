<?php
# db connection config
$host = "localhost";
$db   = "lamp_stack_delicious_and_stuff";
$user = "cluck";
$pass = "cluckchair";

# create mysqli db connection object
$conn = new mysqli($host, $user, $pass, $db);

# check connection and if failed terminate script
if ($conn->connect_error) {
    die("DB Connection failed: " . $conn->connect_error);
}

# query db to get guestbook entires, ordered by newest to oldest
$result = $conn->query("SELECT name, message, created_at FROM guestbook ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Guestbook</title>
</head>
<body>
    <h1>Guestbook</h1>

    <!-- form to submit new entires -->
    <form action="save.php" method="POST">
        <!-- input field for name -->
        <input type="text" name="name" placeholder="Your Name" required><br><br>

        <!-- textarea for message -->
        <textarea name="message" placeholder="Your Message" required></textarea><br><br>
        <!-- submit button -->
        <button type="submit">Submit</button>
    </form>

    <h2>Messages</h2>
    <ul>
        <?php # loop through each row of db query result
        while ($row = $result->fetch_assoc()): ?>
            <li>
                <!-- display name -->
                <strong><?php echo htmlspecialchars($row['name']); ?></strong><br>
                <!-- display message -->
                <?php echo nl2br(htmlspecialchars($row['message'])); ?><br>
                <!-- timestamp -->
                <small><?php echo $row['created_at']; ?></small>
            </li>
            <hr>
        <?php endwhile; ?>
    </ul>
</body>
</html>

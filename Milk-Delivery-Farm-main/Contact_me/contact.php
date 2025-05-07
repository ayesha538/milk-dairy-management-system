<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="css/styles.css">
    <style>   /* Centering the form without a white box */
        .back-btn {
      position: absolute;
      top: 20px; /* Adjust as needed */
      left: 20px; /* Adjust as needed */
      background-color: #f44336; /* Red background */
      border: none;
      color: white; /* White text */
      padding: 5px 10px; /* Smaller padding for a smaller button */
      text-align: center;
      text-decoration: none;
      display: inline-block;
      font-size: 14px; /* Smaller font size */
      cursor: pointer;
      border-radius: 3px; /* Slightly rounded corners */
    }

    .back-btn:hover {
      background-color: #d32f2f; /* Darker red on hover */
    }
</style>

</head>

<body>
<a href="../index.html" class="back-btn">← Back</a>

<?php
$showAlert = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = new mysqli("localhost", "root", "", "milk_dairy");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    $subject = $_POST['subject'];

    $sql = "INSERT INTO contacts (name, email, message, subject) 
            VALUES ('$name', '$email', '$message', '$subject')";

    if ($conn->query($sql) === TRUE) {
        $showAlert = true;
    }

    $conn->close();
}
?>

<div class="container">
    <h1 class="contact">Contact Form</h1>
    <p>Please fill all the texts in the fields.</p>

    <?php if ($showAlert): ?>
        <script>alert("Message Sent Successfully");</script>
    <?php endif; ?>

    <form method="POST" action="">
        <p class="bold">
            Your Name:
            <br>
            <input type="text" required name="name" placeholder="Your full name">
        </p>
        <p class="bold">
            Your Email:
            <br>
            <input type="email" required name="email" placeholder="Enter valid email address">
        </p>

        <p class="bold">
            Message:
            <br>
            <textarea name="message" cols="100" rows="3" required></textarea>
        </p>
        <p class="bold">
            Subject:
            <br>
            <input type="text" required name="subject" placeholder="Subject of your message">
        </p>
        <br>
        <input type="submit" value="Send" class="bold">
    </form>
</div>
</body>
</html>

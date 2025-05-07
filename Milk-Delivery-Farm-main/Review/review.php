<?php
// Start output buffering to allow header redirection
ob_start();

// Connect to DB
$conn = new mysqli("localhost", "root", "", "milk_dairy");

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST["name"]);
    $rating = $_POST["rating"];
    $message = htmlspecialchars($_POST["message"]);

    $stmt = $conn->prepare("INSERT INTO reviews (name, rating, message) VALUES (?, ?, ?)");
    $stmt->bind_param("sis", $name, $rating, $message);
    $stmt->execute();
    $stmt->close();

    // Prevent duplicate submission on page refresh
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Customer Reviews - Milk Dairy</title>
    <style>
        .back-btn {
            position: absolute;
            top: 20px;
            left: 20px;
            background-color: #f44336;
            border: none;
            color: white;
            padding: 5px 10px;
            font-size: 14px;
            cursor: pointer;
            border-radius: 3px;
            text-decoration: none;
        }

        .back-btn:hover {
            background-color: #d32f2f; 
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            background-image: url('images/other_milk.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            margin: 0;
            padding: 40px;
        }

        h2 {
            text-align: center;
        }

        form {
            background: #fff;
            max-width: 500px;
            margin: auto;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 0 8px rgba(0,0,0,0.1);
        }

        input, textarea, select {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        input[type="submit"] {
            background: #4CAF50;
            color: white;
            border: none;
            font-weight: bold;
            cursor: pointer;
        }

        .review {
            background: #fff;
            padding: 15px;
            margin: 20px auto;
            border-left: 5px solid #4CAF50;
            max-width: 600px;
            border-radius: 6px;
        }

        .stars {
            color: #f1c40f;
        }
    </style>
</head>
<body>

<a href="../index.html" class="back-btn">← Back</a>

<h2>Leave a Review</h2>

<form method="post" action="">
    <input type="text" name="name" placeholder="Your Name" required>
    <select name="rating" required>
        <option value="">Rate Us</option>
        <option value="5">★★★★★ - Excellent</option>
        <option value="4">★★★★ - Good</option>
        <option value="3">★★★ - Average</option>
        <option value="2">★★ - Poor</option>
        <option value="1">★ - Terrible</option>
    </select>
    <textarea name="message" placeholder="Your Review..." rows="5" required></textarea>
    <input type="submit" value="Submit Review">
</form>

<h2>Customer Feedback</h2>

<?php
// Fetch and display reviews
$result = $conn->query("SELECT * FROM reviews ORDER BY created_at DESC");
while ($row = $result->fetch_assoc()) {
    echo "<div class='review'>";
    echo "<strong>" . htmlspecialchars($row['name']) . "</strong>";
    echo "<div class='stars'>" . str_repeat("★", $row['rating']) . str_repeat("☆", 5 - $row['rating']) . "</div>";
    echo "<p>" . htmlspecialchars($row['message']) . "</p>";
    echo "<small>Reviewed on: " . date('d M Y', strtotime($row['created_at'])) . "</small>";
    echo "</div>";
}
$conn->close();
ob_end_flush(); // End output buffering
?>

</body>
</html>

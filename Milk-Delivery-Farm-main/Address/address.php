<?php
$conn = new mysqli('localhost', 'root', '', 'milk_dairy');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$showPopup = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $city = $_POST['city'];
    $pin_code = $_POST['pin_code'];
    $full_address = $_POST['address'];
    $society_name = $_POST['society-name'];
    $house_number = $_POST['house-number'];
    $block_name = $_POST['Block'];

    $stmt = $conn->prepare("INSERT INTO addresses (city, pin_code, full_address, society_name, house_number, block_name) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $city, $pin_code, $full_address, $society_name, $house_number, $block_name);
    if ($stmt->execute()) {
        $showPopup = true;
        header("Location: ../index.html");
        exit();
    }
    $stmt->close();
    echo "<script>
        alert('Address saved successfully!');
        window.location.href = '../index.html';
    </script>";
    $conn->close();
}


?>
<!DOCTYPE html>
<html lang="en">
<sty>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Address</title>
    <link rel="stylesheet" href="css/styles.css">
    <script>
        function showPopup() {
            alert("Address saved successfully!");
        }
    </script>
    <style>
   php .back-btn {
    position: absolute;
    top: 10px; /* Adjust as needed */
    left: 10px; /* Adjust as needed */
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

    <?php if ($showPopup): ?>
        <script>showPopup();</script>
    <?php endif; ?>
    <a href="../index.html" class="back-btn">← Back</a>

    
    <div class="container">
        <h1>Delivery Address</h1>
        <hr>
        <h3>Enter your Address</h3>
        <form method="POST">
            <p>
                <select name="city">
                    <option value="Dehradun">Dehradun</option>
                    <option value="Hyderabad">Hyderabad</option>
                    <option value="Bangalore">Bangalore</option>
                    <option value="Delhi">Delhi</option>
                    <option value="Great Noida">Great Noida</option>
                    <option value="Lucknow">Lucknow</option>
                    <option value="Patna">Patna</option>
                    <option value="Mumbai">Mumbai</option>
                    <option value="Pune">Pune</option>
                    <option value="Haridwar">Haridwar</option>
                </select>
            </p>
            <p>
                <input type="text" name="pin_code" placeholder="Pin Code">
            </p>
            <p>
                <input type="text" required name="address" placeholder="Enter Your Full Address">
            </p>
            <p>
                <input type="text" required name="society-name" placeholder="Society Name">
            </p>
            <p>
                <input type="text" required name="house-number" placeholder="House/Flat Number">
            </p>
            <p>
                <input type="text" required name="Block" placeholder="Block">
            </p>
            <p>
                <input type="submit" value="Save Address">
            </p>
        </form>
    </div>
</body>
</html>
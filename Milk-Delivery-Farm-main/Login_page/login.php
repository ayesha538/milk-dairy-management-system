<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login to Your Account</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="css/style.css">
  <style>
    /* Centering the form without a white box */
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

    .login-container {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .login-box {
      width: 300px;
      padding: 20px;
      border-radius: 10px;
      color: white;
    }

    .login-box input[type=email],
    .login-box input[type=password],
    .login-box input[type=submit] {
      width: 100%;
      padding: 10px;
      margin: 10px 0;
      border: none;
      border-radius: 5px;
    }

    .login-box input[type=submit] {
      background-color: #4CAF50;
      color: white;
      cursor: pointer;
    }

    .login-box h2 {
      text-align: center;
      margin-bottom: 20px;
    }

    .error-msg {
      color: #ff4d4d;
      font-weight: bold;
      text-align: center;
    }
  </style>
</head>
<body>
<a href="../index.html" class="back-btn">← Back</a>

<?php
session_start();
$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $conn = new mysqli("localhost", "root", "", "milk_dairy");

  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }

  $email = $_POST['email'];
  $password = $_POST['password'];

  $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows == 1) {
      $row = $result->fetch_assoc();

      if (password_verify($password, $row['password'])) {
          $_SESSION['email'] = $email;
          echo "<script>
                  alert('Login Successful');
                  window.location.href ='../dashboard/dashboard.php';
                </script>";
          exit();
      } else {
          $error = "Incorrect password.";
      }
  } else {
      $error = "Email not found.";
  }

  $stmt->close();
  $conn->close();
}


?>

<div class="login-container">
  <form method="POST" action="" class="login-box">
    <h2>Login</h2>
    <input type="email" name="email" placeholder="Enter Email" required>
    <input type="password" name="password" placeholder="Enter Password" required>
    <input type="submit" value="Login">
    <?php if ($error): ?>
      <p class="error-msg"><?php echo $error; ?></p>
    <?php endif; ?>
    <div style="margin-top: 15px; text-align: center;">
      <a href="../SignUp page/signup.php" style="color:white;">Sign up</a> | 
      <a href="#" style="color:white;">Forgot password?</a>
    </div>
  </form>
</div>

</body>
</html>
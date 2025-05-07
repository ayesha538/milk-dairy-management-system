<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Sign Up</title>
  <link rel="stylesheet" href="css/style.css">
  <style>
    /* Basic styles for the back button */
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

    /* Centering the signup box */
    .signup-box {
      text-align: center;
      margin-top: 100px; /* Adjust as needed */
    }

    /* Modal styles */
   
  </style>
</head>
<body>

  <!-- Small Back Button on Sign Up Page -->
  <a href="../index.html" class="back-btn">← Back</a>

  <!-- Main Sign Up Page Content -->
  <div class="signup-box">
    <img class="can" src="images/milkcanlogo.png" alt="Logo" height="250" width="250">
    <button class="signup-button" onclick="document.getElementById('id01').style.display='block'">Sign Up</button>
  </div>

  <?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $conn = new mysqli("localhost", "root", "", "milk_dairy");

      if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
      }

      $email = $_POST['email'];
      $password = $_POST['psw'];
      $confirm_password = $_POST['psw-repeat'];

      if ($password !== $confirm_password) {
          echo "<script>alert('Passwords do not match.');</script>";
      } else {
          $check_stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
          $check_stmt->bind_param("s", $email);
          $check_stmt->execute();
          $result = $check_stmt->get_result();

          if ($result->num_rows > 0) {
              echo "<script>
                      alert('Account already exists. Please login.');
                      window.location.href='../Login_page/login.php';
                    </script>";
          } else {
              $hashed_password = password_hash($password, PASSWORD_DEFAULT);
              $stmt = $conn->prepare("INSERT INTO users (email, password) VALUES (?, ?)");
              $stmt->bind_param("ss", $email, $hashed_password);

              if ($stmt->execute()) {
                  echo "<script>
                          alert('Account created successfully!');
                          window.location.href='../dashboard/dashboard.php';
                        </script>";
              } else {
                  echo "<script>alert('Error: " . $stmt->error . "');</script>";
              }

              $stmt->close();
          }

          $check_stmt->close();
      }

      $conn->close();
  }
  ?>

  <!-- Sign Up Modal -->
  <div id="id01" class="modal">
    <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>

    <!-- Back button inside modal -->
    <a href="../index.html" class="back-btn">← Back</a>
    <form class="modal-content" action="" method="POST">
      <div class="container">
        <h1>Sign Up</h1>
        <p>Please fill in this form to create an account.</p>
        <hr>

        <label for="email"><b>Email</b></label>
        <input type="text" placeholder="Enter Email" name="email" required>

        <label for="psw"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="psw" required>

        <label for="psw-repeat"><b>Confirm Password</b></label>
        <input type="password" placeholder="Confirm Password" name="psw-repeat" required>

        <label>
          <input type="checkbox" checked="checked" name="remember" style="margin-bottom:15px"> Remember me
        </label>

        <p>By creating an account you agree to our <a href="#" style="color:dodgerblue">Terms & Privacy</a>.</p>

        <div class="clearfix">
          <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
          <button type="submit" class="signupbtn">Sign Up</button>
        </div>
      </div>
    </form>
  </div>

  <script>
    var modal = document.getElementById('id01');
    window.onclick = function(event) {
      if (event.target == modal) {
        modal.style.display = "none";
      }
    }
  </script>

</body>
</html>
    
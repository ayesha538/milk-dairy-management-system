<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Welcome to Our Farm</title>
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
      font-family: Arial, sans-serif;
      text-align: center;
      padding-top: 100px;
      background-image: url('../images/skim milk.jpg'); /* Adjusted path to the image */
      background-size: cover; /* Make the image cover full screen */
      background-position: center; /* Center the image */
      background-repeat: no-repeat; /* Don't repeat the image */
    }
    .container {
      background: white;
      display: inline-block;
      padding: 40px;
      border-radius: 15px;
      box-shadow: 0 0 15px rgba(0,0,0,0.2);
    }
    h1 {
      color: #4CAF50;
    }
    p {
      margin: 20px 0;
      font-size: 18px;
      color: #333;
    }
    .btn {
      display: inline-block;
      margin: 10px;
      padding: 12px 24px;
      font-size: 16px;
      text-decoration: none;
      color: white;
      border-radius: 5px;
      border: none;
      cursor: pointer;
    }
    .order-btn {
      background-color: #4CAF50;
    }
    .logout-btn {
      background-color: #f44336;
    }
    .btn:hover {
      opacity: 0.9;
    }
  </style>
</head>
<body>
<a href="../index.html" class="back-btn">← Back</a>

    <div class="container">
  <h1><strong>Welcome to Our Farm!</strong></h1>
 <b> <i>Glad to have you at MY FARM.
    Your fresh dairy experience is on the way</i></b>
  </p>
  
  <a href="../payment/payment.php" class="btn order-btn">Order Now</a>
  
  <!-- Logout Button inside form -->
  <!--<form method="POST" style="display:inline;">-->
     <a href="../index.html"name="logout" class="btn logout-btn">Logout</a>
  </form>
</div>

</body>
</html>

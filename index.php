<?php
  session_start();
  include("connection.php");
  include("functions.php");

  if(isset ($_SESSION['acc_num'])){
    header("Location: user/user_profile.php");
  }
  else if(isset ($_SESSION['user_id'])){
    header("Location: admin/admin_profile.php");
  } 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <link rel="stylesheet" href="style_index.css">
    <title>Project</title>
</head>
<body>
    
    <nav>
      <input type="checkbox" id="check">
      <label for="check" class="checkbtn">
        <i class="fas fa-bars"></i>
      </label>
      <label class="logo">Project</label>
      <ul>
        <li><a class="active" href="index.php">Home</a></li>
        <li><a href="sign-up.php">Sign-up</a></li>
        <li><a href="sign-in.php">Sign-in</a></li>
      </ul>
    </nav>

    <div class="wrapper">
         <h2>WELCOME!</h2>
         <br>
         <p class="text">
         Online banking, also known as internet banking, web banking or home banking, is an electronic payment system that enables customers of a bank or other financial institution to conduct a range of financial transactions through the financial institution's website.
         The online banking system will typically connect to or be part of the core banking system operated by a bank to provide customers access to banking services in place of traditional branch banking.
         Online banking significantly reduces the banks' operating cost by reducing reliance on a branch network, and offers greater convenience to customers in time saving in coming to a branch and the convenience of being able to perform banking transactions even when branches are closed.
         Internet banking provides personal and corporate banking services offering features such as viewing account balances, obtaining statements, checking recent transactions, transferring money between accounts, and making payments.
         </p>
    </div>
    
</body>
</html>
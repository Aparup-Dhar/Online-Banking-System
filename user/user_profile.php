<?php
  session_start();
  include("../connection.php");
  include("../functions.php");
  $user_data = check_login_user($con);

  $select = "select acc_bal from user_balance where acc_num='$user_data[acc_num]' ";
  $query = mysqli_query($con,$select);
  $result = mysqli_fetch_assoc($query);

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
    <link rel="stylesheet" href="user_profile.css">
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
        <li><a class="active" href="user_profile.php">Profile</a></li>
        <li><a class="" href="transfer.php">Transfer</a></li>
        <li><a class="" href="t_history.php">T.History</a></li>
        <li><a class="" href="c_card.php">C-card</a></li>
        <li><a class="" href="cc_status.php">Status</a></li>
        <li><a class="" href="change_pass.php">Change Pass</a></li>
        <li><a href="../logout.php">Logout</a></li>
      </ul>
    </nav>

    <div class="wrapper">
      <img class="icon" src="../uploadedimages/<?php echo $user_data['user_img']; ?>">
      <p class="status">Your username is  <?php echo $user_data['user_name']; ?></p>
      <p class="status">Your account number is  <?php echo $user_data['acc_num']; ?></p>
      <p class="status">Your account balance is  $<?php echo $result['acc_bal']; ?></p>
    </div>
    
</body>
</html>
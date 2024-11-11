<?php
session_start();
include("../connection.php");
include("../functions.php");
$user_data = check_login_admin($con);


if($_SERVER['REQUEST_METHOD'] == "POST"){

  if(isset($_POST['b_1'])) {


  $user_id=$user_data['user_id'];
  $flag= $user_data['user_pass'];
  $old_pass = $_POST['old_pass'];
  $new_pass = $_POST['new_pass'];
  $c_new_pass = $_POST['c_new_pass'];



  if($flag==$old_pass){
    if($new_pass==$c_new_pass){
      $query = "UPDATE admin_info SET user_pass='$new_pass' WHERE user_id='$user_id' ";
                $r = mysqli_query($con,$query);

                $alert = "<script>alert('Password Changed!');</script>";
                  echo $alert;
    }else{
      $alert = "<script>alert('New password dosent match!');</script>";
                  echo $alert;
    }
  }else{
    $alert = "<script>alert('Old password dosent match!');</script>";
                  echo $alert;
  }
 }
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
    <link rel="stylesheet" href="change_pass.css">
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
       <li><a class="" href="admin_profile.php">Profile</a></li>
        <li><a class="" href="manage.php">Manage</a></li>
        <li><a class="" href="t_history.php">T.History</a></li>
        <li><a class="" href="c_card.php">C-card</a></li>
        <li><a class="" href="cc_request.php">Request</a></li>
        <li><a class="active" href="change_pass.php">Change Pass</a></li>
        <li><a href="../logout.php">Logout</a></li>
      </ul>
    </nav>
    
    <div class="wrapper">
         <h2>Change Password</h2>
         <form method="post" enctype="multipart/form-data" spellcheck="false">
            <div class="input-box">
                <input type="password" name="old_pass" placeholder="Old Password" required>
            </div>
            <div class="input-box">
                <input type="password" name="new_pass" placeholder="New Password" required>
            </div>
            <div class="input-box">
                <input type="password" name="c_new_pass" placeholder="Confirm New Password" required>
            </div>
            <div class="input-box button">
                <button type="submit" name="b_1">Submit</button>
            </div>
         </form>
    </div>

</body>
</html>
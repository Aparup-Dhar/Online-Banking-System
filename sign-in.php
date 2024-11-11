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



  if($_SERVER['REQUEST_METHOD'] == "POST"){
    $user_name = $_POST['user_name'];
    $user_pass = $_POST['user_pass'];

    if(!empty($user_name) && !empty($user_pass)){
        
      $query1="select acc_num,user_pass from user_info where user_name='$user_name' and user_pass='$user_pass'";
      $query2="select user_id,user_pass from admin_info where user_name='$user_name' and user_pass='$user_pass'";

      $r1=mysqli_query($con,$query1);
      $r2=mysqli_query($con,$query2);

      if(mysqli_num_rows($r1) >= 1){
        $user_data = mysqli_fetch_assoc($r1);
            
            $_SESSION['acc_num'] = $user_data['acc_num'];
            header("Location: user/user_profile.php");
        }
      else if(mysqli_num_rows($r2) >= 1){
        $user_data = mysqli_fetch_assoc($r2);
            
            $_SESSION['user_id'] = $user_data['user_id'];
            header("Location: admin/admin_profile.php");
        }
        else{
          $alert = "<script>alert('Incorrect Username or Password!');</script>";
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
    <link rel="stylesheet" href="style_sign-in.css">
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
        <li><a href="index.php">Home</a></li>
        <li><a href="sign-up.php">Sign-up</a></li>
        <li><a class="active" href="sign-in.php">Sign-in</a></li>
      </ul>
    </nav>
    
    <div class="wrapper">
         <h2>Sign-in</h2>
         <form method="post" enctype="multipart/form-data" spellcheck="false">
            <div class="input-box">
                <input type="text" name="user_name" placeholder="Username" required>
            </div>
            <div class="input-box">
                <input type="password" name="user_pass" placeholder="Password" required>
            </div>
            <div class="input-box button">
                <button>Sign-in</button>
            </div>
            <div class="text">
                <h3>Don't have an account? <a href="sign-up.php">Sign-up</a></h3>
            </div>
         </form>
    </div>

</body>
</html>
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
    $user_email = $_POST['user_email'];
    $user_dob = $_POST['user_dob'];
    $user_pass = $_POST['user_pass'];
    $pass_conf = $_POST['pass_conf'];
    $user_img = $_FILES['img']['name'];
  
	 

    if(!empty($user_name) && !empty($user_email) && !empty($user_pass) && !empty($user_dob) && $user_pass==$pass_conf){
        $acc_num = acc_num_gen(7);
        if($user_img){
        $ext= explode(".",$_FILES['img']['name']);      
        $c=count($ext);
        $ext=$ext[$c-1];
        $user_img=$acc_num.".".$ext;}
        else{
            $user_img="default.png";
        }
        $query = "insert into user_info (acc_num,user_name,user_email,user_dob,user_pass,user_img) values ('$acc_num','$user_name','$user_email','$user_dob','$user_pass','$user_img')";
        $query2 = "insert into user_balance (user_name,acc_num,acc_bal) values ('$user_name','$acc_num','1000')";

       
        
        if(mysqli_query($con,$query) &&  mysqli_query($con,$query2)){
          	if($user_img !=null){
	                move_uploaded_file($_FILES['img']['tmp_name'],"uploadedimages/$user_img");
                    }
          $alert = "<script>alert('Sucessfully signed-up!');</script>";
        echo $alert;
        }
    }
    else
    {
        $alert = "<script>alert('Please enter valid information!');</script>";
        echo $alert;
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
    <link rel="stylesheet" href="style_sign-up.css">
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
        <li><a class="active" href="sign-up.php">Sign-up</a></li>
        <li><a href="sign-in.php">Sign-in</a></li>
      </ul>
    </nav>
    
    <div class="wrapper">
         <h2>Sign-up</h2>
         <form method="post" enctype="multipart/form-data" spellcheck="false">
            <div class="input-box">
                <input type="text" name="user_name" placeholder="Username" required>
            </div>
            <div class="input-box">
                <input type="email" name="user_email" placeholder="Email" required>
            </div>
            <div class="input-box">
                <input type="date" name="user_dob" placeholder="Date of birth" required>
            </div>
            <div class="input-box">
                <input type="password" name="user_pass" placeholder="Password" required>
            </div>
            <div class="input-box">
                <input type="password" name="pass_conf" placeholder="Confirm Password" required>
            </div>
            <div class="upload-box"> 
                <input class="upload" type="file" name="img" id="real-file" hidden="hidden">
                <button type="button" id="custom-button">Upload IMG</button>
                <span id="custom-text">No file selected</span>

                <script type="text/javascript">
                        const realFileBtn = document.getElementById("real-file");
                        const customBtn = document.getElementById("custom-button");
                        const customTxt = document.getElementById("custom-text");
                        customBtn.addEventListener("click", function() {
                        realFileBtn.click();
                        });
                        realFileBtn.addEventListener("change", function() {
                        if (realFileBtn.value) {
                        customTxt.innerHTML = realFileBtn.value.match(/[\/\\]([\w\d\s\.\-\(\)]+)$/)[1];
                        } else {
                        customTxt.innerHTML = "No file selected";
                        }
                        });
                    </script>
            </div> 
            <div class="input-box button">
                <button>Sign-up</button>
            </div>
            <div class="text">
                <h3>Already have an account? <a href="sign-in.php">Sign-in</a></h3>
            </div>
         </form>
    </div>

</body>
</html>
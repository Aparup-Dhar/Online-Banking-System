<?php
  session_start();
  include("../connection.php");
  include("../functions.php");
  $user_data = check_login_user($con);



  if($_SERVER['REQUEST_METHOD'] == "POST"){

    $acc_num= $user_data['acc_num'];
    $cc_name = $_POST['cc_name'];

    $select2 = "select cc_id from credit_card where cc_name='$cc_name'";
    $query2 = mysqli_query($con,$select2);
    $row = mysqli_fetch_assoc($query2);
    $cc_id=$row['cc_id'];
    $cc_num = cc_num_gen(4);

    $insert = "insert into cc_status (acc_num,cc_num,cc_id,cc_name,cc_stat) values ('$acc_num','$cc_num','$cc_id','$cc_name','Pending')";
    
    if($query3 = mysqli_query($con,$insert)){
      $alert = "<script>alert('Sucessfully applied!');</script>";
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
    <link rel="stylesheet" href="c_card.css">
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
        <li><a class="" href="user_profile.php">Profile</a></li>
        <li><a class="" href="transfer.php">Transfer</a></li>
        <li><a class="" href="t_history.php">T.History</a></li>
        <li><a class="active" href="c_card.php">C-card</a></li>
        <li><a class="" href="cc_status.php">Status</a></li>
        <li><a class="" href="change_pass.php">Change Pass</a></li>
        <li><a href="../logout.php">Logout</a></li>
      </ul>
    </nav>
    
    <div class="popup-wrapper">
      <div class="popup">
        <div class="popup-close">x</div>
          <form method="post" enctype="multipart/form-data" spellcheck="false">
          <div class="input-box">
          <select name="cc_name" class="selector">
                     <?php
                      $select = "select * from credit_card";
                      $query = mysqli_query($con,$select);
                      if(mysqli_num_rows($query)>0){
                        foreach($query as $result){
                          echo"<option value='$result[cc_name]'>$result[cc_name]</option>";
                        }
                      }
                      ?>
                        </select>
                <button class="sub" type="submit" name="b_2">Apply</button>
            </div>
          </form>
      </div>
    </div>

    <div class="wrapper">
      <button class='apply' type="submit" name="b_1">Apply</button>
    </form>

    <?php

        $select = "select * from credit_card";
        $query = mysqli_query($con,$select);

        echo"<table>
        <tr>
          <th>Serial No</th>
          <th>Credit Card Name</th>
          <th>Credit Card Limit</th>
          <th>Image</th>
        </tr>";
            
        $i=1;
        if(mysqli_num_rows($query)>0){
          foreach($query as $result){
            echo 
            "<tr>
            <td>$i</td>
            <td>$result[cc_name]</td>
            <td>$$result[cc_lim]</td>
            <td><img class='icon' src='../cc_images/$result[cc_img]'></td>
            </tr>";
            $i=$i+1;
          }
        }

    ?>

    </div>
    <script src="script2.js"></script>
</body>
</html>
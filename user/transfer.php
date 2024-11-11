<?php
  session_start();
  include("../connection.php");
  include("../functions.php");
  $user_data = check_login_user($con);



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
    <link rel="stylesheet" href="transfer.css">
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
        <li><a class="active" href="transfer.php">Transfer</a></li>
        <li><a class="" href="t_history.php">T.History</a></li>
        <li><a class="" href="c_card.php">C-card</a></li>
        <li><a class="" href="cc_status.php">Status</a></li>
        <li><a class="" href="change_pass.php">Change Pass</a></li>
        <li><a href="../logout.php">Logout</a></li>
      </ul>
    </nav>

    <div class="popup-wrapper">
      <div class="popup">
        <div class="popup-close">x</div>
        <div class="popup-content">
          <form method="post" enctype="multipart/form-data" spellcheck="false">
          <div class="input-box">
                <input type="text" name="user_name" id="user_name" onkeydown="return false;"
                style="caret-color: transparent !important;" required>
                <input type="text" name="acc_num" id="acc_num" onkeydown="return false;"
                style="caret-color: transparent !important;" required>
                <input type="number" name="t_amount" placeholder="Enter transfer amount" min="0" required>
            </div>
            <div class="input-box button">
                <button type="submit" name="b_3">Transfer</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div class="wrapper">
      
    <form method="post" enctype="multipart/form-data" spellcheck="false" class="search-box">
      <input type="text" placeholder="Search" class="search" name="search">
      <button type="submit" name="b_1">Search</button>
      <button type="submit" name="b_2">Search All</button>
    </form>


    <?php

      if($_SERVER['REQUEST_METHOD'] == "POST"){

        if(isset($_POST['b_1'])) {

        $search = $_POST['search'];
        $select = "select * from user_info where user_name!='$user_data[user_name]' and CONCAT(user_name) like '%$search%' order by user_name";
        $query = mysqli_query($con,$select);

        echo"<table>
        <tr>
          <th>Serial No</th>
          <th>Username</th>
          <th>Account Number</th>
          <th>Actions</th>
        </tr>";
            
        $i=1;
        if(mysqli_num_rows($query)>0){
          foreach($query as $result){
            echo 
            "<tr>
            <td>$i</td>
            <td>$result[user_name]</td>
            <td>$result[acc_num]</td>
            <td><button class='action'>Transfer</button></td>
            </tr>";
            $i=$i+1;
          }
        }

      }else if(isset($_POST['b_2'])) {


        $select = "select * from user_info where user_name!='$user_data[user_name]' order by user_name";
        $query = mysqli_query($con,$select);

        echo"<table>
        <tr>
          <th>Serial No</th>
          <th>Username</th>
          <th>Account Number</th>
          <th>Actions</th>
        </tr>";
            
        $i=1;
        if(mysqli_num_rows($query)>0){
          foreach($query as $result){
            echo 
            "<tr>
            <td>$i</td>
            <td>$result[user_name]</td>
            <td>$result[acc_num]</td>
            <td><button class='action'>Transfer</button></td>
            </tr>";
            $i=$i+1;
          }
        }

      }
    } 
    ?>
</table>
     <?php

        if($_SERVER['REQUEST_METHOD'] == "POST"){

          if(isset($_POST['b_3'])) {

            $c_user_acc_num = $user_data['acc_num'];
            $query1 = "select acc_bal from user_balance where acc_num='$c_user_acc_num' ";
            $r1 = mysqli_query($con,$query1);
            if (mysqli_num_rows($r1) > 0) {
              while($row1 = mysqli_fetch_assoc($r1)) {
                $c_user_bal = $row1["acc_bal"];
              }}

            $t_amount = $_POST['t_amount'];
            $t_user_acc_num = $_POST['acc_num'];
            

            $query2 = "select acc_bal from user_balance where acc_num='$t_user_acc_num' ";
            $r2 = mysqli_query($con,$query2);
            if (mysqli_num_rows($r2) > 0) {
              while($row2 = mysqli_fetch_assoc($r2)) {
                $t_user_bal = $row2["acc_bal"];
              }}

              if($c_user_bal>=$t_amount){
                $c_user_new_bal = $c_user_bal-$t_amount;
                $query3 = "UPDATE user_balance SET acc_bal='$c_user_new_bal' WHERE acc_num='$c_user_acc_num' ";
                $r3 = mysqli_query($con,$query3);
        
                $t_user_new_bal = $t_user_bal+$t_amount;
                $query4 = "UPDATE user_balance SET acc_bal='$t_user_new_bal' WHERE acc_num='$t_user_acc_num' ";
                $r4 = mysqli_query($con,$query4);


                $t_date=date('Y-m-d');
                $query5 = "INSERT into t_history (sender,recipient,amount,t_date,s_cur_bal,r_cur_bal) values ('$c_user_acc_num','$t_user_acc_num','$t_amount','$t_date','$c_user_new_bal','$t_user_new_bal')";
                $r5 = mysqli_query($con,$query5);

                $alert = "<script>alert('Transfer sucessful!');</script>";
                  echo $alert;
                
              }
              else{
                $alert = "<script>alert('You dont have sufficient balance!');</script>";
                  echo $alert;
              }
          }
        }
     ?>

    </div>
    <script src="script.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
        $(document).ready(function () {

            $('.action').on('click', function () {


                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();

                
                $('#i').val(data[0]);
                $('#user_name').val(data[1]);
                $('#acc_num').val(data[2]);
            });
        });
    </script>
    
</body>
</html>
<?php
  session_start();
  include("../connection.php");
  include("../functions.php");
  $user_data = check_login_admin($con);



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
    <link rel="stylesheet" href="manage.css">
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
        <li><a class="active" href="manage.php">Manage</a></li>
        <li><a class="" href="t_history.php">T.History</a></li>
        <li><a class="" href="c_card.php">C-card</a></li>
        <li><a class="" href="cc_request.php">Request</a></li>
        <li><a class="" href="change_pass.php">Change Pass</a></li>
        <li><a href="../logout.php">Logout</a></li>
      </ul>
    </nav>
    
    <div class="popup-wrapper">
      <div class="popup">
        <div class="popup-close">x</div>
          <form method="post" enctype="multipart/form-data" spellcheck="false">
          <div class="input-box">
                <input type="text" name="user_name" id="user_name" onkeydown="return false;"
                style="caret-color: transparent !important;" required>
                <input type="text" name="acc_num" id="acc_num" onkeydown="return false;"
                style="caret-color: transparent !important;" required>
                <input type="text" name="acc_bal" id="acc_bal" onkeydown="return false;"
                style="caret-color: transparent !important;" required>
                <input type="number" name="c_amount" placeholder="Enter credit amount" min="0" required>
                <button class="c_button" type="submit" name="b_3">Credit</button>
            </div>
                
          </form>
      </div>
    </div>

    <div class="popup-wrapper2">
      <div class="popup2">
        <div class="popup-close2">x</div>
        <div class="popup-content2">
          <form method="post" enctype="multipart/form-data" spellcheck="false">
          <div class="input-box2">
                <input type="text" name="user_name" id="user_name2" onkeydown="return false;"
                style="caret-color: transparent !important;" required>
                <input type="text" name="acc_num" id="acc_num2" onkeydown="return false;"
                style="caret-color: transparent !important;" required>
                <input type="text" name="acc_bal" id="acc_bal2" onkeydown="return false;"
                style="caret-color: transparent !important;" required>
                <input type="number" name="d_amount" placeholder="Enter debit amount" min="0" required>
                <button class="d_button" type="submit" name="b_4">Debit</button>
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
        $select = "select * from user_balance where user_name like '%$search%' order by user_name";
        $query = mysqli_query($con,$select);

        echo"<table>
        <tr>
          <th>Serial No</th>
          <th>Username</th>
          <th>Account Number</th>
          <th>Account Balance</th>
          <th colspan='2'>Actions</th>
        </tr>";
            
        $i=1;
        if(mysqli_num_rows($query)>0){
          foreach($query as $result){
            echo 
            "<tr>
            <td>$i</td>
            <td>$result[user_name]</td>
            <td>$result[acc_num]</td>
            <td>$$result[acc_bal]</td>
            <td><button class='credit'>Credit</button></td>
            <td><button class='debit'>Debit</button></td>
            </tr>";
            $i=$i+1;
          }
        }

      }else if(isset($_POST['b_2'])) {


        $select = "select * from user_balance order by user_name";
        $query = mysqli_query($con,$select);

        echo"<table>
        <tr>
          <th>Serial No</th>
          <th>Username</th>
          <th>Account Number</th>
          <th>Account Balance</th>
          <th colspan='2'>Actions</th>
        </tr>";
            
        $i=1;
        if(mysqli_num_rows($query)>0){
          foreach($query as $result){
            echo 
            "<tr>
            <td>$i</td>
            <td>$result[user_name]</td>
            <td>$result[acc_num]</td>
            <td>$$result[acc_bal]</td>
            <td><button class='credit'>Credit</button></td>
            <td><button class='debit'>Debit</button></td>
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

            $c_amount = $_POST['c_amount'];
            $user_acc_num = $_POST['acc_num'];
            

            $query2 = "select acc_bal from user_balance where acc_num='$user_acc_num' ";
            $r2 = mysqli_query($con,$query2);
            if (mysqli_num_rows($r2) > 0) {
              while($row2 = mysqli_fetch_assoc($r2)) {
                $user_bal = $row2["acc_bal"];
              }}

              
                $user_new_bal = $user_bal+$c_amount;
                $query3 = "UPDATE user_balance SET acc_bal='$user_new_bal' WHERE acc_num='$user_acc_num' ";
                $r3 = mysqli_query($con,$query3);
                

                $alert = "<script>alert('Credit sucessful!');</script>";
                  echo $alert;
          }
          else if(isset($_POST['b_4'])) {

            $d_amount = $_POST['d_amount'];
            $user_acc_num = $_POST['acc_num'];
            

            $query2 = "select acc_bal from user_balance where acc_num='$user_acc_num' ";
            $r2 = mysqli_query($con,$query2);
            if (mysqli_num_rows($r2) > 0) {
              while($row2 = mysqli_fetch_assoc($r2)) {
                $user_bal = $row2["acc_bal"];
              }}

              
                $user_new_bal = $user_bal-$d_amount;
                $query3 = "UPDATE user_balance SET acc_bal='$user_new_bal' WHERE acc_num='$user_acc_num' ";
                $r3 = mysqli_query($con,$query3);

                $alert = "<script>alert('Debit sucessful!');</script>";
                  echo $alert;
          }
        }
     ?>

    </div>
    <script src="script.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
        $(document).ready(function () {

            $('.credit').on('click', function () {


                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();


                $('#i').val(data[0]);
                $('#user_name').val(data[1]);
                $('#acc_num').val(data[2]);
                $('#acc_bal').val(data[3]);
                
            });
        });

        $(document).ready(function () {

$('.debit').on('click', function () {


    $tr = $(this).closest('tr');

    var data = $tr.children("td").map(function () {
        return $(this).text();
    }).get();


    $('#i2').val(data[0]);
    $('#user_name2').val(data[1]);
    $('#acc_num2').val(data[2]);
    $('#acc_bal2').val(data[3]);
    
});
});
    </script>
    
</body>
</html>
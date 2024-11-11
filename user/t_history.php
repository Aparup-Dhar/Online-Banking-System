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
    <link rel="stylesheet" href="t_history.css">
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
        <li><a class="active" href="t_history.php">T.History</a></li>
        <li><a class="" href="c_card.php">C-card</a></li>
        <li><a class="" href="cc_status.php">Status</a></li>
        <li><a class="" href="change_pass.php">Change Pass</a></li>
        <li><a href="../logout.php">Logout</a></li>
      </ul>
    </nav>
    

    <div class="wrapper">
    </form>

    <?php

        $user_acc_num = $user_data['acc_num']; 
        $select = "select * from t_history where sender='$user_acc_num' || recipient='$user_acc_num' ";
        $query = mysqli_query($con,$select);

        echo"<table>
        <tr>
          <th>Serial No</th>
          <th>Sender</th>
          <th>Recipient</th>
          <th>Amount</th>
          <th>Date</th>
          <th>Balance</th>
        </tr>";
            
        $i=1;
        if(mysqli_num_rows($query)>0){
          foreach($query as $result){
            echo 
            "<tr>
            <td>$i</td>";
            if($result['sender']==$user_acc_num)
            {echo "<td><p class='status-self'>C.User ($result[sender])</p></td>";}
            else
            { 
              $query1="SELECT user_name from user_info where acc_num='$result[sender]' ";
              $r1 = mysqli_query($con,$query1);
              if (mysqli_num_rows($r1) > 0) {
                while($row1 = mysqli_fetch_assoc($r1)) {
                  $s_name = $row1["user_name"];
                }}

              echo "<td>$s_name ($result[sender])</td>";}

            if($result['recipient']==$user_acc_num)
            {echo "<td><p class='status-self'>C.User ($result[recipient])</p></td>";}
            else
            { 
              $query2="SELECT user_name from user_info where acc_num='$result[recipient]' ";
              $r2 = mysqli_query($con,$query2);
              if (mysqli_num_rows($r2) > 0) {
                while($row2 = mysqli_fetch_assoc($r2)) {
                  $r_name = $row2["user_name"];
                }}

              echo "<td>$r_name ($result[recipient])</td>";}
            
              if($result['sender']==$user_acc_num)
              {echo "<td><p class='status-debit'>-$$result[amount]</p></td>";}
              else
              {echo "<td><p class='status-credit'>+$$result[amount]</p></td>";}

              echo"<td>$result[t_date]</td>";

              if($result['sender']==$user_acc_num)
              {echo "<td><p class=''>$$result[s_cur_bal]</p></td>";}
              else
              {echo "<td><p class=''>$$result[r_cur_bal]</p></td>";}

            $i=$i+1;
          }
        }

    ?>

    </div>
  
</body>
</html>
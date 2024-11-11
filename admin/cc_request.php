<?php
  session_start();
  include("../connection.php");
  include("../functions.php");
  $user_data = check_login_admin($con);


  if($_SERVER['REQUEST_METHOD'] == "POST"){

    if(isset($_POST['b_1'])){

    
    $update = $_POST['update'];
    $cc_num = $_POST['cc_num'];

    $query1 = "UPDATE cc_status SET cc_stat='$update' WHERE cc_num='$cc_num' ";
    $r1 = mysqli_query($con,$query1);

    $alert = "<script>alert('Update Sucessful!');</script>";
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
    <link rel="stylesheet" href="cc_request.css">
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
        <li><a class="active" href="cc_request.php">Request</a></li>
        <li><a class="" href="change_pass.php">Change Pass</a></li>
        <li><a href="../logout.php">Logout</a></li>
      </ul>
    </nav>
    
    <div class="popup-wrapper2">
      <div class="popup2">
        <div class="popup-close2">x</div>
          <form method="post" enctype="multipart/form-data" spellcheck="false">
          <div class="input-box2">
          <input type="text" name="cc_num" id="cc_num" onkeydown="return false;"
                style="caret-color: transparent !important;" required>
                  <select name="update" class="selector">
                      <option value='Pending'>Pending</option>
                      <option value='Approved'>Approved</option>
                      <option value='Rejected'>Rejected</option>
                  </select>
                <button class="sub" type="submit" name="b_1">Update</button>
            </div>
          </form>
      </div>
    </div>

    <div class="wrapper">
    <form method="post" enctype="multipart/form-data" spellcheck="false">
      <div class="option">
      <button type="submit" name="b_2">View All</button>
      <button type="submit" name="b_3">Approved</button>
      <button type="submit" name="b_4">Pending</button>
      <button type="submit" name="b_5">Rejected</button>
      </div>
    </form>
      
   

    <?php
        

        if($_SERVER['REQUEST_METHOD'] == "POST"){

          if(isset($_POST['b_2'])){        
        $select = "select * from cc_status";
        $query = mysqli_query($con,$select);
        echo"<table>
        <tr>
          <th>Serial No</th>
          <th>Account Number</th>
          <th>Credit Card Number</th>
          <th>Credit Card ID</th>
          <th>Image</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>";
            
        $i=1;
        if(mysqli_num_rows($query)>0){
          foreach($query as $result){

            $select2 = "select cc_lim,cc_img from credit_card where cc_id='$result[cc_id]' ";
            $query2 = mysqli_query($con,$select2);
            $result2 = mysqli_fetch_assoc($query2);

            echo 
            "<tr>
            <td>$i</td>
            <td>$result[acc_num]</td>
            <td>$result[cc_num]</td>
            <td>$result[cc_id]</td>
            <td><img class='icon' src='../cc_images/$result2[cc_img]'></td>";
            if($result['cc_stat']=="Pending")
            {echo "<td><p class='status-pending'>$result[cc_stat]</p></td>";}
            else if($result['cc_stat']=="Approved")
            {echo "<td><p class='status-approved'>$result[cc_stat]</p></td>";}
            else
            {echo "<td><p class='status-rejected'>$result[cc_stat]</p></td>";}
            echo "<td><button class='update'>Update</button></td></tr>";
            $i=$i+1;
          }
        }}
        else if(isset($_POST['b_3'])){
        $select = "select * from cc_status where cc_stat='Approved' ";
        $query = mysqli_query($con,$select);
        echo"<table>
        <tr>
          <th>Serial No</th>
          <th>Account Number</th>
          <th>Credit Card Number</th>
          <th>Credit Card ID</th>
          <th>Image</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>";
            
        $i=1;
        if(mysqli_num_rows($query)>0){
          foreach($query as $result){

            $select2 = "select cc_lim,cc_img from credit_card where cc_id='$result[cc_id]' ";
            $query2 = mysqli_query($con,$select2);
            $result2 = mysqli_fetch_assoc($query2);

            echo 
            "<tr>
            <td>$i</td>
            <td>$result[acc_num]</td>
            <td>$result[cc_num]</td>
            <td>$result[cc_id]</td>
            <td><img class='icon' src='../cc_images/$result2[cc_img]'></td>";
            if($result['cc_stat']=="Pending")
            {echo "<td><p class='status-pending'>$result[cc_stat]</p></td>";}
            else if($result['cc_stat']=="Approved")
            {echo "<td><p class='status-approved'>$result[cc_stat]</p></td>";}
            else
            {echo "<td><p class='status-rejected'>$result[cc_stat]</p></td>";}
            echo "<td><button class='update'>Update</button></td></tr>";
            $i=$i+1;
          }
        }}
        else if(isset($_POST['b_4'])){
        $select = "select * from cc_status where cc_stat='Pending' ";
        $query = mysqli_query($con,$select);
        echo"<table>
        <tr>
          <th>Serial No</th>
          <th>Account Number</th>
          <th>Credit Card Number</th>
          <th>Credit Card ID</th>
          <th>Image</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>";
            
        $i=1;
        if(mysqli_num_rows($query)>0){
          foreach($query as $result){

            $select2 = "select cc_lim,cc_img from credit_card where cc_id='$result[cc_id]' ";
            $query2 = mysqli_query($con,$select2);
            $result2 = mysqli_fetch_assoc($query2);

            echo 
            "<tr>
            <td>$i</td>
            <td>$result[acc_num]</td>
            <td>$result[cc_num]</td>
            <td>$result[cc_id]</td>
            <td><img class='icon' src='../cc_images/$result2[cc_img]'></td>";
            if($result['cc_stat']=="Pending")
            {echo "<td><p class='status-pending'>$result[cc_stat]</p></td>";}
            else if($result['cc_stat']=="Approved")
            {echo "<td><p class='status-approved'>$result[cc_stat]</p></td>";}
            else
            {echo "<td><p class='status-rejected'>$result[cc_stat]</p></td>";}
            echo "<td><button class='update'>Update</button></td></tr>";
            $i=$i+1;
          }
        }}
        else if(isset($_POST['b_5'])){
        $select = "select * from cc_status where cc_stat='Rejected' ";
        $query = mysqli_query($con,$select);
        echo"<table>
        <tr>
          <th>Serial No</th>
          <th>Account Number</th>
          <th>Credit Card Number</th>
          <th>Credit Card ID</th>
          <th>Image</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>";
            
        $i=1;
        if(mysqli_num_rows($query)>0){
          foreach($query as $result){

            $select2 = "select cc_lim,cc_img from credit_card where cc_id='$result[cc_id]' ";
            $query2 = mysqli_query($con,$select2);
            $result2 = mysqli_fetch_assoc($query2);

            echo 
            "<tr>
            <td>$i</td>
            <td>$result[acc_num]</td>
            <td>$result[cc_num]</td>
            <td>$result[cc_id]</td>
            <td><img class='icon' src='../cc_images/$result2[cc_img]'></td>";
            if($result['cc_stat']=="Pending")
            {echo "<td><p class='status-pending'>$result[cc_stat]</p></td>";}
            else if($result['cc_stat']=="Approved")
            {echo "<td><p class='status-approved'>$result[cc_stat]</p></td>";}
            else
            {echo "<td><p class='status-rejected'>$result[cc_stat]</p></td>";}
            echo "<td><button class='update'>Update</button></td></tr>";
            $i=$i+1;
          }
        }}   

      }

    ?>

    </div>
    <script src="script3.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
        $(document).ready(function () {

            $('.update').on('click', function () {


                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();

                $('#i').val(data[0]);
                $('#acc_num').val(data[1]);
                $('#cc_num').val(data[2]);
                
            });
        });
      </script>
</body>
</html>
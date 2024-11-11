<?php
  session_start();
  include("../connection.php");
  include("../functions.php");
  $user_data = check_login_admin($con);



  if($_SERVER['REQUEST_METHOD'] == "POST"){

    if(isset($_POST['b_2'])){

    $cc_id = $_POST['cc_id'];
    $cc_name = $_POST['cc_name'];
    $cc_lim = $_POST['cc_lim'];
    $cc_img = $_FILES['cc_img']['name'];
  
	 

    if(!empty($cc_id) && !empty($cc_name) && !empty($cc_lim)){
        
        if($cc_img){
        $ext= explode(".",$_FILES['cc_img']['name']);      
        $c=count($ext);
        $ext=$ext[$c-1];
        $cc_img=$cc_id.".".$ext;}
        else{
            $cc_img="default.png";
        }
        $query = "insert into credit_card (cc_id,cc_name,cc_lim,cc_img) values ('$cc_id','$cc_name','$cc_lim','$cc_img')";
       
        
        if(mysqli_query($con,$query)){
          	if($cc_img !=null){
	                move_uploaded_file($_FILES['cc_img']['tmp_name'],"../cc_images/$cc_img");
                    }
          $alert = "<script>alert('Sucessfully created!');</script>";
        echo $alert;
        }
    }
    else
    {
        $alert = "<script>alert('Please enter valid information!');</script>";
        echo $alert;
    }
   }else if(isset($_POST['b_3'])){


    $cc_id = $_POST['cc_id'];
    $cc_name = $_POST['cc_name'];
    $cc_lim = $_POST['cc_lim'];

    $query2 = "UPDATE credit_card SET cc_name='$cc_name',cc_lim='$cc_lim' WHERE cc_id='$cc_id' ";
                $r2 = mysqli_query($con,$query2);

                $alert = "<script>alert('Edit sucessful!');</script>";
                  echo $alert;


   }else if(isset($_POST['b_4'])){


    $cc_id = $_POST['cc_id2'];

    $query3 = "DELETE from credit_card where cc_id='$cc_id' ";
                $r3 = mysqli_query($con,$query3);

    $query4 = "DELETE from cc_status where cc_id='$cc_id' ";
                $r4 = mysqli_query($con,$query4);

                $alert = "<script>alert('Delete sucessful!');</script>";
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
        <li><a class="" href="admin_profile.php">Profile</a></li>
        <li><a class="" href="manage.php">Manage</a></li>
        <li><a class="" href="t_history.php">T.History</a></li>
        <li><a class="active" href="c_card.php">C-card</a></li>
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
                <input type="text" name="cc_id" placeholder="Enter credit card id" required>
                <input type="text" name="cc_name" placeholder="Enter credit card name" required>
                <input type="number" name="cc_lim" placeholder="Enter credit card limit" required>
                <div class="upload-box"> 
                <input class="upload" type="file" name="cc_img" id="real-file" hidden="hidden">
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
                <button class="sub" type="submit" name="b_2">Submit</button>
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
                <input type="text" id="cc_id" name="cc_id" onkeydown="return false;"
                style="caret-color: transparent !important;" required>
                <input type="text" id="cc_name" name="cc_name" placeholder="Enter Credit Card Name" required>
                <input type="number" id="cc_lim" name="cc_lim" placeholder="Enter Credit Card Limit" min="0" required>
                <button class="e_button" type="submit" name="b_3">Edit</button>
            </div>
          </form>
        </div>
      </div>
    </div>


    <div class="popup-wrapper3">
      <div class="popup3">
        <div class="popup-close3">x</div>
        <div class="popup-content3">
          <form method="post" enctype="multipart/form-data" spellcheck="false">
          <div class="input-box2">
                <input type="text" id="cc_id2" name="cc_id2" onkeydown="return false;"
                style="caret-color: transparent !important;" required>
                <input type="text" id="cc_name2" name="cc_name2" onkeydown="return false;"
                style="caret-color: transparent !important;" required>
                <input type="text" id="cc_lim2" name="cc_lim2" onkeydown="return false;"
                style="caret-color: transparent !important;" required>
                <button class="d_button" type="submit" name="b_4">Delete</button>
            </div>
          </form>
        </div>
      </div>
    </div>


    

    <div class="wrapper">
      <button class='create' type="submit" name="b_1">Create</button>
    </form>

    <?php

        $select = "select * from credit_card";
        $query = mysqli_query($con,$select);

        echo"<table>
        <tr>
          <th>Serial No</th>
          <th>Credit Card ID</th>
          <th>Credit Card Name</th>
          <th>Credit Card Limit</th>
          <th>Image</th>
          <th colspan='2'>Actions</th>
        </tr>";
            
        $i=1;
        if(mysqli_num_rows($query)>0){
          foreach($query as $result){
            echo 
            "<tr>
            <td>$i</td>
            <td>$result[cc_id]</td>
            <td>$result[cc_name]</td>
            <td>$$result[cc_lim]</td>
            <td><img class='icon' src='../cc_images/$result[cc_img]'></td>
            <td><button class='edit'>Edit</button></td>
            <td><button class='delete' type='submit' name='b_4'>Delete</button></td>
            </tr>";
            $i=$i+1;
          }
        }

    ?>

    </div>
    <script src="script2.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
        $(document).ready(function () {

            $('.edit').on('click', function () {


                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();


                $('#i').val(data[0]);
                $('#cc_id').val(data[1]);
                $('#cc_name').val(data[2]);
                $('#cc_lim').val(data[3]);
                
            });
        });


                  $(document).ready(function () {

          $('.delete').on('click', function () {


              $tr = $(this).closest('tr');

              var data = $tr.children("td").map(function () {
                  return $(this).text();
              }).get();


              $('#i2').val(data[0]);
              $('#cc_id2').val(data[1]);
              $('#cc_name2').val(data[2]);
              $('#cc_lim2').val(data[3]);
              
          });
          });
        </script>
</body>
</html>
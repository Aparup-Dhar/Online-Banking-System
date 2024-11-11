<?php
	function acc_num_gen($length) {
    $char = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charlen = strlen($char);
    $p1 = '';
    for ($i = 0; $i < $length; $i++) {
        $p1 .= $char[rand(0, $charlen - 1)];
    }
        $p2 = "";

    for($i=0;$i<$length;$i++){
        $p2 .= rand(0,9); 
    }
    return $val=$p1.$p2;
	  
	}

    function cc_num_gen($length) {

        $p1 = "";
        $p2 = "";
        $p3 = "";
        $p4 = "";

    for($i=0;$i<$length;$i++){
        $p1 .= rand(0,9);
          $p2 .= rand(0,9); 
            $p3 .= rand(0,9); 
              $p4 .= rand(0,9); 
    }
    return $val=$p1.-$p2.-$p3.-$p4;
	  
	}

    function check_login_user($con){
        if(isset($_SESSION['acc_num'])){
            $acc_num = $_SESSION['acc_num'];
            $query = "select * from user_info where acc_num = '$acc_num' limit 1";
            $result = mysqli_query($con,$query);
            if(mysqli_num_rows($result) >= 1){
                $user_data = mysqli_fetch_assoc($result);
                return $user_data;
            }
        }
        header("Location: ../sign-in.php");
        die;
    }

    function check_login_admin($con){
        if(isset($_SESSION['user_id'])){
            $user_id = $_SESSION['user_id'];
            $query = "select * from admin_info where user_id = '$user_id' limit 1";
            $result = mysqli_query($con,$query);
            if($result && mysqli_num_rows($result) > 0){
                $user_data = mysqli_fetch_assoc($result);
                return $user_data;
            }
        }
        else{
        header("Location: ../index.php");
        die;}
    }

?>
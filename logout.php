<?php
session_start();

if(isset ($_SESSION['acc_num'])){
    unset($_SESSION['acc_num']);
}
else if(isset ($_SESSION['user_id'])){
    unset($_SESSION['user_id']);
}


header("Location: index.php");
die;
<?php
include 'user.php';
$target_file = 'image/pic_'.get_user()['uid'].'.png';
$upload = true;
$type = pathinfo($target_file,PATHINFO_EXTENSION);
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["uploaded_image"]["tmp_name"]);
    if($check !== false) {
        $upload = true;
    } else {
        $upload = false;
    }
}
if ($_FILES["uploaded_image"]["size"] > 500000) {
    $upload = false;
}
if($type != "jpg" && $type != "png" && $type != "jpeg" && $type != "gif" ) {
    $upload = false;
}
if (!$upload) {
} else {
    if (move_uploaded_file($_FILES["uploaded_image"]["tmp_name"], $target_file)) {
        header("location: profile.php",  true,  301 );  exit;
    } else {
        //Upload failed
    }
}
?>
<?php
$user_pic_path = "../blogimg/profile/".$_POST["uemail"];

echo pathinfo($_FILES["upic"]["name"],PATHINFO_EXTENSION); 


$valid_type = array("jpg","jpeg");

if ($_FILES["upic"]["size"]>1073741824){die( "Profile pic size exceeds limit 1mb");}
if(!in_array(pathinfo($_FILES["upic"]["name"],PATHINFO_EXTENSION),$valid_type)){die( "invalid file format");}

if(!is_dir($user_pic_path)){mkdir($user_pic_path);}

$conn = new mysqli("localhost","root","root","blogdb");
if($conn->connect_error){die("Connect error");}


$str="
    insert into blog_users
    values(\"".$_POST["uname"]."\",\"".$_POST["upassword"]."\",\"".$_POST["uemail"]."\",\"profile_pic.".pathinfo($_FILES["upic"]["name"],PATHINFO_EXTENSION)."\",0)
";

if($conn->query($str)){echo "user created";}
else{echo "error creating user";}

if(move_uploaded_file($_FILES["upic"]["tmp_name"],$user_pic_path."/profile_pic.".pathinfo($_FILES["upic"]["name"],PATHINFO_EXTENSION))){    echo "profile pic uploaded";  }
else{  echo "profile pic uploading error"; }
$conn->close();

header("Location:../login.html");

?>
<?php
session_start();

echo pathinfo($_FILES["blog-pic"]["name"],PATHINFO_EXTENSION); 


$valid_type = array("jpg","jpeg");

if ($_FILES["blog-pic"]["size"]>1073741824){die( "Profile pic size exceeds limit 1mb");}
if(!in_array(pathinfo($_FILES["blog-pic"]["name"],PATHINFO_EXTENSION),$valid_type)){die( "invalid file format");}


$conn = new mysqli("localhost","root","root","blogdb");
if($conn->connect_error){die("Connect error");}


$getid = "Select max(blog_id) from content";
$output = $conn->query($getid);
if(!$output){header("Location:write.php");}
$id = $output->fetch_assoc()["max(blog_id)"]+1;
$blog_pic_path = "../blogimg/blog-image/".$id;
if(!is_dir($blog_pic_path)){mkdir($blog_pic_path);}

$str="
    insert into content
    values(".$id.",\"".$_SESSION["user"]."\",\"".htmlentities($_POST["blog-title"])."\",\"".htmlentities($_POST["blog-desc"])."\",\"blogpic.".pathinfo($_FILES["blog-pic"]["name"],PATHINFO_EXTENSION)."\")
";
if($conn->query($str)){echo "blog created";}
else{echo "error creating blog try again";}



if(move_uploaded_file($_FILES["blog-pic"]["tmp_name"],$blog_pic_path."/blogpic.".pathinfo($_FILES["blog-pic"]["name"],PATHINFO_EXTENSION))){echo "blog pic uploaded";}
else{  echo "blog pic uploading error"; }
$conn->close();

header("Location:../blog.php");

?>
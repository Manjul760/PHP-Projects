<?php
session_start();

$conn = new mysqli("localhost","root","root","blogdb");
if($conn->connect_error){die("Error connecting to database please try again in a while");}

if( $conn->query("Delete from content where blog_id =".$_POST["blogid"])){echo "query executed";}
else{die("error deleting data");}

$path = "../blogimg/blog-image/".$_POST["blogid"]."/blogpic.";

if(file_exists($path."jpg")){  unlink($path."jpg"); }
elseif(file_exists($path."jpeg")){   unlink($path."jpeg");  }
rmdir("../blogimg/blog-image/".$_POST["blogid"]);



header("Location:../blog.php");

?>
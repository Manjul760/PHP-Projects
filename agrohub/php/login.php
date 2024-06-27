<?php
session_start();

$conn = new mysqli("localhost","root","root","blogdb");
if($conn->connect_error){die("Connect error");}

$row = $conn->query("Select * from blog_users where useremail = '".$_POST["uemail"]."'");


if($row->num_rows!=1){die("error fetching password");}

$userdata = $row->fetch_assoc();

if($userdata["userpassword"] != $_POST["upassword"]){header("Location:../login.html"); } 
else
{
    $_SESSION["user"]=$_POST["uemail"];
    $_SESSION["username"]=$_POST["username"];
    $_SESSION["userpic"]=$userdata["userpic"];
    $_SESSION["is_admin"]=$userdata["is_admin"];
    header("Location:../blog.php");
}

$conn->close();

?>
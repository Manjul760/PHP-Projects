<?php

$password = "root";

$conn = new mysqli("localhost","root",$password);
if($conn->connect_error){die("Connect error");}

if($conn->query("create database blogdb")){echo "Database created";}
else{die("Error creating database");}

$conn = new mysqli("localhost","root",$password,"blogdb");
if($conn->connect_error){die("Connect error");}


$query = "create table blog_users( 
    username varchar(40),
    userpassword varchar(40),
    useremail varchar(40) primary key,
    userpic varchar(20),
    is_admin boolean)";
if($conn->query($query)){echo "User table created";}
else{die("Error creating User table");}

$query = "create table content(
    blog_id int auto_increment primary key,
    useremail varchar(40),
    blog_title varchar(40),
    blog_description varchar(800),
    blog_pic varchar(50),
    foreign key (useremail) references blog_users(useremail)
    )";
if($conn->query($query)){echo "content table created";}
else{die("Error creating content table");}

echo "kam vayo database ma jani";
$conn->close();
?>


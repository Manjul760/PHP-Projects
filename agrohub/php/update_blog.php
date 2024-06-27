<?php
session_start();
$conn = new mysqli("localhost","root","root","blogdb");
if($conn->connect_error){die("Connect error");}


$valid_type = array("jpg","jpeg");

if(isset($_FILES["blog-pic"]) && $_FILES["blog-pic"]["name"]!="")
{
    
    if ($_FILES["blog-pic"]["size"]>1073741824){die( "Profile pic size exceeds limit 1mb");}
    if(!in_array(pathinfo($_FILES["blog-pic"]["name"],PATHINFO_EXTENSION),$valid_type)){die( "invalid file format");}
    else
    {

        $blog_pic_path='../blogimg/blog-image/'.$_POST["blog-id"];

        $data=$conn->query("select blog_pic from content where blog_id =".$_POST["blog-id"]);
        $pic_name=$data->fetch_assoc()["blog_pic"];
        if(file_exists($blog_pic_path.'/'.$pic_name))
        {
            if(unlink('../blogimg/blog-image/'.$_POST["blog-id"].'/'.$pic_name)){echo "file deleted";}
            else{die("error deleting file");}
        }
        

        if(move_uploaded_file($_FILES["blog-pic"]["tmp_name"],$blog_pic_path."/blogpic.".pathinfo($_FILES["blog-pic"]["name"],PATHINFO_EXTENSION))){echo "blog pic uploaded";}
        else{  die("blog pic uploading error"); }


        $str="
        update content
        set blog_pic='"."blogpic.".pathinfo($_FILES["blog-pic"]["name"],PATHINFO_EXTENSION)."'
        where blog_id = ".$_POST["blog-id"]."
        ";
        if($conn->query($str)){echo "blog created";}
        else{echo "error creating blog try again";}
    }
    

}


$str="
update content
set blog_title = '".htmlentities($_POST["blog-title"])."',
    blog_description='".htmlentities($_POST["blog-desc"])."'
where blog_id = ".$_POST["blog-id"]."

";
if($conn->query($str)){echo "blog created";}
else{echo "error creating blog try again";}

header("Location:../blog.php");





?>
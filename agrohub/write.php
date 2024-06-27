<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="./img/favicon.jpg" type="image/x-icon" />
    <link rel="stylesheet" href="css/style.css" />
    <title>Agrohub</title>
  </head>
  <body>
    <nav class="navbar">
        <a href="blog.php"><button class="login-btn">Go back</button></a>
    </nav>
    <main class="write-maindiv">
        <h1>Write your blogpost.</h1>
        <form <?php if($_SERVER["REQUEST_METHOD"]=="POST"){echo 'action="php/update_blog.php"';}else{echo'action="php/create_blog.php"';}?> method="POST" enctype="multipart/form-data" class="write-form">
            <?php
                if($_SERVER["REQUEST_METHOD"]=="POST")
                {
                    echo '
                    <input type="hidden" name="blog-id" value="'.$_POST["blogid"].'">';
                    $conn = new mysqli("localhost","root","root","blogdb");
                    if($conn->connect_error){die("Connect error");}

                    $data = $conn->query("select * from content where blog_id=".$_POST["blogid"]);
                    $blogdata = $data->fetch_assoc();

                    echo '
                    <div>
                        <label for="title">Title</label>
                        <input type="text" id="title" name="blog-title" value="'.$blogdata["blog_title"].'" required class="blog-input">
                    </div>
                    <div>
                        <label for="desc">Description</label>
                        <textarea name="blog-desc" id="desc" cols="20" rows="5" required class="blog-textarea">'.$blogdata["blog_description"].'</textarea>
                    </div>
                    <div>
                        <label for="write-pic">Image</label>
                        <input type="file" id="write-pic" name="blog-pic">
                    </div>
                    
                    ';
                    //under progress
                    
                    $conn->close();
                }
                else
                {
                    echo '
                    <div>
                        <label for="title">Title</label>
                        <input type="text" id="title" name="blog-title" required class="blog-input">
                    </div>
                    <div>
                        <label for="desc">Description</label>
                        <textarea name="blog-desc" id="desc" cols="20" rows="5" required class="blog-textarea"></textarea>
                    </div>
                    <div>
                        <label for="write-pic">Image</label>
                        <input type="file" id="write-pic" name="blog-pic" required>
                    </div>
                    ';
                }
            ?>
            
            <input type="submit" value="Submit" class="login-btn">
        </form>
    </main>
  </body>
</html>

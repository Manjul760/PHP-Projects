<?php
  session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="shortcut icon" href="./img/favicon1.jpg" type="image/x-icon" />
  <link rel="stylesheet" href="css/style.css" />
  <title>Agrohub</title>
</head>

<body>
  <nav class="navbar">
    <a href="/">
      <img src="./img/logo.JPG" alt="agrohub" />
    </a>
    <div class="navbar-items">
      <ul>
        <?php
          if(!isset($_SESSION["user"]))
          {
            echo '
            <li>
              <a
                href="/"
                class="link-text"
                >Home
              </a>
            </li>
            <li>
              <a
                href="blog.html"
                class="active link-text"
                >Blog
              </a>
            </li>
            '; 
          }
        ?>
      </ul>

      <?php
          if(!isset($_SESSION["user"]))
          {
            echo '<a href="login.html"><button class="login-btn">Login</button></a>'; 
          }
          else
          {
            echo '<a href="write.php"><button class="login-btn write-btn">Write</button></a>';
            echo '<img src="blogimg/profile/'.$_SESSION['user'].'/'.$_SESSION['userpic'].'" alt="profile pic">';
            echo '<a href="php/logout.php"><button class="login-btn">Logout</button></a>';
          }
        ?>

    </div>
  </nav>

  <main class="blog-maindiv">
    <?php
      try{
        $conn = new mysqli("localhost","root","root","blogdb");
      }
      catch(Exception $e){
        die("error database where?");
      }
      
      if($conn->connect_error){die("Error connecting to database please try again in a while");}
      $blogs = $conn->query("
        Select username,blog_title,blog_description,useremail,userpic,blog_id,blog_pic from content natural join blog_users 
        order by blog_id desc;");
      if($blogs->num_rows>0)
      {
        while($blog = $blogs->fetch_assoc())
        {
          echo'
          <div class="blog-contentdiv">
          <img src="./blogimg/blog-image/'.$blog["blog_id"].'/'.$blog["blog_pic"].'" alt="blogpost image" class="blog-contentdiv-img">
            <div class="blogpost">
              <h1 class="blog-title">'.html_entity_decode($blog["blog_title"]).'</h1>
              <div class="user-info">
                <img src="./blogimg/profile/'.htmlentities($blog["useremail"]).'/'.htmlentities($blog["userpic"]).'" alt="blog image" class="user-info-img">
                <p class="blog-uname">'.htmlentities($blog["username"]).'</p>';
                if(isset($_SESSION["user"]) && ($_SESSION["user"]==$blog["useremail"]||$_SESSION["is_admin"]))
                {
                  echo'
                  <form action="write.php" method="POST">
                    <input type="hidden" name="blogid" value="'.$blog["blog_id"].'">
                    <button type="submit" style="background:inherit;border:none;cursor:pointer;">
                      <a><img src="./img/edit.png" alt="edit" class="edit-info-img"></a>
                    </button>
                  </form>

                  <form action="php/delete_blog.php" method="POST">
                    <input type="hidden" name="blogid" value="'.$blog["blog_id"].'">
                    <button type="submit" style="background:inherit;border:none;cursor:pointer;">
                      <a><img src="./img/delete.png" alt="delete" class="edit-info-img"></a>
                    </button>
                  </form>
                  
                  
                  ';
                }
                

              echo '</div>
              <div class="blog-desc" id="blog-desc">
                <p>'.html_entity_decode($blog["blog_description"]).'</p>
              </div>
            </div>
            
          </div>
          ';
        }
        $conn->close();
      }
      else{echo "data fetching error";}
    ?>
    <!-- <div class="blog-contentdiv">
      <div class="blogpost">
        <h1 class="blog-title">Lorem ipsum dolor sit amet.</h1>
        <div class="user-info">
          <img src="./blogimg/profile/boy1.jpg" alt="blog image" class="user-info-img">
          <p class="blog-uname">Ram Thapa</p>
          <a href="write.php"><img src="./img/edit.png" alt="edit" class="edit-info-img"></a>
          <a href="write.php"><img src="./img/delete.png" alt="delete" class="edit-info-img"></a>
        </div>
        <div class="blog-desc">
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Laborum adipisci, dolores officiis incidunt nulla
            quibusdam porro est enim assumenda aliquam provident eius suscipit ex quod, accusamus nam recusandae officia
            quo a deserunt, veritatis tempora ab repudiandae dolorum. Odio officiis voluptatibus quae esse at quaerat
            maxime?</p>
        </div>
      </div>
      <img src="./blogimg/blog-image/blog-image1.jpg" alt="blogpost image" class="blog-contentdiv-img">
    </div>

    <div class="blog-contentdiv">
      <div class="blogpost">
        <h1 class="blog-title">Lorem ipsum dolor sit amet.</h1>
        <div class="user-info">
          <img src="./blogimg/profile/boy1.jpg" alt="blog image" class="user-info-img">
          <p class="blog-uname">Ram Thapa</p>
          <a href="write.php"><img src="./img/edit.png" alt="edit" class="edit-info-img"></a>
        </div>
        <div class="blog-desc">
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Laborum adipisci, dolores officiis incidunt nulla
            quibusdam porro est enim assumenda aliquam provident eius suscipit ex quod, accusamus nam recusandae officia
            quo a deserunt, veritatis tempora ab repudiandae dolorum. Odio officiis voluptatibus quae esse at quaerat
            maxime?</p>
        </div>
      </div>
      <img src="./blogimg/blog-image/blog-image1.jpg" alt="blogpost image" class="blog-contentdiv-img">
    </div> -->

  </main>

  <footer class="footerdiv">
    <p>Want to collab. Contact me 👇</p>
    <div class="social-icons">
      <a href="https://github.com/gcrajan" target="_blank">
        <img src="./img/github.png" alt="github" class="skills-box1" />
      </a>
      <a href="https://www.linkedin.com/in/rajan-g-c-69a690199/" target="_blank">
        <img src="./img/linekdin.png" alt="linkedin" class="skills-box2" />
      </a>
      <a href="https://twitter.com/iamgcrajan" target="_blank">
        <img src="./img/twitter.png" alt="twitter" class="skills-box1" />
      </a>
    </div>
    <h1>Copyright © 2023|| <a href="https://gcrajan.com.np/" target="_blank">Rajan GC</a> , <a href="https://manjul760.github.io/" target="_blank">Manjul Sharma</a></h1>
  </footer>
</body>

</html>
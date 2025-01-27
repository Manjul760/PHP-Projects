<?php
session_start();

if(isset($_SESSION["user"]))
{
    header("Location:blog.php");
}

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
          <li>
            <a
              href="/"
              class="active link-text"
              >Home
            </a>
          </li>
          <li>
            <a
              href="blog.php"
              class="link-text"
              >Blog
            </a>
          </li>
        </ul>
        <a href="login.html"><button class="login-btn">Login</button></a>
      </div>
    </nav>
    <main class="maindiv">
      <div class="content">
        <h1>Welcome</h1>
        <p>
          Lorem ipsum dolor sit amet consectetur, adipisicing elit. Recusandae
          esse enim similique nesciunt, voluptates consectetur est!
        </p>
        <span>Let's create your blogpost.</span>
      </div>
      <div class="side-img">
        <img src="./img/bg.png" alt="group discussion image" />
      </div>
    </main>
    <footer class="footerdiv">
      <p>Want to collab. Contact me 👇</p>
      <div class="social-icons">
        <a href="https://github.com/gcrajan" target="_blank">
          <img src="./img/github.png" alt="github" class="skills-box1" />
        </a>
        <a
          href="https://www.linkedin.com/in/rajan-g-c-69a690199/"
          target="_blank"
        >
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

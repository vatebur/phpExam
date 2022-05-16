<?php 
  session_start();
  require '../resources/view/header.php';

?>

  <h1>php考试</h1>
 
<!--
 检测用户是否登录，已登录跳转到考试界面
没登陆跳转到登录界面
   -->   

  <?php if(isset($_SESSION["authenticated"])) { 
     $host = $_SERVER["HTTP_HOST"];
  $path = rtrim(dirname($_SERVER["PHP_SELF"]), "/\\");
   header("Location: http://$host$path/exam/index.php");
   ?>

   
  <?php } else { 
 // <h2>请登录用户！</h2>
  //<ul>
    //<li><a href="login.php">用户登陆</a></li>
//    <li><a href="register.php">用户注册</a></li>
 // </ul>
    $host = $_SERVER["HTTP_HOST"];
  $path = rtrim(dirname($_SERVER["PHP_SELF"]), "/\\");
    header("Location: http://$host$path/login/login.php");
    
  } ?>
  
<?php
  require '../resources/view/footer.php'; 

?>

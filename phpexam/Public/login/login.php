<?php
// enable sessions
  session_start();
  error_reporting(E_ALL ^ E_DEPRECATED);
  $prompt = " ";

  // if username and password were submitted, check them
  if (isset($_POST["user"]) && isset($_POST["pass"]))
  {

      // connect to database
      if (($connection = mysql_connect("localhost", "phpexam", "123456")) === false)
          die("Could not connect to database");

      // select database
      if (mysql_select_db("tzfx", $connection) === false)
          die("Could not select database");

      // prepare SQL
      $sql = sprintf("SELECT 1 FROM users WHERE user='%s' AND pass=AES_ENCRYPT('%s', '%s')",
                     mysql_real_escape_string($_POST["user"]),
                     mysql_real_escape_string($_POST["pass"]),
                     mysql_real_escape_string($_POST["pass"]));

      // execute query
      $result = mysql_query($sql);
      if ($result === false)
          die("Could not query database");

      // check whether we found a row
      if (mysql_num_rows($result) == 1) {
          // remember that user's logged in
          $_SESSION["authenticated"] = true;
          $_SESSION["user"] = $_POST["user"];

          // redirect user to home page, using absolute path, per
          // http://us2.php.net/manual/en/function.header.php
          $host = $_SERVER["HTTP_HOST"];
          $path = rtrim(dirname($_SERVER["PHP_SELF"]), "/\\");
         // header("Location: http://$host$path/index.php");
             header("Location: http://$host/exam/index.php");
         
          exit;
      } else {
        $prompt =  "用户名或密码错误！！";
      }
  }  

  require '../../resources/view/header.php';

?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css">
    <title>登录界面</title>
</head>

<body>
    <div class="box">
        <div class="left"></div>
        <div class="right">
            <h4>登 录</h4>
            <form action="<?php  print($_SERVER["PHP_SELF"]) ?>" method="post">
                <input class="acc" name="user" type="text" placeholder="用户名">
                <input class="acc" name="pass" type="password" placeholder="密码">
                <input class="submit" type="submit" value="登录">
            <?php print($prompt) ?>
            </form>
            <div class="fn">
                <a href="register.php">注册账号</a>
                <a href="register.php">注册账号</a>
                
            </div>
        </div>
    </div>


</body>


  <?php
  require '../../resources/view/footer.php';
?>

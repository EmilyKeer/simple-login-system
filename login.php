<?php
  error_reporting(0); //turn off all error
   //error_reporting (E_ALL ^ E_NOTICE);
   //error_reporting(E_ALL ^ E_DEPRECATED);
   session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Keer's Try</title>
</head>

<body background = "intro-bg.jpg">
<?php
$form = "<form action='./login.php' method='post'>
<table>
<tr>
  <td>Username:</td>
  <td><input type='text' name='user' /></td>
</tr>
<tr>
  <td>Password:</td>
  <td><input type='password' name='password' /></td>
</tr>
<tr>
  <td>Hello Click</td>
  <td><input type='submit' name='loginbtn' value='I love Keer' /></td>
</tr>
</table>
</form>";

if ($_POST['loginbtn'])
{
  $user = $_POST['user'];
  $password = $_POST['password'];

  if ($user)
  {
    if ($password)
    {
      require ("connect.php");

      $password = md5(md5("keer".$password."tim"));

      $query = mysql_query("SELECT * FROM members Where username='$user'") or die(mysql_error());
      $numrows = mysql_num_rows($query);
      if ($numrows == 1)
      {
        $row = mysql_fetch_assoc($query);
        $dbid = $row['id'];
        $dbuser = $row['username'];
        $dbpass = $row['password'];
        $dbactive = $row['active'];

        if ($password == $dbpass)
        {
          if ($dbactive == 1)
          {
            $_SESSION['userid'] = $dbid;
            $_SESSION['username'] = $dbuser;

            echo "Logged in as <b>$dbuser</b> <a href='http://keerliu.com'>welcome</a> $form";
          }
          else echo "Activate first! $form";
        }
        else echo "Password Incorrect $form";
      }
      else echo "Username not found  $form";

      mysql_close();

    }
    else echo "You must enter your username. $form";
  }
  else echo "You must enter your username. $form";
}
else echo $form;

?>


</body>
</html>

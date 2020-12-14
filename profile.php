<!----------------start database connection----------->
<?php
$db_host="localhost";
$db_user="root";
$db_pass="";
$db_name="project 2";
$conn=mysqli_connect($db_host,$db_user,$db_pass,$db_name);
if(!$conn)
{
die("connection failed");
}
?>
<!----------------End database connection-------------->
<!----------------start php code-------------------------->
<?php
session_start();
if(isset($_SESSION['islogin']))
{
echo $_SESSION['rName'];
}
if(isset($_SESSION['islogin']))
{
echo $_SESSION['rEmail'];
}
else
{
echo '<script>location.href="login.php"</script>';
}
?>
<!------------------End php code--------------------------->
<!---------------start html code----------------------------->
<!doctype html>
<html>
<head>
<title>Profile.com</title>
</head>
<body>
<a href="logout.php">Logout</a>
<a href="changepassword.php">ChangePassword</a>
</body>
</html>
<!-------------------End html code----------------------------->
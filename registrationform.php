<!-------------start php code for database connection--------------------->
<?php
$my_host="localhost";
$my_user="root";
$my_pass="";
$my_name="project 2";
$conn=mysqli_connect($my_host,$my_user,$my_pass,$my_name);
if(!$conn)
{
die("Connection falied");
}
else
{
echo "Connected";
}
?>
<!-----------------End php code for database connection------------------>
<!--------------start php code for insert data--------------------------->
<?php
if(isset($_REQUEST['rReg']))
{
if(($_REQUEST['rName']=="")||($_REQUEST['rEmail']=="")||($_REQUEST['rPhno']=="")||($_REQUEST['rAltphno']=="")||($_REQUEST['rAddress']=="")||empty($_REQUEST['rGender'])||($_REQUEST['rPass']=="")||($_REQUEST['rConPass']==""))
{
$msg='<div class="alert alert-warning mt-3 text-center">Please fill all the fields</div>';
}
else
{
$rName=$_REQUEST['rName'];
$rEmail=$_REQUEST['rEmail'];
$rPhno=$_REQUEST['rPhno'];
$rAltphno=$_REQUEST['rAltphno'];
$rAddress=$_REQUEST['rAddress'];
$rGender=$_REQUEST['rGender'];
$rPass=$_REQUEST['rPass'];
$rConPass=$_REQUEST['rConPass'];
$sql="SELECT rEmail FROM laundry WHERE rEmail='".$rEmail."'";
$result=mysqli_query($conn,$sql);
if(mysqli_num_rows($result)==1)
{
$msg='<div class="alert alert-warning mt-3 text center">Email already registered</div>';
}
else
{
if($rPass==$rConPass)
{
$sql="INSERT INTO laundry(rName,rEmail,rPhno,rAltphno,rAddress,rGender,rPass,rConPass)VALUES('$rName','$rEmail','$rPhno','$rAltphno','$rAddress','$rGender','$rPass','$rConPass')";
if(mysqli_query($conn,$sql))
{
$msg='<div class="alert alert-secondary mt-3 text center">Data inserted successfully</div>';
}
}
else
{
$msg='<div class="alert alert-warning mt-3 text center">Password and confirm password must be same</div>';
}
}
}
}
?>
<!-------------End php code for inset data--------------------->
<!-------------------start registration form------------------->
<!doctype html>
<html lang="en">
<head>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

<title>Hello, world!</title>
</head>
<body>
<div class="container mt-5">
<div class="row">
<div class="col-sm-4">

<?php
if(isset($_REQUEST['Edit']))
{
$Srno=$_REQUEST['Srno'];
$sql="SELECT *FROM laundry WHERE Srno='".$Srno."'";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);
}
?>

<form action="" method="POST" class="shadow-lg p-5">
<h4>Welcome to Registration page</h4>

<div class="form-group">
<label for="Name">Name</label>
<input type="text" placeholder="Type your name here" name="rName" class="form-control"
value="<?php if(isset($row['rName'])) {echo $row['rName'];}?>">
</div>

<div class="form-group">
<label for="Email">Email</label>
<input type="text" placeholder="Type your email here" name="rEmail" class="form-control"
value="<?php if(isset($row['rEmail'])) {echo $row['rEmail'];}?>">
</div>

<div class="form-group">
<label for="PhoneNumber">Phone Number</label>
<input type="text" placeholder="Type your phone number here" name="rPhno" class="form-control"
value="<?php if(isset($row['rPhno'])) {echo $row['rPhno'];}?>">
</div>

<div class="form-group">
<label for="Alternative Phone number">Alternativ Phone number</label>
<input type="text" placeholder="Type your alt.ph.no. here" name="rAltphno" class="form-control"
value="<?php if(isset($row['rAltphno'])) {echo $row['rAltphno'];}?>">
</div>

<div class="form-group">
<label for="Address">Address</label>
<input type="text" placeholder="Type your Address here" name="rAddress" class="form-control"
value="<?php if(isset($row['rAddress'])) {echo $row['rAddress'];}?>">
</div>

<div class="form-group">
<label for="Gender">Gender</label>
Male<input type="radio" name="rGender" value="Male" class="form-inline"
<?php if(isset($row['rGender']) && $row['rGender']=="Male") {echo "checked";}?>>

Female<input type="radio" name="rGender" value="Female" class="form-inline"
<?php if(isset($row['rGender']) && $row['rGender']=="Female") {echo "checked";}?>>

Others<input type="radio" name="rGender" value="Others" class="form-inline"
<?php if(isset($row['rGender']) && $row['rGender']=="Others") {echo "checked";}?>>

</div>

<div class="form-group">
<label for="Password">Password</label>
<input type="password" placeholder="Type your password here" name="rPass" class="form-control"
value="<?php if(isset($row['rPass'])) {echo $row['rPass'];}?>">
</div>

<div class="form-group">
<label for="Confirm Password">Confirm Password</label>
<input type="password" placeholder="Confirm your password here" name="rConPass" class="form-control"
value="<?php if(isset($row['rConPass'])) {echo $row['rConPass'];}?>">
</div>

<input type="submit" value="Register" name="rReg" class="btn btn-info">
<input type="hidden" name="Srno" value="<?php if(isset($row['Srno'])) {echo $row['Srno'];}?>">
<input type="submit" value="Update" name="Update" class="btn btn-info">
<?php if(isset($msg)) {echo $msg;}?>

</form>
<a href="login.php">Login</a>
</div>
</div>
</div>

<!-- Optional JavaScript; choose one of the two! -->

<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

<!-- Option 2: Separate Popper and Bootstrap JS -->
<!--
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
-->
</body>
</html>
<!------------------End registration form------------------------------------>
<!------------------start php code for fetch data---------------------------->
<?php
$sql="SELECT *FROM laundry";
$result=mysqli_query($conn,$sql);
if(mysqli_num_rows($result)>0)
{
echo '<table border="3">';
echo "<tr>";
echo "<thead>";
echo "<th>Name</th>";
echo "<th>Email</th>";
echo "<th>Phno</th>";
echo "<th>Altphno</th>";
echo "<th>Add</th>";
echo "<th>Gen</th>";
echo "<th>Pass</th>";
echo "<th>conpass</th>";
echo "<th>Delete</th>";
echo "<th>Edit</th>";
echo "</thead>";
echo "</tr>";
echo "<tbody>";
while($row=mysqli_fetch_assoc($result))
{
echo "<tr>";
echo "<td>".$row['rName']."</td>";
echo "<td>".$row['rEmail']."</td>";
echo "<td>".$row['rPhno']."</td>";
echo "<td>".$row['rAltphno']."</td>";
echo "<td>".$row['rAddress']."</td>";
echo "<td>".$row['rGender']."</td>";
echo "<td>".$row['rPass']."</td>";
echo "<td>".$row['rConPass']."</td>";
echo '<td><form action="" method="POST">
<input type="hidden" name="Srno" value='.$row['Srno'].'>
<input type="submit" value="Delete" name="Delete">
</form></td>';

echo '<td><form action="" method="POST">
<input type="hidden" name="Srno" value='.$row['Srno'].'>
<input type="submit" value="Edit" name="Edit">
</form></td>';   

echo "</tr>";
}
echo "</tbody>";
echo "</table>";
}
else
{
echo "Data not found";
}
?>
<!------------------End php code for fetch data------------------------------>
<!------------------start php code for delete data--------------------------->
<?php
if(isset($_REQUEST['Delete']))
{
$Srno=$_REQUEST['Srno'];
$sql="DELETE FROM laundry WHERE Srno='".$Srno."'";
if(mysqli_query($conn,$sql))
{
echo "Data deleated successfully";
}
else
{
echo "Unable to delete data";
}
}
?>
<!------------------End php code for delete data--------------------------------->
<!------------------start php code for update button----------------------------->
<?php
if(isset($_REQUEST['Update']))
{
if(($_REQUEST['rName']=="")||($_REQUEST['rEmail']=="")||($_REQUEST['rPhno']=="")||($_REQUEST['rAltphno']=="")||($_REQUEST['rAddress']=="")||empty($_REQUEST['rGender'])||($_REQUEST['rPass']=="")||($_REQUEST['rConPass']==""))
{
$msg='<div class="alert alert-warning mt-3 text-center">Please fill all the fields</div>';
}
else
{
$Srno=$_REQUEST['Srno'];
$rName=$_REQUEST['rName'];
$rEmail=$_REQUEST['rEmail'];
$rPhno=$_REQUEST['rPhno'];
$rAltphno=$_REQUEST['rAltphno'];
$rAddress=$_REQUEST['rAddress'];
$rGender=$_REQUEST['rGender'];
$rPass=$_REQUEST['rPass'];
$rConPass=$_REQUEST['rConPass'];
$sql="UPDATE laundry SET rName='$rName',rEmail='$rEmail',rPhno='$rPhno',rAltphno='$rAltphno',rAddress='$rAddress',rGender='$rGender',rPass='$rPass',rConPass='$rConPass' WHERE Srno='".$Srno."'";
if(mysqli_query($conn,$sql))
{
echo "Data updated successfully";
}
else
{
echo "Unable to update data";
}
}
}
?>
<!------------------End php code for update button------------------------------->
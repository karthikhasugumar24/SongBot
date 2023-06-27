<html>
<head>
	<img src="" alt="">
	<style>
		body{
			background-image: url("Successbg.jpg");
			background-repeat: no-repeat;
			background-size: cover;
		}
		body{
			text-align: center;
			font-size:50px;
			font-family:Times New Roman;
			color:#FBD5AB;
			text-transform:capitalize;
			padding:20%;
			border: soild 15px #e74c3c;
		}
		
	</style>
</head>

<body>
<?php

$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email  = $_POST['email'];
$uname = $_POST['uname'];
$pass = $_POST['pass'];
$cpass = $_POST['cpass'];

if (!empty($fname) || !empty($lname) || !empty($email) || !empty($uname) || !empty($pass) || !empty($cpass) )
{

$host = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "chatbot";



// Create connection
$conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);

if (mysqli_connect_error()){
  die('Connect Error ('. mysqli_connect_errno() .') '
    . mysqli_connect_error());
}
else{
  $SELECT = "SELECT email From register Where email = ? Limit 1";
  $INSERT = "INSERT Into register (fname , lname ,email , uname, pass, cpass )values(?,?,?,?,?,?)";

//Prepare statement
     $stmt = $conn->prepare($SELECT);
     $stmt->bind_param("s", $email);
     $stmt->execute();
     $stmt->bind_result($email);
     $stmt->store_result();
     $rnum = $stmt->num_rows;

     //checking username
      if ($rnum==0) {
      $stmt->close();
      $stmt = $conn->prepare($INSERT);
      $stmt->bind_param("ssssss", $fname,$lname,$email,$uname,$pass,$cpass);
      $stmt->execute();
      echo "Rock on! You're now a part of the musical revolution.",'<a href="htmlpage.html" style="color:#CFECEC;"><br>Click Here To Login</a>';
     } else {
      echo "Try registering with another email!";
     }
     $stmt->close();
     $conn->close();
    }
} else {
 echo "All field are required";
 die();
}
?>

</body>
</html>
<?PHP
$servername = "mysql:host=localhost;dbname=Online_Quiz";
$username = "root";
$password = "";

// Create connection
$conn = new PDO($servername, $username, $password);

// Check connection


if ($_POST['username'] != null) {
  $user_email = trim($_POST['username']);
  $user_password = trim($_POST['password']);
  $userType = trim($_POST['userType']);
  $sql = "SELECT uid, user, pass, email,UserType FROM users WHERE email='$user_email' and pass='$user_password' and UserType in ($userType,-1) and inConfirm in (1,-1)";
  $user = $conn -> query($sql);
  if ( $user->rowCount() ){
    $row =$user->fetchObject();
      session_start();
      $_SESSION['userID'] = $row->uid;
  $_SESSION['userTypeID'] = $row->UserType;
      echo('ok') ;
  }
  else{
     echo('warning');
  }

  /*$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
  $row = mysqli_fetch_assoc($resultset);
  if($row!=null){
  echo "ok";
  $_SESSION['user_session'] = $row['uid'];
  } else {
  echo "email or password does not exist."; // wrong details
}*/
}


?>

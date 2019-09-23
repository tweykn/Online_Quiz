<?PHP
$servername = "mysql:host=localhost;dbname=Online_Quiz";
$username = "root";
$password = "";

// Create connection
$conn = new PDO($servername, $username, $password);
// Check connection


if ($_POST['username'] != null) {
  $user_name = trim($_POST['username']);
  $user_password = trim($_POST['Password']);
  $user_email = trim($_POST['email']);
  $userType = $_POST['userType'];

  $query = $conn->prepare("INSERT INTO users SET user = ?, pass = ?, email = ?, UserType = ?, inConfirm = ?");
  $insert  =  $query -> execute(array(
       "$user_name","$user_password","$user_email","$userType",0
  ));
    if ( $insert ){
      $last_id = $conn->lastInsertId();

      echo('ok') ;
  }
  else{
     echo('warning');
  }

}


?>

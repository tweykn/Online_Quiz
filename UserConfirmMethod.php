<?PHP
$servername = "mysql:host=localhost;dbname=Online_Quiz";
$username = "root";
$password = "";

// Create connection
$conn = new PDO($servername, $username, $password);
// Check connection


if ($_POST['id'] != null) {
  $id = trim($_POST['id']);

  $query = $conn->prepare("UPDATE users SET
  inConfirm = :confirm
  WHERE uid = :id");
  $update = $query->execute(array(
       "confirm" => 1,
       "id" => $id
  ));
  if ( $update ){
       echo('ok') ;
  }
else {
  echo('Try') ;
}

  }
  else{
     echo('warning');
  }




?>

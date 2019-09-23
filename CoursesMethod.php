<?PHP
    session_start();
$servername = "mysql:host=localhost;dbname=Online_Quiz";
$username = "root";
$password = "";

// Create connection
$conn = new PDO($servername, $username, $password);
// Check connection


if ($_POST['SelectLesson'] != null) {
  $SelectLesson = trim($_POST['SelectLesson']);

  $query = $conn->prepare("INSERT INTO Confirmation SET StudentID = ?, LectureID = ?, inConfirm = ?, inReply = ?");
  $insert  =  $query -> execute(array(
       $_SESSION['userID'],$SelectLesson,0,0
  ));
    if ( $insert ){
       echo('Ok') ;
  }
else {
  echo('Try') ;
}

  }
  else{
     echo('warning');
  }




?>

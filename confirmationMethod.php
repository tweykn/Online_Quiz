<?PHP
$servername = "mysql:host=localhost;dbname=Online_Quiz";
$username = "root";
$password = "";

// Create connection
$conn = new PDO($servername, $username, $password);
session_start();
// Check connection
if (isset($_SESSION['userID'])) {
  $Type = trim($_POST['$Type']);
  $LectureID = trim($_POST['$LectureID']);
  $studentID = trim($_POST['$studentID']);

if ($Type == "CDELETE") {
  $delete =  $conn->exec("DELETE FROM Confirmation WHERE StudentID = $studentID and LectureID = $LectureID");
  if ( $delete ){
echo('ok') ;
       }
  else{
     echo('warning');
  }
}
else if ($Type == "CONFIRM") {
  $query = $conn->prepare("UPDATE Confirmation SET
  inConfirm = :confirm
  WHERE StudentID = :sid and LectureID = :lid");
  $update = $query->execute(array(
       "confirm" => 1,
       "sid" => $studentID,
       "lid" => $LectureID
  ));

  if ( $update ){
echo('ok') ;
       }
  else{
     echo('warning');
  }
}




}
else {
  echo('Session');
}


?>

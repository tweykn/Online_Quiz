<?PHP
$servername = "mysql:host=localhost;dbname=Online_Quiz";
$username = "root";
$password = "";

// Create connection
$conn = new PDO($servername, $username, $password);
session_start();
// Check connection
if (isset($_SESSION['userID'])) {

$questionImage = null;
if (isset($_POST['$questionImg'])) {
$questionImage = $_POST['$questionImg'];
}

  $questionName = trim($_POST['$questionName']);
  $questionOption1 = trim($_POST['$questionOption1']);
  $questionOption2 = trim($_POST['$questionOption2']);
  $questionOption3 = trim($_POST['$questionOption3']);
  $questionOption4 = trim($_POST['$questionOption4']);
  $questionOption5 = trim($_POST['$questionOption5']);
  $questionType = trim($_POST['$questionType']);
  $LessonID = trim($_POST['$LessonID']);
  $TrueOption = trim($_POST['$TrueOption']);
  $TopicID = trim($_POST['$TopicID']);


$query = $conn->prepare("INSERT INTO Questions SET LectureId = ?, Question = ?, Option1 = ?, Option2 = ? , Option3 = ?, Option4 = ?, Option5 = ? , Type = ? , CreatedBy = ?, TrueOption = ?, inTopicID = ? ");
$insert  =  $query -> execute(array(
     $LessonID,"$questionName","$questionOption1","$questionOption2","$questionOption3","$questionOption4","$questionOption5",$questionType,$_SESSION['userID'],"$TrueOption" , $TopicID
));
  if ( $insert ){
    $last_id = $conn->lastInsertId();
    if ($questionImage != null) {
    foreach ($questionImage as $value) {
      $queryimg = $conn->prepare("INSERT INTO ImgQuestions SET QuestionsID = ?, stImgName = ?");
      $insertimg  =  $queryimg -> execute(array(
        $last_id , $value
      ));
    }
  }


echo('ok') ;
       }

  else{
     echo('warning');
  }


}
else {
  echo('Session');
}


?>

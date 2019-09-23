<?PHP
$servername = "mysql:host=localhost;dbname=Online_Quiz";
$username = "root";
$password = "";
$Type = trim($_POST['$Type']);

// Create connection
$conn = new PDO($servername, $username, $password);
session_start();
// Check connection
if (isset($_SESSION['userID'])) {

  $sql = "SELECT * FROM CreateQuiz WHERE ExamID=$Type";
  $QuizList = $conn -> query($sql);
  $QuizLists =$QuizList->fetchAll();
$arrayList = array ();
  foreach($QuizLists as $row){
$sqlquestion = "SELECT ID,Option1,Option2,Option3,Option4,Option5,Question,Type,inTopicID FROM Questions WHERE ID={$row['QuestionsID']}";
$QuestionL = $conn -> query($sqlquestion);
$Question =$QuestionL->fetchObject();

  array_push($arrayList, $Question);
  }
  echo json_encode($arrayList);
}
else {
  echo('Session');
}


?>

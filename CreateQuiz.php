<?PHP
$servername = "mysql:host=localhost;dbname=Online_Quiz";
$username = "root";
$password = "";

// Create connection
$conn = new PDO($servername, $username, $password);

$IDList = array();

$QuestionsCount = trim($_POST['$QuestionsCount']);
$StartDate = trim($_POST['$StartDate']);
$EndDate = trim($_POST['$EndDate']);
$TypeID = trim($_POST['$TypeID']);
$TopicID = trim($_POST['$TopicID']);
session_start();

if (isset($_SESSION['userID'])) {
$userItem = $_SESSION['userID'];

$sql = "SELECT * FROM CreateQuiz WHERE ExamID=$TypeID and inTopicID = $TopicID";

foreach ($conn -> query($sql) as $value) {
  $ValID = $value['ID'];
  $conn->exec("DELETE FROM CreateQuiz WHERE ID=$ValID");
}

$randCopy = 0;
for ($i=0; $i < $QuestionsCount; $i++) {
  $RandVal = rand(0,2);

  while( $randCopy == $RandVal ) {
         $RandVal = rand(0,2);
         echo $RandVal;
    }

$IDListCount = count($IDList);
if ($IDListCount == 0) {
  $sql = "SELECT * FROM Questions WHERE Type='$RandVal' and inTopicID = $TopicID";
  $questionItem = $conn -> query($sql);
  $row =$questionItem->fetchObject();
}
else {

$sqlidlistquery = implode(", ", $IDList);
  $sql = "SELECT * FROM Questions WHERE NOT ID in ($sqlidlistquery) and Type='$RandVal' and inTopicID = $TopicID";
  $questionItem = $conn -> query($sql);
  $row =$questionItem->fetchObject();
}


if ($row) {
$query = $conn->prepare("INSERT INTO CreateQuiz SET ExamID = ?, QuestionsID = ?, UserID = ? , StartDate = ?, EndDate = ?, inTopicID = ?");
$insert  =  $query -> execute(array(
     $TypeID,$row->ID,$_SESSION['userID'],$StartDate,$EndDate,$row->inTopicID
));
array_push($IDList, $row->ID);

$randCopy = $RandVal;
}
else {
  echo 'There is no enough question';
}
}
$query = $conn->prepare("UPDATE confirmation SET
inReply = :reply
WHERE StudentID = :studentid
and LectureID = :lectureid");
$update = $query->execute(array(
    "reply" => 0,
    "lectureid" => $TypeID,
    "studentid" => $_SESSION['userID']
));
echo 'ok';
}
else {
  echo 'Session';
}

?>

<?php
$servername = "mysql:host=localhost;dbname=Online_Quiz";
$username = "root";
$password = "";

// Create connection
$conn = new PDO($servername, $username, $password);
session_start();
// Check connection
if (isset($_SESSION['userID'])) {
    $postList = $_POST['$postList'];
    $LectureID = 0;
    foreach ($postList as $val) {
        $LectureID = $val["lecture"];
        $query = $conn->prepare("INSERT INTO studentreply SET inLectureID = ?, inQuestionID = ?, inUserID = ?, stReply = ?");
        $insert  =  $query -> execute(array(
            $val["lecture"],$val["question"],$_SESSION['userID'],$val["reply"]
        ));
    }

    $query = $conn->prepare("UPDATE confirmation SET
  inReply = :reply
  WHERE StudentID = :studentid
  and LectureID = :lectureid");
    $update = $query->execute(array(
        "reply" => 1,
        "lectureid" => $LectureID,
        "studentid" => $_SESSION['userID']
    ));
echo 'ok';

}
else {
    echo('Session');
}


?>
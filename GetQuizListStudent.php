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
$quizStr = '';
$i = 0;
  foreach($QuizLists as $row){
$sqlquestion = "SELECT ID,LectureID,Option1,Option2,Option3,Option4,Option5,Question,Type,inTopicID FROM Questions WHERE ID={$row['QuestionsID']}";
$QuestionL = $conn -> query($sqlquestion);
$Question =$QuestionL->fetchObject();

echo "      <tr>";
echo "    <th colspan='2' style='width:60%;color:#32b4cd;'>Question ".($i + 1)."</th>";
echo "</tr>";
      $sqlimg = "SELECT * FROM ImgQuestions WHERE QuestionsID=$Question->ID";
      $QuizListimg = $conn -> query($sqlimg);
      $QuizListimg =$QuizListimg->fetchAll();

       foreach($QuizListimg as $rowimg) {
           echo "<tr>";
           echo "    <td colspan='2' class='description'><img style='width: 100%;' src='assets/lib/dropzone/uploads/".$rowimg["stImgName"]."' /> </td>";
           echo "</tr>";
       }
echo  "<tr>";
echo  "    <td colspan='2' class='description'>".$Question->Question."</td>";
echo  "</tr>";
echo  "<tr>";
echo  "    <td class='description'>A-) ".$Question->Option1."</td>";
echo  "    <td class='hours'>";
echo  "        <div class='be-radio'>";
echo  "            <input type='radio'  name='truefalse".($i + 1)."' lecture='$Question->LectureID' question='$Question->ID' id='".($i + 1)."-a'>";
echo  "            <label for='".($i + 1)."-a'></label>";
echo  "        </div>";
echo  "    </td>";
echo  "</tr>";
echo  "<tr>";
echo  "    <td class='description'>B-) ".$Question->Option2."</td>";
echo  "    <td class='hours'>";
echo  "        <div class='be-radio'>";
echo  "            <input type='radio'  name='truefalse".($i + 1)."' lecture='$Question->LectureID' question='$Question->ID' id='".($i + 1)."-b'>";
echo  "            <label for='".($i + 1)."-b'></label>";
echo  "        </div>";
echo  "    </td>";
echo  "</tr>";
echo  "<tr>";
echo  "    <td class='description'>C-) ".$Question->Option3."</td>";
echo  "    <td class='amount'>";
echo  "        <div class='be-radio'>";
echo  "            <input type='radio'  name='truefalse".($i + 1)."' lecture='$Question->LectureID' question='$Question->ID' id='".($i + 1)."-c'>";
echo  "            <label for='".($i + 1)."-c'></label>";
echo  "        </div>";
echo  "    </td>";
echo  "</tr>";
echo  "<tr>";
echo  "    <td class='description'>D-) ".$Question->Option4."</td>";
echo  "    <td class='amount'>";
echo  "        <div class='be-radio'>";
echo  "            <input type='radio'  name='truefalse".($i + 1)."' lecture='$Question->LectureID' question='$Question->ID' id='".($i + 1)."-d'>";
echo  "            <label for='".($i + 1)."-d'></label>";
echo  "        </div>";
echo  "    </td>";
echo  "</tr>";
echo  "<tr>";
echo  "    <td class='description'>E-) ".$Question->Option5."</td>";
echo  "    <td class='amount'>";
echo  "        <div class='be-radio'>";
echo  "            <input type='radio'  name='truefalse".($i + 1)."' lecture='$Question->LectureID' question='$Question->ID' id='".($i + 1)."-e'>";
echo  "            <label for='".($i + 1)."-e'></label>";
echo  "        </div>";
echo  "    </td>";
      echo  "</tr>";
      $i++;
  }

}
else {
  echo('Session');
}


?>

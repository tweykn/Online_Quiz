<<?php
$servername = "mysql:host=localhost;dbname=Online_Quiz";
$username = "root";
$password = "";

// Create connection
$conn = new PDO($servername, $username, $password);
session_start();
if (!isset($_SESSION['userTypeID'])) {
  header("Location: /Login.php");
}
else if (!isset($_GET['LectureID'])) {
  header("Location: \Home.php");
}

$LectureID = $_GET['LectureID'];
 ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="assets/img/logo-fav.png">
    <title>Online Quiz</title>
    <link rel="stylesheet" type="text/css" href="assets/lib/perfect-scrollbar/css/perfect-scrollbar.min.css"/>
    <link rel="stylesheet" type="text/css" href="assets/lib/material-design-icons/css/material-design-iconic-font.min.css"/><!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" type="text/css" href="assets/lib/jquery.vectormap/jquery-jvectormap-1.2.2.css"/>
    <link rel="stylesheet" type="text/css" href="assets/lib/jqvmap/jqvmap.min.css"/>
    <link rel="stylesheet" type="text/css" href="assets/lib/datetimepicker/css/bootstrap-datetimepicker.min.css"/>
    <link rel="stylesheet" href="assets/css/style.css" type="text/css"/>
  </head>
  <body>
    <div class="be-wrapper be-fixed-sidebar">
      <nav class="navbar navbar-default navbar-fixed-top be-top-header">
        <div class="container-fluid">
          <div class="navbar-header"><a href="home.php" class="navbar-brand"></a></div>
          <div class="be-right-navbar">
            <ul class="nav navbar-nav navbar-right be-user-nav">
              <li class="dropdown"><a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="dropdown-toggle"><img src="assets/img/avatar.png" alt="Avatar"><span class="user-name">Túpac Amaru</span></a>
                <ul role="menu" class="dropdown-menu">
                  <li>
                    <div class="user-info">
                      <div class="user-name">Tarek Khalifa</div>
                    </div>
                  </li>
                  <li><a href="#"><span class="icon mdi mdi-settings"></span> Settings</a></li>
                  <li><a href="javascript:LogOut_Click();"><span class="icon mdi mdi-power"></span> Logout</a></li>
                </ul>
              </li>
            </ul>
            <div class="page-title"><span>Confirmation</span></div>

          </div>
        </div>
      </nav>
      <div class="be-left-sidebar">
        <div class="left-sidebar-wrapper"><a href="home.php" class="left-sidebar-toggle">Home</a>
          <div class="left-sidebar-spacer">
            <div class="left-sidebar-scroll">
              <div class="left-sidebar-content">
                <ul class="sidebar-elements">
                  <li class="divider">Menu</li>
                  <li ><a href="home.php"><i class="icon mdi mdi-home"></i><span>Home</span></a>
                  </li>
                  <?php
    if ($_SESSION['userTypeID'] == 0)
    {
     ?>
     <li class="parent"><a href="addquestions.php"><i class="icon mdi mdi-home"></i><span>Add Question</span></a>
     </li>
     <li class="parent"><a href="CreateQuizs.php"><i class="icon mdi mdi-layers"></i><span>Browse Question</span></a>

     </li>

     <li class="parent"><a href="Confirmation.php"><i class="icon mdi mdi-chart-donut"></i><span>Confirmation</span></a>
       <ul class="sub-menu">
         <?php
         $sql = "SELECT * FROM Lectures";
         foreach ($conn -> query($sql) as $value) {
           $ValID = $value['ID'];
           $Valname = $value['Name'];
           $userID = $_SESSION['userID'];
           $result = $conn->prepare("SELECT * FROM CreateQuiz WHERE ExamID=$ValID and UserID = $userID");
           $result->execute();
           $number_of_rows = $result->fetchColumn();
           if ($number_of_rows > 0) {
             ?>
             <li><a href="/Confirmation.php?LectureID=<?php echo $ValID ?>"><?php echo $Valname ?></a>
             </li>
             <?php
           }
         }
         ?>
        </ul>
      </li>
    <?php
    }
    else if ($_SESSION['userTypeID'] == -1) {
        ?>
        <li class="parent"><a href="UserConfirm.php"><i class="icon mdi mdi-layers"></i><span>User Confirm</span></a>
        </li>
        <?php
    }
    else if ($_SESSION['userTypeID'] == 1) {
                      ?>
                      <li class="parent"><a href="Courses.php"><i class="icon mdi mdi-layers"></i><span>Courses</span></a>
                      </li>
                      <li class="parent"><a href="#"><i class="icon mdi mdi-layers"></i><span>Quiz</span></a>
                      </li>
                      <li class="parent"><a href="#"><i class="icon mdi mdi-layers"></i><span>Grades</span></a>
                      </li>
                      <?php
                  }
                  ?>
                </ul>
              </div>
            </div>
          </div>
          <div class="progress-widget">
            <div class="progress-data"><span class="progress-value">60%</span><span class="name">Current Project</span></div>
            <div class="progress">
              <div style="width: 60%;" class="progress-bar progress-bar-primary"></div>
            </div>
          </div>
        </div>
      </div>
      <div class="be-content">
        <div class="row">
                    <!--Responsive table-->
                    <div class="col-sm-12">
                      <div class="panel panel-default panel-table">
                        <div class="panel-heading">Confirmation

                        </div>
                        <div class="panel-body">
                          <table class="table table-striped table-hover">
                            <thead>
                              <tr>
                                <th style="width:20%;">Student</th>
                                <th style="width:10%;">Lecture</th>
                                <th style="width:10%;">Status</th>
                                <th style="width:10%;"></th>
                              </tr>
                            </thead>
                            <tbody>

<?php

$result = $conn->prepare("SELECT * FROM Confirmation WHERE LectureID = $LectureID");
$result->execute();
$number_of_rows = $result->rowCount();
if ($number_of_rows > 0) {
  $sqlquery = "SELECT * FROM Confirmation WHERE LectureID = $LectureID";
foreach ($conn -> query($sqlquery) as $value) {
$UserID = $value['StudentID'];
$userItem = $conn -> query("SELECT * FROM users WHERE  uid = $UserID");
$userItem =$userItem->fetchObject();

$LectureID = $value['LectureID'];
$lectureItem = $conn -> query("SELECT * FROM Lectures WHERE  id = $LectureID");
$lectureItem =$lectureItem->fetchObject();
    ?>
    <tr>
      <td class="user-avatar cell-detail user-info"><span><?php echo $userItem->email; ?></span><span class="cell-detail-description">Student</span></td>
      <td class="cell-detail"><span><?php echo $lectureItem->Name ?></span></td>
      <td class="cell-detail"><span><?php echo ($value['inConfirm'] == 0 ? 'Waiting':'Confirm') ?></span></td>
      <td class="text-right">
        <div class="btn-group btn-hspace">
          <button type="button" data-toggle="dropdown" class="btn btn-default dropdown-toggle">Actions <span class="icon-dropdown mdi mdi-chevron-down"></span></button>
          <ul role="menu" class="dropdown-menu pull-right">
              <?php
              if( $value['inConfirm'] == 0 ) {  ?>
                  <li><a href="javascript:Confirm_Click(<?php echo $UserID ?>,<?php echo $LectureID ?>,'<?php echo $userItem->email ?>','<?php echo $lectureItem->Name ?>');">Confirm Student</a></li>
           <?php   }
             else if( $value['inConfirm'] == 1 && $value['inReply'] == 1 ) {  ?>
                  <li><a href="javascript:ShowQuiz_Click(<?php echo $UserID ?>,<?php echo $LectureID ?>);">Show Quiz</a></li>
              <?php   } ?>
            <li><a href="javascript:Delete_Click(<?php echo $UserID ?>,<?php echo $LectureID ?>);">Delete</a></li>
          </ul>
        </div>
      </td>
    </tr>
    <?php
  }
}
else { ?>
    <tr><td colspan='3'>Answer can not found</td></tr>
    <?php } ?>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>        <div class="main-content container-fluid">
                    <div id='error'></div>
        </div>
      </div>
      <nav class="be-right-sidebar">
        <div class="sb-content">
          <div class="tab-navigation">
            <ul role="tablist" class="nav nav-tabs nav-justified">
              <li role="presentation" class="active"><a href="#tab1" aria-controls="tab1" role="tab" data-toggle="tab">Chat</a></li>
              <li role="presentation"><a href="#tab2" aria-controls="tab2" role="tab" data-toggle="tab">Todo</a></li>
              <li role="presentation"><a href="#tab3" aria-controls="tab3" role="tab" data-toggle="tab">Settings</a></li>
            </ul>
          </div>
          <div class="tab-panel">
            <div class="tab-content">
              <div id="tab1" role="tabpanel" class="tab-pane tab-chat active">
                <div class="chat-contacts">
                  <div class="chat-sections">
                    <div class="be-scroller">
                      <div class="content">
                        <h2>Recent</h2>
                        <div class="contact-list contact-list-recent">
                          <div class="user"><a href="#"><img src="assets/img/avatar1.png" alt="Avatar">
                              <div class="user-data"><span class="status away"></span><span class="name">Claire Sassu</span><span class="message">Can you share the...</span></div></a></div>
                          <div class="user"><a href="#"><img src="assets/img/avatar2.png" alt="Avatar">
                              <div class="user-data"><span class="status"></span><span class="name">Maggie jackson</span><span class="message">I confirmed the info.</span></div></a></div>
                          <div class="user"><a href="#"><img src="assets/img/avatar3.png" alt="Avatar">
                              <div class="user-data"><span class="status offline"></span><span class="name">Joel King		</span><span class="message">Ready for the meeti...</span></div></a></div>
                        </div>
                        <h2>Contacts</h2>
                        <div class="contact-list">
                          <div class="user"><a href="#"><img src="assets/img/avatar4.png" alt="Avatar">
                              <div class="user-data2"><span class="status"></span><span class="name">Mike Bolthort</span></div></a></div>
                          <div class="user"><a href="#"><img src="assets/img/avatar5.png" alt="Avatar">
                              <div class="user-data2"><span class="status"></span><span class="name">Maggie jackson</span></div></a></div>
                          <div class="user"><a href="#"><img src="assets/img/avatar6.png" alt="Avatar">
                              <div class="user-data2"><span class="status offline"></span><span class="name">Jhon Voltemar</span></div></a></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="bottom-input">
                    <input type="text" placeholder="Search..." name="q"><span class="mdi mdi-search"></span>
                  </div>
                </div>
                <div class="chat-window">
                  <div class="title">
                    <div class="user"><img src="assets/img/avatar2.png" alt="Avatar">
                      <h2>Maggie jackson</h2><span>Active 1h ago</span>
                    </div><span class="icon return mdi mdi-chevron-left"></span>
                  </div>
                  <div class="chat-messages">
                    <div class="be-scroller">
                      <div class="content">
                        <ul>
                          <li class="friend">
                            <div class="msg">Hello</div>
                          </li>
                          <li class="self">
                            <div class="msg">Hi, how are you?</div>
                          </li>
                          <li class="friend">
                            <div class="msg">Good, I'll need support with my pc</div>
                          </li>
                          <li class="self">
                            <div class="msg">Sure, just tell me what is going on with your computer?</div>
                          </li>
                          <li class="friend">
                            <div class="msg">I don't know it just turns off suddenly</div>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                  <div class="chat-input">
                    <div class="input-wrapper"><span class="photo mdi mdi-camera"></span>
                      <input type="text" placeholder="Message..." name="q" autocomplete="off"><span class="send-msg mdi mdi-mail-send"></span>
                    </div>
                  </div>
                </div>
              </div>
              <div id="tab2" role="tabpanel" class="tab-pane tab-todo">
                <div class="todo-container">
                  <div class="todo-wrapper">
                    <div class="be-scroller">
                      <div class="todo-content"><span class="category-title">Today</span>
                        <ul class="todo-list">
                          <li>
                            <div class="be-checkbox be-checkbox-sm"><span class="delete mdi mdi-delete"></span>
                              <input id="todo1" type="checkbox" checked="">
                              <label for="todo1">Initialize the project</label>
                            </div>
                          </li>
                          <li>
                            <div class="be-checkbox be-checkbox-sm"><span class="delete mdi mdi-delete"></span>
                              <input id="todo2" type="checkbox">
                              <label for="todo2">Create the main structure</label>
                            </div>
                          </li>
                          <li>
                            <div class="be-checkbox be-checkbox-sm"><span class="delete mdi mdi-delete"></span>
                              <input id="todo3" type="checkbox">
                              <label for="todo3">Updates changes to GitHub</label>
                            </div>
                          </li>
                        </ul><span class="category-title">Tomorrow</span>
                        <ul class="todo-list">
                          <li>
                            <div class="be-checkbox be-checkbox-sm"><span class="delete mdi mdi-delete"></span>
                              <input id="todo4" type="checkbox">
                              <label for="todo4">Initialize the project</label>
                            </div>
                          </li>
                          <li>
                            <div class="be-checkbox be-checkbox-sm"><span class="delete mdi mdi-delete"></span>
                              <input id="todo5" type="checkbox">
                              <label for="todo5">Create the main structure</label>
                            </div>
                          </li>
                          <li>
                            <div class="be-checkbox be-checkbox-sm"><span class="delete mdi mdi-delete"></span>
                              <input id="todo6" type="checkbox">
                              <label for="todo6">Updates changes to GitHub</label>
                            </div>
                          </li>
                          <li>
                            <div class="be-checkbox be-checkbox-sm"><span class="delete mdi mdi-delete"></span>
                              <input id="todo7" type="checkbox">
                              <label for="todo7" title="This task is too long to be displayed in a normal space!">This task is too long to be displayed in a normal space!</label>
                            </div>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                  <div class="bottom-input">
                    <input type="text" placeholder="Create new task..." name="q"><span class="mdi mdi-plus"></span>
                  </div>
                </div>
              </div>
              <div id="tab3" role="tabpanel" class="tab-pane tab-settings">
                <div class="settings-wrapper">
                  <div class="be-scroller"><span class="category-title">General</span>
                    <ul class="settings-list">
                      <li>
                        <div class="switch-button switch-button-sm">
                          <input type="checkbox" checked="" name="st1" id="st1"><span>
                            <label for="st1"></label></span>
                        </div><span class="name">Available</span>
                      </li>
                      <li>
                        <div class="switch-button switch-button-sm">
                          <input type="checkbox" checked="" name="st2" id="st2"><span>
                            <label for="st2"></label></span>
                        </div><span class="name">Enable notifications</span>
                      </li>
                      <li>
                        <div class="switch-button switch-button-sm">
                          <input type="checkbox" checked="" name="st3" id="st3"><span>
                            <label for="st3"></label></span>
                        </div><span class="name">Login with Facebook</span>
                      </li>
                    </ul><span class="category-title">Notifications</span>
                    <ul class="settings-list">
                      <li>
                        <div class="switch-button switch-button-sm">
                          <input type="checkbox" name="st4" id="st4"><span>
                            <label for="st4"></label></span>
                        </div><span class="name">Email notifications</span>
                      </li>
                      <li>
                        <div class="switch-button switch-button-sm">
                          <input type="checkbox" checked="" name="st5" id="st5"><span>
                            <label for="st5"></label></span>
                        </div><span class="name">Project updates</span>
                      </li>
                      <li>
                        <div class="switch-button switch-button-sm">
                          <input type="checkbox" checked="" name="st6" id="st6"><span>
                            <label for="st6"></label></span>
                        </div><span class="name">New comments</span>
                      </li>
                      <li>
                        <div class="switch-button switch-button-sm">
                          <input type="checkbox" name="st7" id="st7"><span>
                            <label for="st7"></label></span>
                        </div><span class="name">Chat messages</span>
                      </li>
                    </ul><span class="category-title">Workflow</span>
                    <ul class="settings-list">
                      <li>
                        <div class="switch-button switch-button-sm">
                          <input type="checkbox" name="st8" id="st8"><span>
                            <label for="st8"></label></span>
                        </div><span class="name">Deploy on commit</span>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </nav>
    </div>
    <script src="assets/lib/jquery/jquery.min.js" type="text/javascript"></script>
    <script src="assets/lib/perfect-scrollbar/js/perfect-scrollbar.jquery.min.js" type="text/javascript"></script>
    <script src="assets/js/main.js" type="text/javascript"></script>
    <script src="assets/lib/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="assets/lib/jquery-flot/jquery.flot.js" type="text/javascript"></script>
    <script src="assets/lib/jquery-flot/jquery.flot.pie.js" type="text/javascript"></script>
    <script src="assets/lib/jquery-flot/jquery.flot.resize.js" type="text/javascript"></script>
    <script src="assets/lib/jquery-flot/plugins/jquery.flot.orderBars.js" type="text/javascript"></script>
    <script src="assets/lib/jquery-flot/plugins/curvedLines.js" type="text/javascript"></script>
    <script src="assets/lib/jquery.sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
    <script src="assets/lib/countup/countUp.min.js" type="text/javascript"></script>
    <script src="assets/lib/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
    <script src="assets/lib/jqvmap/jquery.vmap.min.js" type="text/javascript"></script>
    <script src="assets/lib/jqvmap/maps/jquery.vmap.world.js" type="text/javascript"></script>
    <script src="assets/js/app-dashboard.js" type="text/javascript"></script>
    <script type="text/javascript">
      $(document).ready(function(){
      	//initialize the javascript
      	App.init();
      	App.dashboard();

      });
function LogOut_Click() {
  $.ajax({
  type : 'POST',
  url : 'logoutMethod.php',
  data : {},
  success : function(response){
  if(response=="ok"){
   window.location.reload();
  }
  }
  });
}
      function Confirm_Click(studentID, LectureID,mail,lectureName) {
        $.ajax({
        type : 'POST',
        url : 'confirmationMethod.php',
        data : {
          $studentID : studentID,
          $LectureID : LectureID,
          $Type : 'CONFIRM'
                    },
        success : function(response){
        if(response=="ok"){
          $.ajax({
          type : 'POST',
          url : 'Sendmail.php',
          data : {
            mail : mail,
            title : 'Confirm',
            subject : 'Confirm',
            message : 'You confirm for the course. ' + lectureName,
                      },
          success : function(response){

          }
          });
         window.location.reload();
        } else {
        $("#error").fadeIn(1000, function(){
        $("#error").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span>   '+response+'<br/> Try Again</div>');
        });
        }
        }
        });



      }
      function Delete_Click(studentID, LectureID) {
        $.ajax({
        type : 'POST',
        url : 'confirmationMethod.php',
        data : {
          $studentID : studentID,
          $LectureID : LectureID,
          $Type : 'CDELETE'
                    },
        success : function(response){
        if(response=="ok"){
         window.location.reload();
        } else {
        $("#error").fadeIn(1000, function(){
        $("#error").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span>   '+response+'<br/> Try Again</div>');
        });
        }
        }
        });
      }
      function ShowQuiz_Click(studentID, LectureID) {
window.location= 'ShowQuizComplate.php?lid='+LectureID+'&sid='+studentID;
      }

    </script>
  </body>
</html>

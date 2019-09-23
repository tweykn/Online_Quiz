<?php
$servername = "mysql:host=localhost;dbname=Online_Quiz";
$username = "root";
$password = "";
// Create connection
$pdo = new PDO($servername, $username, $password);
session_start();
if (!isset($_SESSION['userTypeID'])) {
  header("Location: /Login.php");
}

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
    <link rel="stylesheet" type="text/css" href="assets/lib/dropzone/dist/dropzone.css"/>
    <link rel="stylesheet" type="text/css" href="assets/lib/datatables/css/dataTables.bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="assets/lib/select2/css/select2.min.css"/>
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
            <div class="page-title"><span>Add Question</span></div>

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
                  <li class="active"><a href="addquestions.php"><i class="icon mdi mdi-home"></i><span>Add Question</span></a>
                  </li>
                  <li class="parent"><a href="CreateQuizs.php"><i class="icon mdi mdi-layers"></i><span>Browse Question</span></a>

                  </li>
                  <li class="parent"><a href="#"><i class="icon mdi mdi-chart-donut"></i><span>Confirmation</span></a>
                    <ul class="sub-menu">
                      <?php
                      $sql = "SELECT * FROM Lectures";
                      foreach ($pdo -> query($sql) as $value) {
                        $ValID = $value['ID'];
                        $Valname = $value['Name'];
                        $userID = $_SESSION['userID'];
                        $result = $pdo->prepare("SELECT * FROM CreateQuiz WHERE ExamID=$ValID and UserID = $userID");
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


                </ul>
              </div>
            </div>
          </div>
          <div class="progress-widget">
            <div class="progress-data"><span class="progress-value">35%</span><span class="name">Current Project</span></div>
            <div class="progress">
              <div style="width: 35%;" class="progress-bar progress-bar-primary"></div>
            </div>
          </div>
        </div>
      </div>
      <div class="be-content">

        <?PHP
        if(isset($_GET['result'])){
          if($_GET['result'] == 1){
?>

        <div class="main-content container-fluid">
          <div role="alert" class="alert alert-contrast alert-success alert-dismissible">
            <div class="icon"><span class="mdi mdi-check"></span></div>
            <div class="message">
              <button type="button" data-dismiss="alert" aria-label="Close" class="close"><span aria-hidden="true" class="mdi mdi-close"></span></button><strong>Good!</strong> Better check yourself, you're not looking too good.
            </div>
          </div>
          <?PHP
        }}
          ?>


<div id="questions" class="row">
            <div class="col-md-12 newQuestion">
              <div class="panel panel-default panel-border-color panel-border-color-primary">


                <div class="panel-heading panel-heading-divider">Question<span class="panel-subtitle">Write the question and the answers below</span></div>
                <div class="panel-body">

<div class="row">
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Lecture</label>
                    <div class="col-sm-4">
                      <select class="select2" id='TypeID'>
                        <?php

                        $sql = "SELECT Id, Name FROM Department ORDER BY Name ASC";
                        foreach ($pdo->query($sql) as $dpts) {
                          ?>
                          <optgroup label="<?PHP echo $dpts['Name']; ?>">
                            <?php
                            $id = $dpts['Id'];
                            $sql2 = "SELECT Name,ID FROM Lectures WHERE DepartmentId=$id ORDER BY Name ASC";
                            foreach ($pdo->query($sql2) as $lcts) {
                              ?>
                              <option value="<?PHP echo $lcts['ID']; ?>"><?PHP echo $lcts['Name']; ?></option>
                                <?php } ?>
                          </optgroup>
                          <?php   } ?>
                        </optgroup>
                      </select>
                    </div>
                    <label class="col-sm-2 control-label">Topic</label>
                    <div class="col-sm-3">
                      <select class="select2" id='TopicID'>
                        <option value="1">Topic 1</option>
                        <option value="2">Topic 2</option>
                        <option value="3">Topic 3</option>
                        <option value="4">Topic 4</option>
                        <option value="5">Topic 5</option>
                        <option value="6">Topic 6</option>
                        <option value="7">Topic 7</option>
                        <option value="8">Topic 8</option>
                        <option value="9">Topic 9</option>
                        <option value="10">Topic 10</option>
                      </select>
                    </div>
                  </div>

                  </div>





                  <div class="main-content container-fluid">
                    <form id="my-awesome-dropzone" action="assets/lib/dropzone/upload.php" class="dropzone">
                      <div class="dz-message">
                        <div class="icon"><span class="mdi mdi-cloud-upload"></span></div>
                        <h2>Drag and Drop files here</h2><span class="note">ADD IMAGE </span>
                      </div>
                    </form>
                  </div>

                  <form action="" style="border-radius: 0px;" class="form-horizontal group-border-dashed">


                    <div class="form-group">
                      <label class="col-sm-3 control-label">Question</label>
                      <div class="col-sm-6">
                        <textarea required="" id="editor2" name="content" rows="10"></textarea>
                      </div>
                    </div>

<div class="form-group">
                      <label class="col-sm-3 control-label">a)</label>
                      <div class="col-sm-5">
                        <input required="" type="text" id='option1' class="form-control input-sm">
                      </div>
<div class="col-sm-1">
                      <div class="be-radio">
                                                <input type="radio" checked="" name="truefalse" id="a">
                                                <label for="a"></label>
                                              </div>

                                            </div>
                    </div>
<div class="form-group">
                      <label class="col-sm-3 control-label">b)</label>
                      <div class="col-sm-5">
                        <input required="" type="text" id='option2' class="form-control input-sm">
                      </div>
                      <div class="col-sm-1">
                                            <div class="be-radio">
                                                                      <input type="radio"  name="truefalse" id="b">
                                                                      <label for="b"></label>
                                                                    </div>

                                                                  </div>
                    </div>
<div class="form-group">
                      <label class="col-sm-3 control-label">c)</label>
                      <div class="col-sm-5">
                        <input required="" type="text" id='option3' class="form-control input-sm">
                      </div>
                      <div class="col-sm-1">
                                            <div class="be-radio">
                                                                      <input type="radio" name="truefalse" id="c">
                                                                      <label for="c"></label>
                                                                    </div>

                                                                  </div>
                    </div>
<div class="form-group">
                      <label class="col-sm-3 control-label">d)</label>
                      <div class="col-sm-5">
                        <input required="" type="text" id='option4' class="form-control input-sm">
                      </div>
                      <div class="col-sm-1">
                                            <div class="be-radio">
                                                                      <input type="radio" name="truefalse" id="d">
                                                                      <label for="d"></label>
                                                                    </div>

                                                                  </div>
                    </div><div class="form-group">
                      <label class="col-sm-3 control-label">e)</label>
                      <div class="col-sm-5">
                        <input required="" type="text" id='option5' class="form-control input-sm">
                      </div>
                      <div class="col-sm-1">
                                            <div class="be-radio">
                                                                      <input type="radio"  name="truefalse" id="e">
                                                                      <label for="e"></label>
                                                                    </div>

                                                                  </div>
                    </div><div class="form-group">
                      <label class="col-sm-3 control-label">Type</label>
                      <div class="col-sm-6">
                        <select id='typeID' class="form-control input-sm">
                          <option value='0'>Easy</option>
                          <option value='1'>Regular</option>
<option value='2'>Hard</option>
                        </select>
                      </div>
                    </div>

                  </form>
                </div>
              </div>
            </div>
          </div>
<button onclick='Add_Questions();' class="btn btn-space btn-primary btn-lg pull-right"><i class="icon icon-left mdi mdi-cloud-done"></i> Add New Question</button>
<br>
<div id="error">
</div>
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
    <script src="assets/lib/dropzone/dist/dropzone.js" type="text/javascript"></script>
    <script src="assets/lib/bootstrap-markdown/js/bootstrap-markdown.js" type="text/javascript"></script>
    <script src="assets/lib/markdown-js/markdown.js" type="text/javascript"></script>
    <script src="assets/lib/datatables/js/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="assets/lib/datatables/js/dataTables.bootstrap.min.js" type="text/javascript"></script>
    <script src="assets/lib/datatables/plugins/buttons/js/dataTables.buttons.js" type="text/javascript"></script>
    <script src="assets/lib/datatables/plugins/buttons/js/buttons.html5.js" type="text/javascript"></script>
    <script src="assets/lib/datatables/plugins/buttons/js/buttons.flash.js" type="text/javascript"></script>
    <script src="assets/lib/datatables/plugins/buttons/js/buttons.print.js" type="text/javascript"></script>
    <script src="assets/lib/datatables/plugins/buttons/js/buttons.colVis.js" type="text/javascript"></script>
    <script src="assets/lib/datatables/plugins/buttons/js/buttons.bootstrap.js" type="text/javascript"></script>
    <script src="assets/lib/select2/js/select2.min.js" type="text/javascript"></script>
    <script src="assets/js/app-tables-datatables.js" type="text/javascript"></script>
    <script src="assets/js/app-dashboard.js" type="text/javascript"></script>
    <script type="text/javascript">
      $(document).ready(function(){
      	//initialize the javascript
      	App.init();
        $("#editor2").markdown({buttonSize: 'normal'});


        $(".select2").select2({
             width: '100%'
           });

           //Select2 tags
           $(".tags").select2({tags: true, width: '100%'});


      });
      function  Add_Questions(){
        var imageList = [];
        var imagespan =   document.querySelectorAll('#my-awesome-dropzone .dz-success .dz-image img');
        for (var i =0; i < imagespan.length; i++) {
        var img = imagespan[i];
        imageList.push(img.getAttribute('alt'));
        }

var trueOption = document.querySelector('input[name="truefalse"]:checked').getAttribute('id');
        $.ajax({
        type : 'POST',
        url : 'addquestion.php',
        data : {
          $questionImg : imageList,
          $questionName : $("#editor2").val(),
          $questionOption1 : $("#option1").val(),
          $questionOption2: $("#option2").val(),
          $questionOption3 : $("#option3").val(),
          $questionOption4 : $("#option4").val(),
          $questionOption5 : $("#option5").val(),
          $questionType : $("#typeID").val(),
          $LessonID : $("#TypeID").val(),
          $TrueOption : trueOption,
          $TopicID : $("#TopicID").val()
                    },
        beforeSend: function(){

        },
        success : function(response){
        if(response=="ok"){
         window.location.href = "addquestions.php";
        } else {
        $("#error").fadeIn(1000, function(){
        $("#error").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span>   '+response+'<br/> Try Again</div>');
        });
        }
        }
        });
      }
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

    </script>
  </body>
</html>

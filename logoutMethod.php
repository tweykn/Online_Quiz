<?PHP
session_start();
unset($_SESSION['userID']);
unset($_SESSION['userTypeID']);
echo 'ok';
?>

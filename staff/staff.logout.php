
<?php
 
session_start();
 
//ログイン済みかを確認
if (!isset($_SESSION['USER'])) {
    header('Location: login.php');
    exit;
}
 
//ログアウト機能
if(isset($_POST['logout'])){
    // ①
    $_SESSION = [];
    session_destroy();
 
    header('Location: login.php');
    exit;
}
 
?>
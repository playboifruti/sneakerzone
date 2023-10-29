<?php
$correct_password = 'dima0987A';

if(isset($_POST['password']) && $_POST['password'] === $correct_password){
    session_start();
    $_SESSION['authenticated'] = true;
    header('Location: admin.php');
    exit();
} else {
    echo 'Incorrect password. <a href="login.php">Try again</a>';
}
?>

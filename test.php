<?php
session_start();
echo $_SESSION['title_now'];
$_SESSION['check_watch'] = 0;
if(isset($_SESSION['check_watch'])){
echo '<br>Have';
}
?>
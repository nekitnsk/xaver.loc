<?php


$_SESSION['notice'][$_POST['title']] = $_POST;
header("location: dz6.php"); 
print_r($_SESSION);
?>




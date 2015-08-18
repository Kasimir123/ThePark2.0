<?php

session_start();
unset($_SESSION['user_login']);
session_destroy();
session_write_close();
header('Location: ../index.php');

?>

<?php
session_start();

if (!empty(($_SESSION['user']))) {
    header('Location: ../Registraiya/profile.php');
}else{
    header('Location: ../Registraiya/login.php');
}

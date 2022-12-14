<?php
session_start();
unset($_SESSION['login']);
unset($_SESSION['login_url']);
unset($_SESSION['login_reg_url']);
unset($_SESSION['login_try']);
header("location:".$_SERVER['HTTP_REFERER']);
?>
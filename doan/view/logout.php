<?php
session_start();

// Xóa tất cả các biến trong session
$_SESSION = array();

// Huỷ session
session_destroy();

// Chuyển hướng người dùng về trang index.php hoặc trang chính của bạn
header("Location: ./login.php");
exit;
?>

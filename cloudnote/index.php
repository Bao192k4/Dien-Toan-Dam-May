<?php
session_start();
ob_start();
require_once 'controller/controller.php';
new Controller(); // GỌI MỘT LẦN DUY NHẤT
?>
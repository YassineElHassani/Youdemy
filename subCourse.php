<?php
require_once './config/connection.php';
require_once './class/Student.php';

session_start();

if (!isset($_SESSION['id'])) {
    header("Location: login/index.php");
    exit();
}

$userId = $_SESSION['id'];


if(isset($_GET['id'])) {
    $course = new Student();
    $message = $course->subscribeToCourse($userId, $_GET['id']);
}

header("Location: myCourses.php");
exit();

?>
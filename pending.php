<?php
session_start();

if (!isset($_SESSION['id']) || $_SESSION['role'] !== 'teacher') {
    header("Location: login/index.php");
    exit();
}

?>

<?php 
include_once './layout/penHeader.php';
?>

<div class="bg-white p-8 shadow-lg max-w-full text-center mt-[150px]">
    <img src="./src/img/pending.png" alt="Pending Approval" class="w-24 h-24 mx-auto mb-6">
    <h1 class="text-2xl font-bold text-gray-800 mb-4">Your Account is Pending Activation</h1>
    <p class="text-gray-600 mb-6">
        Thank you for signing up as a teacher. Your account is currently under review and needs to be activated by an administrator.
    </p>
    <p class="text-gray-600 mb-6">
        Once your account is activated, you'll receive an email notification. Please check back later or contact support if you have any questions.
    </p>
</div>

<?php
include_once './layout/stateFooter.php';
?>
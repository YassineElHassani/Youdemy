<?php
require_once '../class/Teacher.php';

session_start();

if (!isset($_SESSION["id"]) || $_SESSION["role"] !== "teacher") {
    header("Location: ../login/index.php");
    exit();
}

$userId = $_SESSION['id'];

$stats = new Teacher();
$totalCourses = $stats->totalCourses($userId);
$totalSubscribers = $stats->totalSubscribers($userId);

?>

<?php
include_once './layout/header.php';
?>

<div class="dash-content">
    <div class="overview">
        <div class="title">
            <i class="uil uil-tachometer-fast-alt"></i>
            <span class="text">Statistics</span>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-1 lg:grid-cols-2 gap-6">
            <div class="bg-blue-500 text-white p-6 rounded-lg shadow-lg flex items-center justify-between">
                <div>
                    <img src="../src/img/course.png" height="40px" width="40px">
                </div>
                <div>
                    <p class="text-lg font-semibold">Total Courses</p>
                    <p class="text-2xl font-bold"><?php echo htmlspecialchars($totalCourses); ?></p>
                </div>
            </div>
            <div class="bg-green-500 text-white p-6 rounded-lg shadow-lg flex items-center justify-between">
                <div>
                    <img src="../src/img/student.png" height="40px" width="40px">
                </div>
                <div>
                    <p class="text-lg font-semibold">Total Subscribers</p>
                    <p class="text-2xl font-bold"><?php echo htmlspecialchars($totalSubscribers) ?></p>
                </div>
            </div>
        </div>

    </div>
</div>

<?php
include_once './layout/footer.php';
?>
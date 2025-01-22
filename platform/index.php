<?php
require_once '../class/Teacher.php';

session_start();

if (!isset($_SESSION["id"]) || $_SESSION["role"] !== "teacher") {
    header("Location: ../login/index.php");
    exit();
}

$userId = $_SESSION['id'];

$stats = new Teacher();
$user = $stats->allCourses($userId);

?>

<?php
include_once './layout/header.php';
?>

<div class="dash-content">
    <div class="activity">
        <div class="title">
            <i class="uil uil-clock-three"></i>
            <span class="text">All Courses</span>
        </div>
        <div class="activity-data">
            <div class="data">
                <span class="data-title">Titles</span>
                <?php
                $i = 0;
                while ($i < count($user)): ?>
                        <span class="data-list"><?php echo htmlspecialchars($user[$i]["title"]) ?></span>
                <?php
                    $i++;
                endwhile;
                ?>
            </div>
        </div>
    </div>
</div>

<?php
include_once './layout/footer.php';
?>
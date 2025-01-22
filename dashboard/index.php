<?php
require_once '../class/Admin.php';

session_start();

if (!isset($_SESSION["id"]) || $_SESSION["role"] !== "admin") {
    header("Location: ../login/index.php");
    exit();
}

$stats = new Admin();
$user = $stats->getAllUsers();

?>

<?php
include_once './layout/header.php';
?>

<div class="dash-content">

    <div class="activity">
        <div class="title">
            <span class="text">All Users info</span>
        </div>

        <div class="activity-data">
            <div class="data">
                <span class="data-title">ID</span>
                <?php
                $i = 0;
                while ($i < count($user)): ?>
                        <span class="data-list"><?php echo htmlspecialchars($user[$i]["id"]) ?></span>
                <?php
                    $i++;
                endwhile;
                ?>
            </div>
            <div class="data">
                <span class="data-title">Name</span>
                <?php
                $i = 0;
                while ($i < count($user)): ?>
                        <span class="data-list"><?php echo htmlspecialchars($user[$i]["name"]) ?></span>
                <?php
                    $i++;
                endwhile;
                ?>
            </div>
            <div class="data">
                <span class="data-title">Email</span>
                <?php
                $i = 0;
                while ($i < count($user)): ?>
                        <span class="data-list"><?php echo htmlspecialchars($user[$i]["email"]) ?></span>
                <?php
                    $i++;
                endwhile;
                ?>
            </div>
            <div class="data">
                <span class="data-title">Role</span>
                <?php
                $i = 0;
                while ($i < count($user)): ?>
                        <span class="data-list"><?php echo htmlspecialchars($user[$i]["role"]) ?></span>
                <?php
                    $i++;
                endwhile;
                ?>
            </div>
            <div class="data">
                <span class="data-title">Status</span>
                <?php
                $i = 0;
                while ($i < count($user)): ?>
                        <span class="data-list"><?php echo htmlspecialchars($user[$i]["status"]) ?></span>
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
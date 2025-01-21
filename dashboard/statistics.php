<?php
require_once '../class/Admin.php';

session_start();

if (!isset($_SESSION["id"]) || $_SESSION["role"] !== "admin") {
    header("Location: ../login/index.php");
    exit();
}

$stats = new Admin();
$totalActiveUsers = $stats->totalActiveUsers();
$totalDeactivatedUsers = $stats->totalDeactivatedUsers();
$totalSuspendedUser = $stats->totalSuspendedUser();

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
    </div>

    <div class="activity">
        <div class="activity-data" style="padding-left: 20%;">
            <div style="height: 800px; width: 750px; border-radius: 30px; padding: 10px;">
                <canvas id="chart" style="margin-top: 20px;"></canvas>
            </div>
            <script>
                const totalActiveUsers = <?php echo htmlspecialchars($totalActiveUsers); ?>;
                const totalDeactivatedUsers = <?php echo htmlspecialchars($totalDeactivatedUsers); ?>;
                const totalSuspendedUser = <?php echo htmlspecialchars($totalSuspendedUser); ?>;

                const data = {
                    labels: ['Active Users', 'Deactivated Users', 'Suspended User'],
                    datasets: [{
                        label: 'Dataset Overview',
                        data: [totalActiveUsers, totalDeactivatedUsers, totalSuspendedUser],
                        backgroundColor: [
                            'rgb(75, 222, 151)',
                            'rgb(255, 173, 50)',
                            'rgb(255, 88, 88)'
                        ]
                    }]
                };

                const config = {
                    type: 'polarArea',
                    data: data,
                    options: {
                        responsive: true,
                    }
                };

                const ctx = document.getElementById('chart').getContext('2d');
                new Chart(ctx, config);
            </script>
        </div>
    </div>
</div>

<?php
include_once './layout/footer.php';
?>
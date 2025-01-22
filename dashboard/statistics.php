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
$totalCourses = $stats->totalCourses();
$totalUsers = $stats->totalUsers();
$totalStudents = $stats->totalStudents();
$totalTeachers = $stats->totalTeachers();
$totalCategories = $stats->totalCategories();
$totalTags = $stats->totalTags();


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

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="bg-blue-500 text-white p-6 rounded-lg shadow-lg flex items-center justify-between">
                <div>
                    <img src="../src/img/users.png" height="40px" width="40px">
                </div>
                <div>
                    <p class="text-lg font-semibold">Total Users</p>
                    <p class="text-2xl font-bold"><?php echo htmlspecialchars($totalUsers); ?></p>
                </div>
            </div>
            <div class="bg-green-500 text-white p-6 rounded-lg shadow-lg flex items-center justify-between">
                <div>
                <img src="../src/img/student.png" height="40px" width="40px">
                </div>
                <div>
                    <p class="text-lg font-semibold">Total Students</p>
                    <p class="text-2xl font-bold"><?php echo htmlspecialchars($totalStudents) ?></p>
                </div>
            </div>
            <div class="bg-purple-500 text-white p-6 rounded-lg shadow-lg flex items-center justify-between">
                <div>
                    <img src="../src/img/teacher.png" height="40px" width="40px">
                </div>
                <div>
                    <p class="text-lg font-semibold">Total Teachers</p>
                    <p class="text-2xl font-bold"><?php echo htmlspecialchars($totalTeachers) ?></p>
                </div>
            </div>
            <div class="bg-pink-500 text-white p-6 rounded-lg shadow-lg flex items-center justify-between">
                <div>
                    <img src="../src/img/course.png" height="40px" width="40px">
                </div>
                <div>
                    <p class="text-lg font-semibold">Total Courses</p>
                    <p class="text-2xl font-bold"><?php echo htmlspecialchars($totalCourses); ?></p>
                </div>
            </div>
            <div class="bg-yellow-500 text-white p-6 rounded-lg shadow-lg flex items-center justify-between">
                <div>
                    <img src="../src/img/category.png" height="40px" width="40px">
                </div>
                <div>
                    <p class="text-lg font-semibold">Total Categories</p>
                    <p class="text-2xl font-bold"><?php echo htmlspecialchars($totalCategories) ?></p>
                </div>
            </div>
            <div class="bg-teal-500 text-white p-6 rounded-lg shadow-lg flex items-center justify-between">
                <div>
                    <img src="../src/img/tags.png" height="40px" width="40px">
                </div>
                <div>
                    <p class="text-lg font-semibold">Total Tags</p>
                    <p class="text-2xl font-bold"><?php echo htmlspecialchars($totalTags) ?></p>
                </div>
            </div>
        </div>
    </div>

    <div class="activity">
        <div class="activity-data" style="padding-left: 20%;">
            <div style="height: 700px; width: 650px; border-radius: 30px; padding: 10px; padding: 50px;">
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
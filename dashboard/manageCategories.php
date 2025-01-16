<?php 

session_start();

if (!isset($_SESSION["id"]) || $_SESSION["role"] !== "admin") {
  header("Location: ../login/index.php");
  exit();
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../src/css/dashboard.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <title>Admin Dashboard</title>
</head>
<body>
    <nav>
        <div class="logo-name">
            <div class="logo-image">
                <img src="../src/img/logo.jpg" alt="">
            </div>

            <span class="logo_name">Youdemy</span>
        </div>

        <div class="menu-items">
            <ul class="nav-links">
                <li><a href="./index.php">
                    <i class="uil uil-estate"></i>
                    <span class="link-name">Dahsboard</span>
                </a></li>
                <li><a href="./statistics.php">
                    <i class="uil uil-chart"></i>
                    <span class="link-name">Statistics</span>
                </a></li>
                <li><a href="./manageUsers.php">
                    <i class="uil uil-users-alt"></i>
                    <span class="link-name">Manage Users</span>
                </a></li>
                <li><a href="./manageCourses.php">
                    <i class="uil uil-files-landscapes"></i>
                    <span class="link-name">Manage Courses</span>
                </a></li>
                <li><a href="./manageCategories.php">
                    <i class="uil uil-create-dashboard"></i>
                    <span class="link-name">Manage Categories</span>
                </a></li>
                <li><a href="./manageTags.php">
                    <i class="uil uil-tag"></i>
                    <span class="link-name">Manage Tags</span>
                </a></li>
            </ul>
            
            <ul class="logout-mode">
                <li><a href="../logout.php">
                    <i class="uil uil-signout"></i>
                    <span class="link-name">Logout</span>
                </a></li>

                <li class="mode">
                    <a href="#">
                        <i class="uil uil-moon"></i>
                        <span class="link-name">Dark Mode</span>
                    </a>

                    <div class="mode-toggle">
                        <span class="switch"></span>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <section class="dashboard">
        <div class="top">
            <i class="uil uil-bars sidebar-toggle"></i>

            <div class="search-box">
                <i class="uil uil-search"></i>
                <input type="text" placeholder="Search here...">
            </div>
            
            <img src="../src/img/profile.php" alt="">
        </div>

        <div class="dash-content">
            <div class="overview">
                <div class="title">
                    <i class="uil uil-tachometer-fast-alt"></i>
                    <span class="text">Manage Categories</span>
                </div>
            </div>

            <div class="activity">
                <div class="title">
                    <i class="uil uil-clock-three"></i>
                    <span class="text">Recent Activity</span>
                </div>

                <div class="activity-data">

                </div>
            </div>
        </div>
    </section>

    <script src="../src/js/dashboard.js"></script>
</body>
</html>
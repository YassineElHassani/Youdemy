<?php
require_once '../class/Users.php';

session_start();

if (!isset($_SESSION["id"]) || $_SESSION["role"] !== "admin") {
    header("Location: ../login/index.php");
    exit();
}

$users = new Users();
$user = $users->getAllUsers();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../src/css/dashboard.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <script src="https://cdn.tailwindcss.com"></script>
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
                    <span class="text">Manage Users</span>
                </div>
            </div>

            <div class="activity">
                <div class="activity-data">
                    <table class="min-w-full border border-gray-200 shadow-sm rounded-lg overflow-hidden">
                        <thead class="bg-gray-50">
                            <tr class="text-left text-gray-600 uppercase text-sm tracking-wider">
                                <th class="px-4 py-3 border-b">ID</th>
                                <th class="px-4 py-3 border-b">Name</th>
                                <th class="px-4 py-3 border-b">Role</th>
                                <th class="px-4 py-3 border-b">Status</th>
                                <th class="px-4 py-3 border-b">
                                    <center>Action</center>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php
                            $i = 0;
                            while ($i < count($user)): ?>
                                <tr class="hover:bg-gray-100">
                                    <td class="px-4 py-3"><?php echo htmlspecialchars($user[$i]["id"]) ?></td>
                                    <td class="px-4 py-3"><?php echo htmlspecialchars($user[$i]["name"]) ?></td>
                                    <td class="px-4 py-3"><?php echo htmlspecialchars($user[$i]["role"]) ?></td>
                                    <td class="px-4 py-3">
                                        <?php if ($user[$i]["status"] == 'active'): ?>
                                            <span class="px-2 py-1 text-xs font-medium text-green-700 bg-green-100 rounded-full">Active</span>
                                        <?php elseif ($user[$i]["status"] == 'suspended'): ?>
                                            <span class="px-2 py-1 text-xs font-medium text-red-700 bg-red-100 rounded-full">Suspended</span>
                                        <?php elseif ($user[$i]["status"] == 'pending'): ?>
                                            <span class="px-2 py-1 text-xs font-medium text-yellow-700 bg-yellow-100 rounded-full">Pending</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="px-4 py-3">
                                        <center>
                                            <div class="relative">
                                                <button><a href="./userActivate.php?id=<?php echo htmlspecialchars($user[$i]["id"]) ?>" class="block px-4 py-2 text-gray-700 rounded-full hover:bg-green-100">Activate</a></button>
                                                <button><a href="./userDeactivate.php?id=<?php echo htmlspecialchars($user[$i]["id"]) ?>" class="block px-4 py-2 text-gray-700 rounded-full hover:bg-yellow-100">Deactivate</a></button>
                                                <button><a href="./userSuspend.php?id=<?php echo htmlspecialchars($user[$i]["id"]) ?>" class="block px-4 py-2 text-gray-700 rounded-full hover:bg-red-100">Suspend</a></button>
                                            </div>
                                        </center>
                                    </td>
                                </tr>
                            <?php
                                $i++;
                            endwhile;
                            ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </section>

    <script src="../src/js/dashboard.js"></script>
</body>

</html>
<?php
require_once '../class/TagsManager.php';
require_once '../class/Tags.php';

session_start();

if (!isset($_SESSION["id"]) || $_SESSION["role"] !== "admin") {
    header("Location: ../login/index.php");
    exit();
}

$TG = new TagsManager();
$tags = $TG->displayAllTags();

if (isset($_POST['submit'])) {
    $name = $_POST["name"];

    $newTag = new Tags($id = null, $name);
    $TG->addTag($newTag);

    header("Location: ./manageTags.php");
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
                    <span class="text">Manage Tags</span>
                </div>

                <div class="activity">
                    <div class="activity-data">
                        <div class="bg-white min-w-full border border-gray-200 shadow-sm rounded-lg overflow-hidden">
                            <h1 class="text-2xl font-bold text-gray-700 mb-4 text-center mt-5">Create a New Tag</h1>
                            <form method="POST" class="flex justify-between items-center p-5">
                                <div class="mb-4">
                                    <label for="name" class="block text-gray-600 font-medium mb-2">Tag Name</label>
                                    <input type="text" id="name" name="name" placeholder="Enter Tag name"
                                        class="w-[800px] px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                        required>
                                </div>
                                <div class="text-center">
                                    <button type="submit" name="submit"
                                        class="bg-blue-500 text-white font-medium mt-3 py-2 px-6 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                        Create Tag
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="activity">
                <div class="title">
                    <span class="text">All Tags</span>
                </div>

                <div class="activity-data">
                    <table class="min-w-full border border-gray-200 shadow-sm rounded-lg overflow-hidden">
                        <thead class="bg-gray-50">
                            <tr class="text-left text-gray-600 uppercase text-sm tracking-wider">
                                <th class="px-4 py-3 border-b">Name</th>
                                <th class="px-4 py-3 border-b">
                                    <center>Action</center>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php
                            foreach ($tags as $tag) {
                                echo $tag->renderRow();
                            }
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
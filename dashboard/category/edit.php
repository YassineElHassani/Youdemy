<?php
require_once '../../class/CategoriesManager.php';
require_once '../../class/Categories.php';

session_start();

if (!isset($_SESSION["id"]) || $_SESSION["role"] !== "admin") {
    header("Location: ../../login/index.php");
    exit();
}

$CT = new CategoriesManager();

if (isset($_GET['id'])) {
    $category = $CT->getCategory($_GET['id']);

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $updateCategory = new Categories((int)$_POST["id"], $_POST["name"]);

        $CT->updateCategory($updateCategory);

        header('Location: ../manageCategories.php');
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../src/css/dashboard.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="shortcut icon" href="../../src/img/ico.png" type="image/x-icon">
    <title>Admin Dashboard</title>
</head>

<body>
    <nav>
        <div class="logo-name">
            <div class="logo-image">
                <img src="../../src/img/logo.jpg" alt="">
            </div>
            <span class="logo_name">Youdemy</span>
        </div>

        <div class="menu-items">
            <ul class="nav-links">
                <li><a href="../index.php">
                        <i class="uil uil-estate"></i>
                        <span class="link-name">Dashboard</span>
                    </a></li>
                <li><a href="../statistics.php">
                        <i class="uil uil-chart"></i>
                        <span class="link-name">Statistics</span>
                    </a></li>
                <li><a href="../manageUsers.php">
                        <i class="uil uil-users-alt"></i>
                        <span class="link-name">Manage Users</span>
                    </a></li>
                <li><a href="../manageCourses.php">
                        <i class="uil uil-files-landscapes"></i>
                        <span class="link-name">Manage Courses</span>
                    </a></li>
                <li><a href="../manageCategories.php">
                        <i class="uil uil-create-dashboard"></i>
                        <span class="link-name">Manage Categories</span>
                    </a></li>
                <li><a href="../manageTags.php">
                        <i class="uil uil-tag"></i>
                        <span class="link-name">Manage Tags</span>
                    </a></li>
            </ul>

            <ul class="logout-mode">
                <li><a href="../../logout.php">
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
        </div>

        <div class="dash-content">
            <div class="overview">
                <div class="title">
                    <i class="uil uil-tachometer-fast-alt"></i>
                    <span class="text">Manage Categories</span>
                </div>

                <div class="activity">
                    <div class="activity-data">
                        <div class="bg-white min-w-full border border-gray-200 shadow-sm rounded-lg overflow-hidden">
                            <h1 class="text-2xl font-bold text-gray-700 mb-4 text-center">Edit Category</h1>
                            <form method="POST" class="flex justify-around items-center">
                                <div class="mb-4">
                                    <input type="hidden" name="id" value="<?= htmlspecialchars($category->getId()); ?>">
                                    <label for="name" class="block text-gray-600 font-medium mb-2">Category Name</label>
                                    <input type="text" id="name" name="name" value="<?= htmlspecialchars($category->getName()); ?>"
                                        class="w-[800px] px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                        required>
                                </div>
                                <div class="text-center">
                                    <button type="submit" name="submit"
                                        class="bg-blue-500 text-white font-medium py-2 px-6 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                        Save Category
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <script>
        const body = document.querySelector("body"),
            modeToggle = body.querySelector(".mode-toggle");
        sidebar = body.querySelector("nav");
        sidebarToggle = body.querySelector(".sidebar-toggle");

        let getMode = localStorage.getItem("mode");
        if (getMode && getMode === "dark") {
            body.classList.toggle("dark");
        }

        let getStatus = localStorage.getItem("status");
        if (getStatus && getStatus === "close") {
            sidebar.classList.toggle("close");
        }

        modeToggle.addEventListener("click", () => {
            body.classList.toggle("dark");
            if (body.classList.contains("dark")) {
                localStorage.setItem("mode", "dark");
            } else {
                localStorage.setItem("mode", "light");
            }
        });

        sidebarToggle.addEventListener("click", () => {
            sidebar.classList.toggle("close");
            if (sidebar.classList.contains("close")) {
                localStorage.setItem("status", "close");
            } else {
                localStorage.setItem("status", "open");
            }
        });
    </script>
</body>

</html>
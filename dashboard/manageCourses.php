<?php
require_once '../class/CoursesManager.php';
require_once '../class/Course.php';

session_start();

if (!isset($_SESSION["id"]) || $_SESSION["role"] !== "admin") {
    header("Location: ../login/index.php");
    exit();
}


$courses = new CoursesManager();
$course = $courses->getAllCourses();


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
    <!-- include libraries(jQuery, bootstrap) -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <!-- include summernote css/js -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.js"></script>
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
                        <span class="link-name">Dashboard</span>
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
                    <span class="text">Manage Courses</span>
                </div>
                <div class="flex justify-between items-center  bg-white min-w-full border border-gray-200 shadow-sm rounded-lg overflow-hidden">
                    <h1 class="ml-5 text-2xl font-bold text-gray-700 mb-4 mt-5">Create a New Course</h1>
                    <button id="addBtn" class="mr-5 bg-blue-500 text-white font-bold py-2 px-6 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"><i class="uil uil-file-edit-alt"></i> Add new course</button>
                </div>
            </div>


            <div class="activity">
                <div class="activity-data">
                    <form method="post" id="form" style="visibility: hidden;" class="bg-white p-6 rounded-lg shadow-lg min-w-full max-w-lg mx-auto space-y-4">
                        <div>
                            <label for="title" class="block text-gray-600 font-medium mb-1">Title</label>
                            <input type="text" name="title" id="title" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Enter the title">
                        </div>
                        <div>
                            <label for="description" class="block text-gray-600 font-medium mb-1">Description</label>
                            <input type="text" name="description" id="description" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Enter a short description">
                        </div>
                        <div>
                            <label for="content" class="block text-gray-600 font-medium mb-1">Content</label>
                            <textarea id="summernote" name="content"
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Write the content"></textarea>
                            <script>
                                $('#summernote').summernote({
                                    placeholder: 'Hello stand alone ui',
                                    tabsize: 2,
                                    height: 120,
                                    toolbar: [
                                        ['style', ['style']],
                                        ['font', ['bold', 'underline', 'clear']],
                                        ['color', ['color']],
                                        ['para', ['ul', 'ol', 'paragraph']],
                                        ['table', ['table']],
                                        ['insert', ['link', 'picture', 'video']],
                                        ['view', ['fullscreen', 'codeview', 'help']]
                                    ]
                                });
                            </script>
                        </div>
                        <div>
                            <label for="categories" class="block text-gray-600 font-medium mb-1">Categories</label>
                            <select name="categories" id="categories"
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="" disabled selected>Select a category</option>

                            </select>
                        </div>
                        <div>
                            <label for="tags" class="block text-gray-600 font-medium mb-1">Tags</label>
                            <select name="tags" id="tags"
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="" disabled selected>Select tags</option>

                            </select>
                        </div>
                        <div class="text-right">
                            <button id="cancel" type="button"
                                class="bg-gray-500 text-white font-medium py-2 px-6 rounded-md hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                                Cancel
                            </button>
                            <button type="submit" name="submit"
                                class="bg-blue-500 text-white font-medium py-2 px-6 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                Submit
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <script src="../src/js/dashboard.js"></script>
</body>

</html>
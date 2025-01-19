<?php
require_once '../../config/connection.php';
require_once '../../class/CoursesManager.php';
require_once '../../class/TagsManager.php';
require_once '../../class/CategoriesManager.php';
require_once __DIR__ . '/../../class/Course.php';

session_start();

if (!isset($_SESSION["id"]) || $_SESSION["role"] !== "teacher") {
    header("Location: ../../login/index.php");
    exit();
}

$userId = $_SESSION["id"];

$coursesManager = new CoursesManager();

if (isset($_GET['id'])) {
    $thisCourse = $coursesManager->getCourse($_GET['id']);

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $updateCourse = new Course((int)$_POST["id"], $_POST["image"], $_POST["title"], $_POST["description"], $_POST["content"], $userId, $_POST["categories"], $_POST["tags"]);

        $coursesManager->updateCourse($updateCourse);

        header('Location: ../manageCourses.php');
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- include libraries(jQuery, bootstrap) -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <!-- include summernote css/js -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.js"></script>
    <!-- include tom-select -->
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.4.1/dist/css/tom-select.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.4.1/dist/js/tom-select.complete.min.js"></script>
    <link rel="stylesheet" href="../../src/css/dashboard.css">
    <link rel="shortcut icon" href="../../src/img/ico.png" type="image/x-icon">
    <title>Teacher Dashboard</title>
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
                <li><a href="../manageCourses.php">
                        <i class="uil uil-files-landscapes"></i>
                        <span class="link-name">Courses</span></a></li>
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
                    <span class="text">Manage Courses</span>
                </div>
                <div class="flex justify-between items-center  bg-white min-w-full border border-gray-200 shadow-sm rounded-lg overflow-hidden">
                    <h1 class="ml-5 text-2xl font-bold text-gray-700 mb-4 mt-5">Edit Course</h1>
                </div>
            </div>


            <div class="activity">
                <div class="activity-data">
                    <form method="post" id="form" enctype="multipart/form-data" class="bg-white p-6 mr-7 mt-8 min-w-full rounded-lg shadow-lg max-w-lg mx-auto space-y-4">
                        <input type="hidden" name="id" value="<?= htmlspecialchars($_GET['id']); ?>">
                        <div>
                            <label for="title" class="block text-gray-600 font-medium mb-1">Title</label>
                            <input type="text" name="title" id="title" required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                value="<?= htmlspecialchars($thisCourse->getTitle()); ?>">
                        </div>
                        <div>
                            <label for="description" class="block text-gray-600 font-medium mb-1">Description</label>
                            <input type="text" name="description" id="description" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                value="<?= htmlspecialchars($thisCourse->getDescription()); ?>">
                        </div>
                        <div>
                            <label for="image" class="block text-gray-600 font-medium mb-1">Course Image</label>
                            <input type="text" name="image" id="image" required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                value="<?= htmlspecialchars($thisCourse->getImage()); ?>">
                        </div>
                        <div>
                            <label for="content" class="block text-gray-600 font-medium mb-1">Content</label>
                            <textarea id="summernote" name="content"
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <?= htmlspecialchars($thisCourse->getContent()); ?>
                            </textarea>
                            <script>
                                $('#summernote').summernote({
                                    placeholder: 'Create the content of the course',
                                    tabsize: 2,
                                    height: 200,
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
                                <?php
                                $categoriesManager = new CategoriesManager();
                                $categories = $categoriesManager->getCategories();

                                foreach ($categories as $category) {
                                    $selected = $thisCourse->getCategoryId() == $category['id'] ? 'selected' : '';
                                    echo "<option value='{$category['id']}' $selected>{$category['name']}</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div>
                            <label for="tags" class="block text-gray-600 font-medium mb-1">Tags</label>
                            <select id="tags" name="tags[]" multiple class="w-full">
                                <?php
                                $tagsManager = new TagsManager();
                                $allTags = $tagsManager->getTags();
                                $selectedTags = $tagsManager->getTagsForCourse($_GET['id']);

                                $selectedTagIds = array_column($selectedTags, 'id');

                                foreach ($allTags as $tag) {
                                    $selected = in_array($tag['id'], $selectedTagIds) ? 'selected' : '';
                                    echo "<option value='{$tag['id']}' $selected>{$tag['name']}</option>";
                                }
                                ?>
                            </select>
                            <script>
                                new TomSelect("#tags", {
                                    create: true,
                                    persist: false,
                                });
                            </script>
                        </div>

                        <div class="text-right">
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
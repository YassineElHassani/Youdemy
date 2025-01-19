<?php
require_once './class/CoursesManager.php';
require_once './class/TagsManager.php';
require_once './class/CategoriesManager.php';
require_once './class/Course.php';

session_start();

$userId = $_SESSION["id"];

if (isset($_GET['id'])) {
    $courseManager = new CoursesManager();
    $thisCourse = $courseManager->getCourse($_GET['id']);

    $categoryManager = new CategoriesManager();
    $category = $categoryManager->getCategory($thisCourse->getCategoryId());
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
    <link rel="stylesheet" href="./src/css/style.css">
    <link rel="shortcut icon" href="./src/img/ico.png" type="image/x-icon">
    <title>Course Details</title>
</head>

<body class="bg-gray-50">
    <nav class="navbar">
        <span class="hamburger-btn material-symbols-rounded">menu</span>
        <a href="/" class="logo">
            <img src="./src/img/logo.jpg" alt="logo">
            <h2>Youdemy</h2>
        </a>
        <ul class="links">
            <li><a href="#">Home</a></li>
            <li><a href="#">Portfolio</a></li>
            <li><a href="#">Courses</a></li>
            <li><a href="#">About us</a></li>
            <li><a href="#">Contact us</a></li>
        </ul>
        <div style="display: flex; align-items: center; gap: 10px;">
            <a href="./login/index.php"><button class="login-btn">LOG IN</button></a>
            <a href="./register/index.php"><button class="login-btn">REGISTER</button></a>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <!-- Course Header -->
        <div class="bg-white shadow overflow-hidden sm:rounded-lg mb-6">
            <div class="px-4 py-5 sm:px-6">
                <h2 class="text-3xl font-bold text-gray-900" id="courseTitle">
                    <?= htmlspecialchars($thisCourse->getTitle()); ?>
                </h2>
                <div class="mt-2 flex items-center text-sm text-gray-500">
                    <span class="mr-4">
                        Category: 
                        <b><?= htmlspecialchars($category->getName()); ?></b>
                    </span>
                    <span>
                        Course By: 
                        <b><?= htmlspecialchars($courseCreator = $courseManager->getCourseCreator($_GET['id'])); ?></b>
                    </span>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Course Content -->
            <div class="lg:col-span-2">
                <!-- Description -->
                <div class="bg-white shadow sm:rounded-lg mb-6">
                    <div class="px-4 py-5 sm:p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Course Description</h3>
                        <p class="text-gray-600">
                            <?= nl2br(htmlspecialchars($thisCourse->getDescription())); ?>
                        </p>
                    </div>
                </div>

                <!-- Content -->
                <div class="bg-white shadow sm:rounded-lg">
                    <div class="px-4 py-5 sm:p-6">
                        <img src="<?= htmlspecialchars($thisCourse->getImage()); ?>" alt="Course Image" class="w-full h-[300px] object-cover rounded-lg mb-4">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Course Content</h3>
                        <div class="prose max-w-none"><?php echo $thisCourse->getContent(); ?></div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <div class="bg-white shadow sm:rounded-lg sticky top-6">
                    <div class="px-4 py-5 sm:p-6">
                        <!-- Tags -->
                        <div class="mb-6">
                            <h4 class="text-sm font-medium text-gray-900 mb-2">Tags</h4>
                            <div class="flex flex-wrap gap-2">
                                <?php
                                $tagsManager = new TagsManager();
                                $selectedTags = $tagsManager->getTagsForCourse($_GET['id']);

                                $selectedTagIds = array_column($selectedTags, 'id');

                                foreach ($selectedTags as $tag) {
                                    $selected = in_array($tag['id'], $selectedTagIds) ? 'selected' : '';
                                    echo "<span class='px-3 py-1 bg-gray-200 text-sm font-medium rounded' value='{$tag['id']}' $selected>{$tag['name']}</span>";
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>

</html>
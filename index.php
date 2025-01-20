<?php
require_once './class/CoursesManager.php';

$coursesManager = new CoursesManager();
$courses = $coursesManager->getAllCourses();



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Youdemy | Home</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,400,0,0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="./src/css/style.css">
    <script src="./src/js/main.js" defer></script>
</head>

<body>
    <header>
        <nav class="navbar">
            <span class="hamburger-btn material-symbols-rounded">menu</span>
            <a href="/" class="logo">
                <img src="./src/img/logo.png" height="150px" alt="logo">
                <h2>Youdemy</h2>
            </a>
            <ul class="links">
                <li><a href="#">Courses</a></li>
                <li><a href="#">About us</a></li>
                <li><a href="#">Contact us</a></li>
            </ul>
            <div style="display: flex; align-items: center; gap: 10px;">
                <a href="./login/index.php"><button class="login-btn">LOG IN</button></a>
                <a href="./register/index.php"><button class="login-btn">REGISTER</button></a>
            </div>
        </nav>
    </header>

    <main>

    </main>

    <section class="container mx-auto py-12 px-6 mt-[500px]">
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-3xl font-extrabold text-slate-100">Browse Courses</h2>
            <div class="relative">
                <input
                    type="text"
                    placeholder="Search courses..."
                    class="w-64 px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none" />
                <button
                    class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-blue-500 text-white px-4 py-1 rounded-md hover:bg-blue-600">
                    Search
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php foreach ($courses as $oneCourse): ?>
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <img src="<?= htmlspecialchars($oneCourse['image']); ?>" alt="Course Image" class="w-full h-56 object-cover">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-2"><?= htmlspecialchars($oneCourse['title']); ?></h3>
                        <p class="text-gray-600 mb-4 line-clamp-3"><?= htmlspecialchars($oneCourse['description']); ?></p>
                        <div class="flex justify-between items-center">
                            <a
                                href="../course.php?id=<?= htmlspecialchars($oneCourse['id']); ?>"
                                class="text-sm font-medium text-white bg-blue-500 px-4 py-2 rounded-lg hover:bg-blue-600">
                                Subscription
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

</body>

</html>
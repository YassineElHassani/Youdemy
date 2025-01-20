<?php
require_once './class/CoursesManager.php';

session_start();

if (!isset($_SESSION["id"]) || $_SESSION["role"] !== "student") {
    header("Location: ../login/index.php");
    exit();
}

$userId = $_SESSION["id"];

$coursesManager = new CoursesManager();
$subscribedCourses = $coursesManager->getCoursesBySubs($userId);

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
    <title>My Courses</title>
</head>

<body>
    <nav class="navbar">
        <span class="hamburger-btn material-symbols-rounded">menu</span>
        <a href="/" class="logo">
            <img src="./src/img/logo.png" alt="logo">
            <h2>Youdemy</h2>
        </a>
        <ul class="links">
            <li><a href="./home.php">Courses</a></li>
            <li><a href="#">About us</a></li>
            <li><a href="#">Contact us</a></li>
        </ul>
        <div style="display: flex; align-items: center; gap: 10px;">
            <a href="./logout.php"><img src="./src/img/logout.png" height="25px" width="25px" alt="Logout"></a>
        </div>
    </nav>

    <div class="container mx-auto p-4 mt-8">
        <h1 class="text-2xl font-bold mb-4 text-salt-100">My Courses</h1>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php
            if (!empty($subscribedCourses)) {
                foreach ($subscribedCourses as $course) {
            ?>
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                        <img src="<?= htmlspecialchars($course['course_image']); ?>" alt="Course Image" class="w-full h-48 object-cover">
                        <div class="p-4">
                            <h2 class="text-lg font-semibold text-gray-800 mb-2"><?= htmlspecialchars($course['course_title']); ?></h2>
                            <p class="text-gray-600 mb-4 line-clamp-3"><?= htmlspecialchars($course['course_description']); ?></p>
                            <a href="../course.php?id=<?= htmlspecialchars($course['course_id']); ?>" class="text-blue-500 hover:underline">View Course</a>
                        </div>
                    </div>
            <?php
                }
            } else {
                echo "<p class='text-gray-500'>You haven't subscribed to any courses yet.</p>";
            }
            ?>
        </div>
    </div>
</body>

</html>
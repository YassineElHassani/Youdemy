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

<?php
include_once './layout/userHeader.php';
?>

<div class="container mx-auto p-4 mt-8">
    <div class="flex justify-between items-center mb-8">
        <h2 class="text-3xl font-extrabold text-slate-100">My Courses</h2>
    </div>
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

<?php
include_once './layout/footer.php';
?>
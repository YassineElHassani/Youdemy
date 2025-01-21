<?php
require_once './class/CoursesManager.php';

$coursesManager = new CoursesManager();
$courses = $coursesManager->getAllCourses();

$limit = 6;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$page = max(1, $page);
$offset = ($page - 1) * $limit;

$paginationData = $coursesManager->getCoursesWithPagination($limit, $offset);
$courses = $paginationData['courses'];
$totalCourses = $paginationData['totalCourses'];

$totalPages = ceil($totalCourses / $limit);


?>

<?php
include_once './layout/header.php';
?>

<div style="display: flex; align-items: center; justify-content: space-around;">
    <div class="content">
        <h1><b>Start your learning path</b></h1>
        <p>Develop a passion for learning. if you do, you will never cease to grow.</p>
        <a href="./register/index.php" class="btn">Start Now</a>
    </div>
    <div>
        <img src="./src/img/image.png" class="feature-img">
    </div>
</div>

<div class="absolute mt-[335px] ml-[37%]">
    <center><input type="text" placeholder="Search courses..." class="w-[500px] px-4 py-2 border border-gray-300 rounded-full focus:ring-2 focus:ring-gray-500 focus:outline-none" />
        <button class="absolute right-2 top-1/2 transform -translate-y-1/2">
            <img src="./src/img/glass.png" height="35px" width="35px">
        </button>
    </center>
</div>

<section class="container mx-auto w-[100%] py-12 px-6 mt-[39vh] bg-[#3d3d3d]">
    <div class="flex justify-between items-center mb-8">
        <h2 class="text-3xl font-extrabold text-slate-100">Browse Courses</h2>
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
                            href="./login/index.php"
                            class="text-sm font-medium text-white bg-blue-500 px-4 py-2 rounded-lg hover:bg-blue-600">
                            Subscription
                        </a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="mt-8 flex justify-center space-x-2">
        <?php if ($page > 1): ?>
            <a href="?page=<?= $page - 1; ?>" class="px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300">Previous</a>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <a href="?page=<?= $i; ?>" class="px-4 py-2 <?= $i === $page ? 'bg-gray-500 text-white' : 'bg-gray-200 text-gray-800'; ?> rounded hover:bg-gray-600 hover:text-white">
                <?= $i; ?>
            </a>
        <?php endfor; ?>

        <?php if ($page < $totalPages): ?>
            <a href="?page=<?= $page + 1; ?>" class="px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300">Next</a>
        <?php endif; ?>
    </div>

</section>



<?php
include_once './layout/footer.php';
?>
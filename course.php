<?php
require_once './class/CoursesManager.php';
require_once './class/TagsManager.php';
require_once './class/CategoriesManager.php';
require_once './class/Course.php';

session_start();

$userId = $_SESSION["id"];

if (!isset($_SESSION['id'])) {
    header("Location: login/index.php");
    exit();
}

if (isset($_GET['id'])) {
    $courseManager = new CoursesManager();
    $thisCourse = $courseManager->getCourse($_GET['id']);

    $categoryManager = new CategoriesManager();
    $category = $categoryManager->getCategory($thisCourse->getCategoryId());
}
?>

<?php
include_once './layout/userHeader.php';
?>

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
        <div class="lg:col-span-2">
            <div class="bg-white shadow sm:rounded-lg mb-6">
                <div class="px-4 py-5 sm:p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Course Description</h3>
                    <p class="text-gray-600">
                        <?= nl2br(htmlspecialchars($thisCourse->getDescription())); ?>
                    </p>
                </div>
            </div>
        </div>

        <div class="lg:col-span-1">
            <div class="bg-white shadow sm:rounded-lg top-6">
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

    <div class="bg-white shadow sm:rounded-lg">
        <div class="px-4 py-5 sm:p-6">
            <img src="<?= htmlspecialchars($thisCourse->getImage()); ?>" alt="Course Image" class="w-full h-[500px] object-cover rounded-lg mb-4">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Course Content</h3>
            <div class="prose overflow-hidden"><?php echo $thisCourse->getContent(); ?></div>
        </div>
    </div>
</main>

<?php
include_once './layout/footer.php';
?>
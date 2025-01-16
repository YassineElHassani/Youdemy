<?php 
require_once '../config/connection.php';
require_once './Course.php';

class CoursesManager {
    public function displayCourses() {
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM courses");
        $stmt->execute();
        $courses = $stmt->fetchAll();
        $data = [];
        foreach ($courses as $course) {
            $data[] = new Course($course['id'], $course['title'], $course['description'], $course['content'], $course['user_id'], $course['category_id']);
        }
        return $data;
    }

    public function addCourse(Course $course) {
        $conn = Database::getConnection();
        $stmt = $conn->prepare("INSERT INTO course(title, description, content, user_id, category_id) VALUES(:title, :description, :content, :user_id, :category_id)");
        $stmt->execute([
            ':title' => $course->getTitle(),
            ':description' => $course->getDescription(),
            ':content' => $course->getContent(),
            ':user_id' => $course->getUserId(),
            ':category_id' => $course->getCategoryId()
        ]);
    }

    public function deleteCourse($id) {
        $conn = Database::getConnection();
        $stmt = $conn->prepare("DELETE FROM courses WHERE id = :id");
        $stmt->execute([
            ':id' => $id
        ]);
    }

    public function getCourse($id) {
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM courses WHERE id = :id");
        $stmt->execute([
            ':id' => $id
        ]);
        $course = $stmt->fetchAll();
        return new Course($course['id'], $course['title'], $course['description'], $course['content'], $course['user_id'], $course['category_id']);
    }

    public function getAllCourses() {
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM courses");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateCourse(Course $course) {
        $conn = Database::getConnection();
        $stmt = $conn->prepare("UPDATE courses SET title = :title, description = :description, content = :content, user_id = :user_id, category_id = :category_id");
        $stmt->execute([
            ':title' => $course->getTitle(),
            ':description' => $course->getDescription(),
            ':content' => $course->getDescription(),
            ':user_id' => $course->getUserId(), 
            ':category_id' => $course->getCategoryId()
        ]);
    }
}

?>
<?php
require_once '../config/connection.php';
require_once __DIR__ . '/Users.php';

class Teacher extends Users {

    public function totalSubscribers($userId) {
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT COUNT(subscription.id) AS total_subscribers FROM subscription INNER JOIN courses ON subscription.course_id = courses.id WHERE courses.user_id = :teacher_id;");
        $stmt->execute([
            ':teacher_id' => $userId
        ]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total_subscribers'] ?? 0;
    }

    public function totalCourses($userId) {
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT COUNT(*) AS total_courses FROM courses WHERE user_id = :user_id");
        $stmt->execute([
            ':user_id' => $userId
        ]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total_courses'] ?? 0;
    }

    public function allCourses($userId) {
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM courses WHERE user_id = :user_id");
        $stmt->execute([
            ':user_id' => $userId
        ]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
}

<?php 
require_once __DIR__ . '/../config/connection.php';
require_once __DIR__ . '/Users.php';

class Student extends Users {
    public function subscribeToCourse($userId, $id) {
        $conn = Database::getConnection();
    
        $stmt = $conn->prepare("SELECT COUNT(*) FROM subscription WHERE user_id = :user_id AND course_id = :course_id");
        $stmt->execute([
            ':user_id' => $userId,
            ':course_id' => $id
        ]);
        $isSubscribed = $stmt->fetchColumn();
    
        if ($isSubscribed) {
            return ['success' => false];
        }
    
        $stmt = $conn->prepare("INSERT INTO subscription (user_id, course_id) VALUES (:user_id, :course_id)");
        $stmt->execute([
            ':user_id' => $userId,
            ':course_id' => $id
        ]);
    
        return ['success' => true];
    }

    public function getCoursesBySubs($userId) {
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT courses.id AS course_id, courses.image AS course_image, courses.title AS course_title, courses.description AS course_description
            FROM subscription INNER JOIN courses ON subscription.course_id = courses.id
            WHERE subscription.user_id = :user_id;
        ");
        $stmt->execute([':user_id' => $userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}


?>
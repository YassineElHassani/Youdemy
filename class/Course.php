<?php

require_once '../config/connection.php';

class Course {
    public $id;
    public $title;
    public $description;
    public $content;
    public $user_id;
    public $category_id;

    public function __construct($id, $title, $description, $content, $user_id, $category_id) {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->content = $content;
        $this->user_id = $user_id;
        $this->category_id = $category_id;
    }

    public function getId() {
        return $this->id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getContent() {
        return $this->content;
    }

    public function getUserId() {
        return $this->user_id;
    }

    public function getCategoryId() {
        return $this->category_id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function setDescription($description) {
        $this-> description = $description;
    }

    public function setUserId($user_id) {
        $this->user_id = $user_id;
    }

    public function setCategoryId($category_id) {
        $this->category_id = $category_id;
    }

    public function tableRow() {
        $title = htmlspecialchars($this->title);
        $description = htmlspecialchars($this->description);
        $content = htmlspecialchars($this->content);
        $user_name = htmlspecialchars($this->user_id);
        $categories = htmlspecialchars($this->category_id);

        return "
        <tr>
            <td>$title</td>
            <td>$description</td>
            <td>$content</td>
            <td>$user_name</td>
            <td>$categories</td>
            <td>
                <a class='badge-pending' href='../dashboard/courseEdit.php?id=$this->id'>Edit</a>
                <a class='badge-trashed' href='../dashboard/courseDelete.php?id=$this->id'>Delete</a>
            </td>
        </tr>
        ";
    }
}


?>
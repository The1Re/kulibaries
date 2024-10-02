<?php
require_once('models/author.php');

class AuthorController {
    public function index() {
        $authors = Author::getAll();
        require('views/author/index.php');
    }

    public function add() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $biography = $_POST['biography'];
            Author::add($name);
            header('Location: index.php?controller=author&action=index');
        } else {
            require('views/author/add.php');
        }
    }

    public function edit() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $biography = $_POST['biography'];
            Author::update($id, $name);
            header('Location: index.php?controller=author&action=index');
        } else {
            $id = $_GET['id'];
            $author = Author::getById($id);
            require('views/author/edit.php');
        }
    }

    public function delete() {
        $id = $_GET['id'];
        Author::delete($id);
        header('Location: index.php?controller=author&action=index');
    }
}
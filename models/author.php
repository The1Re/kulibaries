<?php
require_once('util/database.php');

class Author {
    public $id;
    public $name;

    public function __construct($id, $name) {
        $this->id = $id;
        $this->name = $name;
    }

    public static function getAll() {
        $list = [];
        $db = Database::connect();
        $req = $db->query('SELECT * FROM Authors');

        foreach($req->fetch_all(MYSQLI_ASSOC) as $author) {
            $list[] = new Author($author['id'], $author['name']);
        }

        return $list;
    }

    public static function getById($id) {
        $db = Database::connect();
        $req = $db->prepare('SELECT * FROM Authors WHERE id = ?');
        $req->bind_param('i', $id);
        $req->execute();
        $result = $req->get_result()->fetch_assoc();
        return new Author($result['id'], $result['name']);
    }

    public static function add($name) {
        $db = Database::connect();
        $req = $db->prepare('INSERT INTO Authors (name) VALUES (?)');
        $req->bind_param('ss', $name);
        $req->execute();
    }

    public static function update($id, $name) {
        $db = Database::connect();
        $req = $db->prepare('UPDATE Authors SET name = ? WHERE id = ?');
        $req->bind_param('ssi', $name, $id);
        $req->execute();
    }

    public static function delete($id) {
        $db = Database::connect();
        $req = $db->prepare('DELETE FROM Authors WHERE id = ?');
        $req->bind_param('i', $id);
        $req->execute();
    }
}
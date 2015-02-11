<?php namespace Amelia\Blog;

use PDO;

class Post extends Model {

    protected $table = "posts";

    /**
     * Insert a new post
     *
     * @param array $attributes
     */
    public function insert(array $attributes) {
        $this->prepare(
            "insert into `{$this->table}` (title, body) VALUES (:title, :body)",
            [
                ":title" => $attributes["title"],
                ":body"  => $attributes["body"],
            ]
        );
    }

    /**
     * Edit a blog post
     *
     * @param       $id
     * @param array $attributes
     */
    public function update($id, array $attributes) {
        $query = $this->pdo->prepare("update `{$this->table}` set title = :title, body = :body where id = :id");

        $query->bindParam(":id", $id, PDO::PARAM_INT);
        $query->bindParam(":title", $attributes["title"]);
        $query->bindParam(":body", $attributes["body"]);

        $query->execute();
    }

    /**
     * Get the last n posts
     *
     * @return array
     */
    public function getLatest($limit = 5) {
        // note: limit is not a data binding in PDO
        return $this->prepare("select * from `{$this->table}` order by `id` desc limit {$limit}", []);
    }

    /**
     * Get all posts
     *
     * @return array
     */
    public function getAll() {
        return $this->prepare("select * from `{$this->table}` order by `id` desc", []);
    }
}
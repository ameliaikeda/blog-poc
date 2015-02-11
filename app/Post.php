<?php namespace Amelia\Blog;

class Post extends Model {

    protected $table = "posts";

    /**
     * Insert a new post
     *
     * @param array $attributes
     */
    public function insert(array $attributes) {
        $this->prepare(
            "insert into {$this->table} (title, body) VALUES (:title, :body)",
            [
                ":title" => $attributes["title"],
                ":body"  => $attributes["body"],
            ]
        );
    }

    public function update($id, array $attributes) {
        $this->prepare(
            "update {$this->table} set title = :title, body = :body where id = :id",
            [
                ":id" => $id,
                ":title" => $attributes["title"],
                ":body" => $attributes["body"],
            ]
        );
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
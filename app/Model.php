<?php namespace Amelia\Blog;

use Exception;
use PDO;

abstract class Model {

    protected $table;

    /**
     * Inject the in-use PDO instance
     *
     * @param \PDO $instance
     */
    public function __construct(PDO $instance) {
        $this->pdo = $instance;

        if (is_null($this->table))
            throw new Exception(get_class($this) . ": Models should have a \$table attribute");
    }

    /**
     * Slightly more flexible getByX, but $attributeName
     * should never be user input because I'm literally
     * just injecting it here (normally i'd use a lib/eloquent)
     *
     * @param string     $attributeName
     * @param string|int $attribute
     *
     * @return array
     */
    public function getByAttribute($attributeName, $attribute) {
        return $this->prepare(
            "select * from `{$this->table}` where `{$attributeName}` = :attribute",
            [":attribute" => $attribute]
        );
    }

    /**
     * Get a model by ID
     *
     * @param int $id
     *
     * @return array
     */
    public function getById($id) {
        return $this->getByAttribute("id", $id);
    }

    /**
     * Prepare a statement with correct bindings.
     *
     * @param string $sql
     * @param array  $bindings
     *
     * @return array
     */
    protected function prepare($sql, array $bindings) {
        $query = $this->pdo->prepare($sql);

        // would normally split this into 3 methods, but I can refactor later
        foreach ($bindings as $name => $value) {
            if (is_int($name))
                $name++; // pdo indices are 1-indexed

            switch (gettype($value)) {
                case "string":
                    $query->bindValue($name, $value, PDO::PARAM_STR);
                    break;
                case "integer":
                case "double":
                    $query->bindValue($name, $value, PDO::PARAM_INT);
                    break;
                case "boolean":
                    $query->bindValue($name, $value, PDO::PARAM_BOOL);
                    break;
                default:
                    throw new Exception(get_class($this) . ": Not handling data type (" . gettype($value) .")");
            }
        }
        $query->execute();
        return $query->fetchAll();
    }

    /**
     * Delete a post
     *
     * @param int $id
     */
    public function delete($id) {
        $this->prepare("delete from `{$this->table}` where id = :id", [":id" => $id]);
    }
}

<?php
declare(strict_types = 1);
include __DIR__.'/DB.php';

/**
 * Class Model
 */
abstract class Model
{
    /**
     * @var
     */
    protected $table;
    /**
     * @var PDO
     */
    protected $connection;

    /**
     * Model constructor.
     */
    public function __construct()
    {
        $this->connection = (new DB())->getConnection();
    }

    /**
     * @param int $id
     */
    abstract protected function fillObject(int $id): void;

    /**
     * @return bool
     */
    abstract public function save(): bool;
    /**
     * @param int $id
     * @return array
     * @throws Exception
     */
    public function getById(int $id): array {
        $sql = "SELECT * FROM ".$this->table." WHERE id = :id";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(":id", $id);
        $stmt->execute();
        $result = $stmt->fetch();
        if (empty($result)) {
            throw new Exception(
                'Model not found with id = '. $id,
                404
            );
        }
        return $result;
    }
}
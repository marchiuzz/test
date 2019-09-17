<?php
declare(strict_types=1);

include_once __DIR__ . '/Model.php';

/**
 * Class WaitingClient
 */
class Visitor extends Model
{
    /**
     * @var string
     */
    protected $table = "visitors";

    /**
     * @var
     */
    private $id;
    /**
     * @var
     */
    private $name;
    /**
     * @var
     */
    private $timeStarted;

    /**
     * WaitingClient constructor.
     * @param int|null $id
     */
    public function __construct(?int $id = null)
    {
        parent::__construct();
        if ($id !== null) {
            $this->fillObject($id);
        }
    }

    /**
     * @param int $id
     * @throws Exception
     */
    protected function fillObject(int $id): void
    {
        $data = $this->getById($id);
        $this->setId($data['id']);
        $this->setName($data['name']);
        $this->setTimeStarted($data['time_started']);
    }


    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     * @return Visitor
     */
    public function setId(?int $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Visitor
     */
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTimeStarted()
    {
        return $this->timeStarted;
    }

    /**
     * @param $timeStarted
     */
    public function setTimeStarted($timeStarted): void
    {
        $this->timeStarted = $timeStarted;
    }

    /**
     * @return bool
     */
    public function save(): bool
    {
        $sql = "INSERT INTO " . $this->table . " SET name = :name, time_started = :timeStarted";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(":name", $this->name);
        $stmt->bindValue(":timeStarted", $this->timeStarted);

        try {
            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $exception) {
            echo $exception->getMessage();
            return false;
        }

    }

    /**
     * @param string $limit
     * @param string $orderBy
     * @return array
     */
    public function GetAllWaitingClients($limit = "3", $orderBy = "ORDER BY `id` ASC"): array
    {
        $sql = "SELECT * FROM " . $this->table . " " . $orderBy . " LIMIT " . $limit;
        $stmt = $this->connection->prepare($sql);
        try {
            if ($stmt->execute()) {
                $results = $stmt->fetchAll();
            } else {
                $results = $stmt->fetchAll();
            }
        } catch (Exception $exception) {
            echo $exception->getMessage();
            return [];
        }

        return $results;
    }

    /**
     * @return bool
     */
    public function destroy(): bool
    {
        $sql = "DELETE FROM " . $this->table . " WHERE id = :id LIMIT 1";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(":id", $this->id);

        try {
            if($stmt->execute()){
                return true;
            } else {
                return false;
            }
        } catch (Exception $exception){
            echo $exception->getMessage();
            return false;
        }
    }


}
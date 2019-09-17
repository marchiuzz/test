<?php
declare(strict_types=1);

include_once __DIR__.'/Model.php';

class WaitingClient extends Model
{
    protected $table = "waiting_clients";

    private $id;
    private $name;
    private $timeStarted;

    public function __construct(?int $id = null)
    {
        parent::__construct();
        if ($id !== null) {
            $this->fillObject($id);        }
    }

    protected function fillObject(int $id): void
    {
        $data = $this->getById($id);
        $this->setId($data['id']);
        $this->setName($data['name']);
        $this->setTimeStarted($data['time_started']);
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getTimeStarted()
    {
        return $this->timeStarted;
    }

    public function setTimeStarted($timeStarted): void
    {
        $this->timeStarted = $timeStarted;
    }

    public function save(): bool
    {
        $sql = "INSERT INTO ".$this->table." SET name = :name, time_started = :timeStarted";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(":name", $this->name);
        $stmt->bindValue(":timeStarted", $this->timeStarted);

        try {
            if($stmt->execute()){
                return true;
            } else {
                return false;
            }
        } catch (Exception $exception){
            echo $exception->getMessage();
        }

    }

    public function GetAllWaitingClients($orderBy = "ORDER BY `id` ASC", $limit = "LIMIT 3") : array
    {
        $sql = "SELECT * FROM ".$this->table." ".$orderBy." ".$limit;
        $db = new DB();
        $stmt = $db->getConnection()->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll();

        return $results;
    }







}
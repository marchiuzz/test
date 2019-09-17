<?php
declare(strict_types = 1);

/**
 * Class DB
 */
class DB
{
    /**
     * @var string
     */
    private $host = 'localhost';
    /**
     * @var int
     */
    private $port = 3306;
    /**
     * @var string
     */
    private $dbName = 'ticketing';
    /**
     * @var string
     */
    private $user = 'root';
    /**
     * @var string
     */
    private $password = '';
    /**
     * @var null
     */
    private $conn = null;
    /**
     * DB constructor.
     */
    public function __construct()
    {
        $this->makeConnection();
    }

    /**
     *
     */
    private function makeConnection(): void
    {
        $dsn = "mysql:host=$this->host;port=$this->port;dbname=$this->dbName;charset=utf8";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];
        try {
            $this->conn = new PDO(
                $dsn,
                $this->user,
                $this->password,
                $options
            );
        } catch (PDOException $exception) {
            throw new PDOException($exception->getMessage(), $exception->getCode());
        }
    }

    /**
     * @return PDO
     */
    public function getConnection(): PDO
    {
        return $this->conn;
    }
}
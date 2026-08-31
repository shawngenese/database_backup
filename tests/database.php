<?php 

$config = [
    "database" => [
        "dbname" => "genese_db",
        "port" => 3306,
        "host" => "localhost"
    ],
    "username" => "root",
    "password" => ""
];

$db = new Database($config["database"],$config["username"], $config["password"]);

$statement = $db->query("SELECT * FROM enrollments");
$statement->execute();
$data = $statement->fetchAll();

echo "<pre>";
var_dump($data);
echo "</pre>";
class Database {
    public $connection;

    public function __construct($datastring, $username, $password)
    {

        $dsn = "mysql:" . http_build_query($datastring, "", ';');
        try {
            $this->connection = new PDO($dsn, $username, $password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false
            ]);
        } catch (PDOException $e) {
            echo "Connection Error: " . $e->getMessage();
        }
        
    } 

    public function query($query, $params = []) {
        $statement = $this->connection->prepare($query);
        $statement->execute($params);
        return $statement;
    }
}

<?php
require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

class DBHandler {
    public function __construct()
    {
        $this->conn = mysqli_connect(
            getenv('DB_HOST'),
            getenv('DB_USER_NAME'),
            getenv('DB_PASSWORD'),
            getenv('DB_NAME')
        );
    }

    public function executeQuery($query)
    {
        $result = mysqli_query($this->conn, $query);
        while ($row=mysqli_fetch_assoc($result)) {
            $resultset[] = $row;
        }
        if (!empty($resultset)) {
            return $resultset;
        }
    }
}
?>

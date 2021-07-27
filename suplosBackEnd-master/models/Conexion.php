<?php
// clase conexion que permite conectar a la base de datos
class Conexion {

    private static $instancia;
    private $dbh;
    // datos de la conexion
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $dataBase = "intelcost_bienes";

    private function __construct() {
        try {
            $this->dbh = new PDO("mysql:host={$this->host};dbname={$this->dataBase}", $this->username, $this->password);
            $this->dbh->exec("SET CHARACTER SET utf8");
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);
            $this->dbh->exec('SET NAMES "utf8"');
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage();
            die();
        }
    }

    public static function singleton() {
        if (!isset(self::$instancia)) {
            $miClase = __CLASS__;
            self::$instancia = new $miClase;
        }
        return self::$instancia;
    }

    public function query($consulta) {
        return $this->dbh->query($consulta);
    }

    public function prepare($consulta) {
        return $this->dbh->prepare($consulta);
    }

    public function beginTransaction() {
        $this->dbh->beginTransaction();
    }

    public function commit() {
        return $this->dbh->commit();
    }

    public function rollBack() {
        return $this->dbh->rollBack();
    }

    public function lastInsertId() {
        return $this->dbh->lastInsertId();
    }

}

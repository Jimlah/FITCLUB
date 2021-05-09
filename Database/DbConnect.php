<?php

class DbConnect
{

    /**
     * database name
     *
     * @var string
     */
    protected $dbName = 'fitclub';

    /**
     * database Host
     *
     * @var string
     */
    protected $dbHost = 'localhost';

    /**
     * database username
     *
     * @var string
     */
    protected $dbUser = 'root';

    /**
     * database Password
     *
     * @var string
     */
    protected $dbPass = '';

    /**
     * database connection Handler
     *
     * @var mixed
     */
    protected $dbHandler, $dbStmt;

    /**
     * Creates or resumes a database connection
     *
     * @return void
     */
    public function __construct()
    {

        $Dsn = "mysql:host=" . $this->dbHost . ';dbname=' . $this->dbName;


        $Options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );

        try {
            $this->dbHandler = new PDO($Dsn, $this->dbUser, $this->dbPass, $Options);
        } catch (Exception $e) {
            echo 'Couldn\'t Establish A Database Connection. Due to the following reason: ' . $e->getMessage();
            die();
        }
    }

    /**
     * create an sql query
     *
     * @param  mixed $query
     * @return void
     */
    public function query($query)
    {
        $this->dbStmt = $this->dbHandler->prepare($query);
    }

    /**
     * binds the correct datatype to the PDO Statement
     *
     * @param  mixed $param
     * @param  mixed $value
     * @param  mixed $type
     * @return void
     */
    public function bind($param, $value, $type = null)
    {
        if (is_null($type)) {
            switch (true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
                    break;
            }
        }
        $this->dbStmt->bindValue($param, $value, $type);
    }

    /**
     * executes a pdo statement or query
     *
     * @return bool
     */
    public function execute()
    {
        $this->dbStmt->execute();
        return true;
    }

    /**
     * Executes a PDO Statement Object an returns a
     * single database record as an associative array
     *
     * @return array
     */
    public function fetch()
    {
        $this->execute();
        return $this->dbStmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Executes a PDO Statement Object an returns 
     * nultiple database record as an associative array
     *
     * @return void
     */
    public function fetchAll()
    {
        $this->execute();
        return $this->dbStmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

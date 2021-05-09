<?php

require_once( 'DbConnect.php');

class Db extends DbConnect
{   

    protected $sqlStmt;

    protected $table = 'user';

    public function createEntry($table, $parameter)
    {
        $param = array_keys($parameter);
        $param_column = implode(", ", $param);

        $params = array_map([$this, "col"], $param);
        $param_value = implode(", ", $params);


        $this->sqlStmt = "INSERT INTO $table ($param_column) VALUES ($param_value)";
        $this->query($this->sqlStmt);
        $this->binder($parameter);
        $this->execute();
        return $this->dbHandler->lastInsertId();

    }

    private function binder($value)
    {
        foreach ($value as $key => $value) {
            $this->bind(":$key", $value);
        }
    }
    
    /**
     * returns the just run sql statement
     *
     * @return void
     */
    public function getSql()
    {
        return $this->sqlStmt;
    }
    
    /**
     * returns all input in the database
     *
     * @param  mixed $table
     * @return void
     */
    public function all($table)
    {
        $this->sqlStmt = "SELECT * FROM $table";
        $this->query($this->sqlStmt);
        $this->execute();
        $query = $this->fetchAll();
        
        if ($query) {
            return $query;
        }
        return [];
    }

    public function querySql($sql)
    {
        $this->sqlStmt = $sql;
        $this->query($this->sqlStmt);
        $this->execute();
        $query = $this->fetch();
        if ($query) {
            return $query;
        }
        return [];
    }

    private function col($v)
    {
        return ":$v";
    }

    public function querySqlAll($sql)
    {
        $this->sqlStmt = $sql;
        $this->query($this->sqlStmt);
        $this->execute();
        $query = $this->fetchAll();
        if ($query) {
            return $query;
        }
        return [];
    }

    public function updateQuery($table, $id, $params)
    {
        $this->sqlStmt = "UPDATE $table SET ";

        $column = [];
        foreach ($params as $key => $value) {
            $column[] = "$key = :$key";
        }
        $column = implode(", ", $column);

        $this->sqlStmt .= "$column WHERE id = '$id'";
        $this->query($this->sqlStmt);
        $this->binder($params);
        $this->execute();
        return $this->dbHandler->lastInsertId();
    }

    public function deleteQuery($table, $id)
    {
        $this->sqlStmt = "DELETE FROM $table WHERE id = '$id'";
        $this->query($this->sqlStmt);
        $this->execute();
        return true;
    }
}

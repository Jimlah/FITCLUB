<?php

require_once(__DIR__ . './../Database/Db.php');

class Model
{
    /**
     * database connection
     *
     * @var mixed
     */
    public static $db;

    protected static $table = '';

    public static $sql = '';

    private $_propeties;

    public $test;

    public function __construct($id)
    {

    }

    /**
     * getDbInstnace
     *
     * @return object
     */
    private static function getDbInstnace()
    {
        return new Db();
    }

    /**
     * create a new entry using the model table name
     *
     * @param  mixed $values
     * @return object
     */
    public static function create($values = [])
    {

        $data = SELF::getDbInstnace()
            ->createEntry(static::$table, $values);

        return $data;
    }

    /**
     * find by primary key and return query
     *
     * @param  int $id
     * @return array|null
     */
    public static function find($id)
    {
        self::$sql = " SELECT * FROM " .  static::$table . " WHERE `id` = '$id'";
        $data = self::getDbInstnace()
            ->querySql(self::$sql);
        return $data;
    }

    public static function all()
    {
        self::$sql = " SELECT * FROM " .  static::$table;

        $data = self::getDbInstnace()
            ->querySqlAll(self::$sql);
        return $data;
    }

    public function setTable($table)
    {
        static::$table = $table;
    }


    /**
     * Select from table using condition
     *
     * @param  mixed $condition condition al statement
     * @return void
     */
    public static function where($condition)
    {
        self::$sql = "SELECT * FROM " .  static::$table . " WHERE " . $condition; 
        // return self::$sql;
        return self::getDbInstnace()
            ->querySqlAll(self::$sql);
    }

    /**
     * Update table with primary key 
     *
     * @param  int $id
     * @param  array $params
     * @return void
     */
    public static function update($id, $params)
    {
        return SELF::getDbInstnace()
            ->updateQuery(static::$table, $id, $params);
    }

    /**
     * delete from table with primary condition
     *
     * @param  int $id
     * @param  array $params
     * @return void
     */
    public static function delete($id)
    {
        return SELF::getDbInstnace()
            ->deleteQuery(static::$table, $id);
    }
}

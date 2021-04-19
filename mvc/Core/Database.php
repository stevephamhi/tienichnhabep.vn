<?php

class Database
{

    // const DB_HOST = "localhost";
    // const DB_USER = "root";
    // const DB_PASS = "";
    // const DB_NAME = "sucsongt_tienichnhabep";

    const DB_HOST = "localhost";
    const DB_USER = "sucsongt_capri20";
    const DB_PASS = "capriadmin123";
    const DB_NAME = "sucsongt_tienichnhabep";

    private $conn;

    public function __construct()
    {
        $this->connection();
    }

    /**
     * Connect to database
     */
    public function connection()
    {
        $this->conn = new mysqli(self::DB_HOST, self::DB_USER, self::DB_PASS, self::DB_NAME);
        if ($this->conn->connect_error) {
            die("Connect to db unsuccessful, [" . $this->conn->connect_error . "]");
        }
    }

    /**
     * Escape string query
     */
    function escape_string($str)
    {
        return @$this->conn->real_escape_string($str);
    }


    /**
     * Start sentence query
     */
    function _query($sql)
    {
        return $this->conn->query($sql);
    }

    /**
     * Insert data to database
     */
    function insert($table, $data)
    {
        foreach ($data as $field => $value) {
            $listField[] = "`{$field}`";
            $listValue[] = "'{$this->escape_string($value)}'";
        }
        $listField = implode(',', $listField);
        $listValue = implode(',', $listValue);
        $sql = "INSERT INTO {$table} ({$listField}) VALUES ({$listValue})";
        if ($this->_query($sql)) {
            return $this->conn->insert_id;
        } else {
            echo "Inner unsuccessful: [Error: " . $this->conn->error . "]";
        }
    }

    /**
     * Update data from database
     */
    function update($table, $data, $where = '')
    {
        foreach ($data as $field => $value) {
            $strUpdate[] = "`{$field}` = '{$this->escape_string($value)}'";
        }
        $strUpdate = implode(',', $strUpdate);
        $where = !empty($where) ? "WHERE {$where}" : "";
        $sql = "UPDATE {$table} SET {$strUpdate} {$where}";
        if ($this->_query($sql)) {
            return true;
        } else {
            echo "Update unsuccessful";
        }
    }

    /**
     * Update data from database
     */
    function delete($table, $where)
    {
        $sql = "DELETE FROM {$table} WHERE {$where}";
        if ($this->_query($sql)) {
            return true;
        } else {
            echo $sql;
        }
    }

    /**
     * Select data by query
     */
    function selectByQuery($sql)
    {
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            $data = [];
            while ($row = $result->fetch_assoc()) {
                array_push($data, $row);
            }
            return $data;
        } else {
            return [];
        }
    }

    /**
     * Select all data
     */
    public function selectAll($table, $where = null)
    {
        $where = !empty($where) ? "WHERE {$where}" : "";
        $sql = "SELECT * FROM `${table}` ${where}";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            $data = [];
            while ($row = $result->fetch_assoc()) {
                array_push($data, $row);
            }
            return $data;
        } else {
            return [];
        }
    }

    /**
     * Select row item
     */
    public function selectRow($sql)
    {
        $result = $this->conn->query($sql);
        return $result->fetch_assoc();
    }

    /**
     * Get num row
     */

    public function getNumRow($sql)
    {
        $result = $this->conn->query($sql);
        return $result->num_rows;
    }

}

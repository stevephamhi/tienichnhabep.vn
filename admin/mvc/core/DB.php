<?php

class DB
{

    // protected $db_host = "localhost";
    // protected $db_user = "root";
    // protected $db_pass = "";
    // protected $db_name = "sucsongt_tienichnhabep";

    protected $db_host = "localhost";
    protected $db_user = "sucsongt_capri20";
    protected $db_pass = "capriadmin123";
    protected $db_name = "sucsongt_tienichnhabep";

    public $conn;

    function __construct()
    {
        $this->connection();
    }
    function connection()
    {
        $this->conn = new mysqli($this->db_host, $this->db_user, $this->db_pass, $this->db_name);
        if ($this->conn->connect_error) {
            die("Connect to db unsuccessful, [" . $this->conn->connect_error . "]");
        }
    }

    function escape_string($str)
    {
        return @$this->conn->real_escape_string($str);
    }

    function insert($table, $data)
    {
        foreach ($data as $field => $value) {
            $listField[] = "`{$field}`";
            $listValue[] = "'{$this->escape_string($value)}'";
        }
        $listField = implode(',', $listField);
        $listValue = implode(',', $listValue);
        $sql = "INSERT INTO {$table} ({$listField}) VALUES ({$listValue})";
        if ($this->query($sql)) {
            return $this->conn->insert_id;
        } else {
            echo "Inner unsuccessful: [Error: " . $this->conn->error . "]";
        }
    }

    function query($sql)
    {
        return $this->conn->query($sql);
    }

    function select($table, $data = array(), $where = "")
    {
        $data  = !empty($data) ? implode(',', $data) : "*";
        $where = !empty($where) ? "WHERE {$where}" : "";
        $sql = "SELECT {$data} FROM {$table} {$where}";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            $data = [];
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            return $data;
        } else {
            return [];
        }
    }

    public function selectRow($table, $data, $where)
    {
        $data  = !empty($data) ? implode(',', $data) : "*";
        $where = !empty($where) ? "WHERE {$where}" : "";
        $sql = "SELECT {$data} FROM {$table} {$where}";
        $result = $this->conn->query($sql);
        return $result->fetch_assoc();
    }

    function selectSql($table, $data = '', $where = "")
    {
        $data  = !empty($data) ? $data : "*";
        $sql = "SELECT {$data} FROM {$table} {$where}";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            $data = [];
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            return $data;
        } else {
            return [];
        }
    }

    function update($table, $data, $where)
    {
        foreach ($data as $field => $value) {
            $strUpdate[] = "`{$field}` = '{$this->escape_string($value)}'";
        }
        $strUpdate = implode(',', $strUpdate);
        $sql = "UPDATE {$table} SET {$strUpdate} WHERE {$where}";
        if ($this->query($sql)) {
            return true;
        } else {
            echo "Update unsuccessful: [Error: " . $this->conn->error . "]";
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

    function delete($table, $where)
    {
        $sql = "DELETE FROM {$table} WHERE {$where}";
        if ($this->query($sql)) {
            return true;
        } else {
            echo "Delete unsuccessful: [Error: " . $this->conn->error . "]";
        }
    }
}

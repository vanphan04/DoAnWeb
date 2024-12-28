<?php

class Database
{
    public $host = "localhost";
    public $user = "root";
    public $pass = "";
    public $dbname = "banhang";

    public $connect;
    public $error;


    public function connectDB()
    {
        $this->connect = new mysqli($this->host, $this->user, $this->pass, $this->dbname);
        mysqli_set_charset($this->connect, 'UTF8');
        if (!$this->connect->connect_error) {
            $this->error = "Connection fail" . $this->connect->connect_error;
            return false;
        }
    }

    public function closeDB()
    {
        $this->connect->close();
    }

    public function findById($query)
    {
        $this->connectDB();
        $result = mysqli_query($this->connect, $query);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                return $row;
            }
            $this->closeDB();
        } else {
            $this->closeDB();
            return false;
        }
    }

    //select or Read data
    public function query($query)
    {
        $this->connectDB();
        $result = mysqli_query($this->connect, $query);
        if ($result->num_rows > 0) {
            $data = [];
            while ($row = $result->fetch_assoc()) {
                array_push($data, $row);
            }
            $this->closeDB();
            return $data;
        } else {
            $this->closeDB();
            return false;
        }

    }
    //insert data
    public function insert($query)
    {
        $this->connectDB();
        $insert_row = $this->connect->query($query) or
            die($this->connect->error . __LINE__);
        if ($insert_row) {
            $this->closeDB();
            return $insert_row;
        } else {
            $this->closeDB();
            return false;
        }
    }

    //update dataa
    public function update($query)
    {
        $this->connectDB();
        $update_row = $this->connect->query($query) or
            die($this->connect->error . __LINE__);
        if ($update_row) {
            $this->closeDB();
            return $update_row;
        } else {
            $this->closeDB();
            return false;
        }
    }

    //delete dataa
    public function delete($query)
    {
        $this->connectDB();
        $delete_row = $this->connect->query($query) or
            die($this->connect->error . __LINE__);
        if ($delete_row) {
            $this->closeDB();
            return $delete_row;
        } else {
            $this->closeDB();
            return false;
        }
    }
}

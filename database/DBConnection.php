<?php


class DBConnection
{
    private $host = "localhost";
    private $user = "root";
    private $password = "";
    private $dbName = "assignment2";

    public $con;

    public function __construct()
    {
        $this->con = mysqli_connect($this->host, $this->user, $this->password, $this->dbName);
    }

    public function close()
    {
        $this->con->close();
    }
}
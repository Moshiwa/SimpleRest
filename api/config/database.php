<?php

class Database
{
    private $host = '127.0.0.1';
    private $port = '';
    private $dbName = '';
    private $username = '';
    private $password = '';

    /**
     * @return false|resource|void
     */
    public function getConnection()
    {
        $connect = pg_connect("
            host={$this->host}
            port={$this->port} 
            dbname={$this->dbName} 
            user={$this->username} 
            password={$this->password}")
        or die("Can't connect to database".pg_last_error());

        return $connect;
    }
}

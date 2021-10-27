<?php

class Book
{
    protected $connect;
    protected $alias = "books";
    protected $Session = null;
    protected $errors = '';

    public $id;
    public $name;
    public $author_id;
    public $amount;
    public $genre;

    public function __construct($db)
    {
        $this->connect = $db;
    }

    public function errors()
    {
        return $this->errors;
    }

    public function create()
    {

    }

    public function read($id = '')
    {
        $query = "SELECT * FROM {$this->alias} ";
        if (! empty($id)) {
            $query .= "WHERE id = {$id}";
        }
        $result = pg_query($query) or die('Ошибка запроса: ' . pg_last_error());

        $books = [];

        while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
            $books[] = $line;
        }

        return $books;
    }

    public function update($id)
    {

    }

    public function delete($id)
    {

    }

}
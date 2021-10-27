<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../../config/database.php';
include_once '../book.php';

$Database = new Database();
$connectionDb = $Database->getConnection();

$Book = new Book($connectionDb);
$books = $Book->read();

echo json_encode($books);
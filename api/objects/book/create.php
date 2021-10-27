<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../../config/database.php';
include_once '../../config/session.php';
include_once '../book.php';

$Session = new Session();
$userRole = $Session->getSession('role');
if ($userRole === 'author') {
    $Database = new Database();
    $connectionDb = $Database->getConnection();

    $Book = new Book($connectionDb);

    $userId = $Session->getSession('user_id');
    $data = json_decode(file_get_contents("php://input"));

} else {
    echo 'Permission denied';
}


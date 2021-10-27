<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../../config/database.php';
include_once '../../config/session.php';
include_once '../user.php';

$Session = new Session();

$Database = new Database();
$connectionDb = $Database->getConnection();

$User = new User($Session, $connectionDb);

if (! empty($_POST)) {
    $saveData = $_POST;
    $result = $User->create($saveData);
    if ($result) {
        $Session->setSession('user_id', $User->id);
        $Session->setSession('role', $User->role);
    } else {
        echo $User->errors();
    }
} else {
    $saveData = json_decode(file_get_contents("php://input"));
    if ($saveData->method) {
        $method = $saveData->method;
        if (method_exists($User, $method)) {
            if (empty($User->{$method}($saveData))) {
                echo json_encode(['error' => $User->errors()]);
            } else {
                return json_encode(['body' => 'yeaa']);
            }
        }
    }
}



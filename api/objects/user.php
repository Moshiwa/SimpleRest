<?php

class User
{
    protected $connect;
    protected $alias = "users";
    protected $Session = null;
    protected $errors = [];

    public $id;
    public $username;
    public $role;

    public function __construct($Session, $db)
    {
        $this->connect = $db;
        $this->Session = $Session;
    }

    public function errors()
    {
        return $this->errors;
    }

    public function resetPassword()
    {

    }

    public function login($data)
    {
        if (empty($data->password) || empty($data->username)) {
            $this->errors = 'User->login: empty password or username';
            return false;
        }

        $query = "SELECT * FROM {$this->alias} WHERE username = '{$data->username}'";
        $result = pg_query($query) or die('Ошибка запроса: ' . pg_last_error());
        $users = [];
        while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
            $users[] = $line;
        }

        if (empty($users[0])) {
            $this->errors = 'User->login: user not found in db';
            return false;
        }

        $user = $users[0];
        if (empty($user['password']) || empty($user['id'] || empty($user['role']))) {
            $this->errors = 'User->login: user password or id or role is empty';
            return false;
        }

        if (! password_verify($data->password, $user['password'])) {
            $this->errors = 'User->login: passwords not equal';
            return false;
        }
        $this->Session->setSession('user_id', $user['id']);
        $this->Session->setSession('role', $user['role']);

        return true;
    }

    public function create($data)
    {
        if (empty($data)) {
            $this->errors = "User->create: empty data";
            return false;
        }

        $username = empty($data['username']) ? '' : $data['username'];
        $password = empty($data['password']) ? '' : $data['password'];
        $role = empty($data['role']) ? '' : $data['role'];
        $role = empty($role) ? 'reader' : $role;
        $role = $role === 'on' ? 'author' : 'reader';

        if (empty($password)) {
            $this->errors = "User->create: empty password";
            return false;
        }

        $password = password_hash($password, PASSWORD_BCRYPT);

        if (empty($username)) {
            $this->errors = "User->create: empty username";
            return false;
        }

        $query = "SELECT * FROM {$this->alias} WHERE username = '{$username}'";
        $result = pg_query($query) or die('Ошибка запроса: ' . pg_last_error());
        $users = [];
        while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
            $users[] = $line;
        }
        if (!empty($users[0]['id'])) {
            $this->errors = "User->create: user {$username} already registered";
            return false;
        }

        $query = "INSERT INTO {$this->alias} (id, username, role, password) VALUES (DEFAULT, '{$username}', '{$role}', '{$password}') RETURNING id";
        $result = pg_query($query) or die('Ошибка запроса: ' . pg_last_error());
        $result = pg_fetch_array($result, null, PGSQL_ASSOC);

        $this->id = $result['id'];
        $this->username = $username;
        $this->role = $role;

        return true;
    }

    public function read($id = '')
    {

    }

    public function update($id)
    {

    }

    public function delete($id)
    {

    }

}
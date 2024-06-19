<?php
include_once 'models/UsersModel.php';

class UsersService
{
    private $usersModel;

    public function __construct(UsersModel $usersmodel)
    {
        $this->usersModel = $usersmodel;
    }

    public function fetchAllUsers()
    {
        $stmt = $this->usersModel->readAllUsers();
        $users_array = array();
        $users_array["records"] = array();
        while ($rows = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            extract($rows);
            $user_item = array (
                "id" => $id,
                "first_name" => $first_name,
                "last_name" => $last_name,
                "address" => $address,
                "phone" => $phone,
                "email" => $email,
                "note" => $note
            );
            array_push($users_array["records"], $user_item);
        }

        return $users_array;
    }

    public function fetchUserById($id)
    {
        $stmt = $this->usersModel->readUserById($id);
        $user = array();
        $user["records"] = array();
        while ($rows = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            extract($rows);
            $user_item = array (
                "id" => $id,
                "first_name" => $first_name,
                "last_name" => $last_name,
                "address" => $address,
                "phone" => $phone,
                "email" => $email,
                "note" => $note
            );
            array_push($user["records"], $user_item);
        }
    }

    public function insertUser($data)
    {
        return $this->usersModel->insertUser($data);
    }

    public function updateUser($data)
    {
        return $this->usersModel->updateUser($data);
    }

    public function deleteUser($id)
    {
        return $this->usersModel->deleteUser($id);
    }
}
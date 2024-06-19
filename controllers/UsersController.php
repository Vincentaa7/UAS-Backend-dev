<?php
// include_once '../config/database.php';
include_once 'models/UsersModel.php'; // 1
include_once 'services/UsersService.php';

class UsersController 
{
    private $usersService;

    public function __construct($conn)
    {
        $usersModel = New UsersModel($conn); // 2
        $this->usersService = new UsersService($usersModel); //3
    }

    public function readUsers()
    {
        $users = $this->usersService->fetchAllUsers();
        return json_encode($users);
    }

    public function readUserById()
    {
        $id_user = json_decode(file_get_contents("php://input"), true);
        $id = $id_user['id'];
        $user = $this->usersService->fetchUserById($id);
        return json_encode($user);
    }

    public function addUser()
    {
        $data = json_decode(file_get_contents("php://input"), true);
        $result = $this->usersService->insertUser($data);
        if ($result)
        {
            return json_encode(array("message" => "User added successfuly to the database"));
        }
        else
        {
            return json_encode(array("message" => "Failed to add user to the database"));
        }
    }

    public function updateUser()
    {
        $data = json_decode(file_get_contents("php://input"), true);
        $result = $this->usersService->updateUser($data);
        if ($result)
        {
            return json_encode(array("message" => "User updated successfully in the database"));
        }
        else
        {
            return json_encode(array("message" => "Failed to update user"));
        }
    }

    public function deleteUser()
    {
        $data = json_decode(file_get_contents("php://input"), true);
        $id = $data['id'];
        $result = $this->usersService->deleteUser($id);
        if ($result)
        {
            return json_encode(array("message" => "User deleted successfully from the database"));
        }
        else
        {
            return json_encode(array("message" => "Failed to delete user"));
        }
    }
   
}
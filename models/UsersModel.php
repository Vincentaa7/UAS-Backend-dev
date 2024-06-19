<?php
class UsersModel
{
    private $conn;
    private $table_name;

    public function __construct($db)
    {
        $this->conn = $db; 
        $tables = include('config/table.php');
        $this->table_name = $tables['users'];
    }

    public function readAllUsers()
    {
        try
        {
            $query = "SELECT * FROM " . $this->table_name;
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }
        catch (PDOException $e)
        {
            echo "Error: " . $e->getMessage();
        }
    }

    public function readUserById($id)
    {
        try
        {
            $query = "SELECT * FROM " . $this->table_name . " WHERE id = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1, $id);
            $stmt->execute();

            return $stmt;
        }
        catch (PDOException $e)
        {
            echo "Error: " . $e->getMessage();
        }
    }

    public function insertUser($data)
    {
        try
        {
            $query = "INSERT INTO " . $this->table_name . " (id, first_name, last_name, address, phone, email, note) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1, $data['id']);
            $stmt->bindParam(2, $data['first_name']);
            $stmt->bindParam(3, $data['last_name']);
            $stmt->bindParam(4, $data['address']);
            $stmt->bindParam(5, $data['phone']);
            $stmt->bindParam(6, $data['email']);
            $stmt->bindParam(7, $data['note']);
            $stmt->execute();

            return $stmt->rowCount();
        }
        catch (PDOException $e)
        {
            echo "Error: " . $e->getMessage();
        }
    }

    public function updateUser($data)
    {
        try
        {
            $query = "UPDATE " . $this->table_name . " SET first_name = ?, last_name = ?, address = ?, phone = ?, email = ?, note = ? WHERE id = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1, $data['first_name']);
            $stmt->bindParam(2, $data['last_name']);
            $stmt->bindParam(3, $data['address']);
            $stmt->bindParam(4, $data['phone']);
            $stmt->bindParam(5, $data['email']);
            $stmt->bindParam(6, $data['note']);
            $stmt->bindParam(7, $data['id']);
            $stmt->execute();
            return $stmt->rowCount() > 0;
        }
        catch (PDOException $e)
        {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function deleteUser($id)
    {
        try
        {
            $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1, $id);
            $stmt->execute();
            return $stmt->rowCount() > 0;
        }
        catch (PDOException $e)
        {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

}
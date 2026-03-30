<?php

namespace App\Repositories;

use App\Core\Database;
use App\Models\User;

class UserRepository {

    private $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }


    public function check_email($email) {

        try {
            if (!$email) {
                throw new \Exception("Esse email e/ou senha estão incorretos.");
            }

            $sql = "SELECT * FROM users WHERE email = :email LIMIT 1";
            $stmt = $this->db->prepare($sql);

            $stmt->bindValue(':email', $email);
            $stmt->execute();
            
            $user = $stmt->fetch(\PDO::FETCH_ASSOC);

            return $user ?: null;

        } catch (\PDOException $pd) {
            echo 'Erro ao verificar no banco: ' . $pd->getMessage();
        }
    }


    public function save_user(User $data) {
        try {
            $sql = "INSERT INTO users (name, email, password) VALUES (:name, :email, :password)";
            $stmt = $this->db->prepare($sql);

            $stmt->bindValue(':name', $data->getName());
            $stmt->bindValue(':email', $data->getEmail());
            $stmt->bindValue(':password', $data->getPassword());

            return $stmt->execute();
        } catch (\PDOException $pd) {
            echo 'Erro ao salvar no banco: ' . $pd->getMessage();
        }
        
    }

    public function find_by_id($id) {
        try {
            $sql = "SELECT * FROM users WHERE id = :id";
            $stmt = $this->db->prepare($sql);

            $stmt->bindValue(':id', $id);
            $stmt->execute();

            return $stmt->fetch() ?: null;

        } catch (\PDOException $pd) {
            echo 'Erro ao buscar no banco: ' . $pd->getMessage();
        }
        
    }

    public function update_user(User $data, $id) {
        try {
            $sql = "UPDATE users SET name = :name, email = :email, password = :password WHERE id = :id";
            $stmt = $this->db->prepare($sql);

            $stmt->bindValue(':name', $data->getName());
            $stmt->bindValue(':email', $data->getEmail());
            $stmt->bindValue(':password', $data->getPassword());
            $stmt->bindValue(':id', $id);

            return $stmt->execute();
        } catch (\PDOException $pd) {
            echo 'Erro ao atualizar no banco: ' . $pd->getMessage();
        }
    }

    public function delete_user($id) {
        try {
            $sql = "DELETE FROM users WHERE id = :id";
            $stmt = $this->db->prepare($sql);

            $stmt->bindValue(':id', $id);

            return $stmt->execute();
        } catch (\PDOException $pd) {
            echo 'Erro ao deletar no banco: ' . $pd->getMessage();
        }
    }
}
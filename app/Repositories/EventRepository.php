<?php

namespace App\Repositories;

use App\Core\Database;
use App\Models\Event;
use DateTime;

class EventRepository {
    private $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function save_event(Event $data) {
        try {
            $sql = "INSERT INTO events (title, description, event_date, location, created_by) VALUES (:title, :description, :event_date, :location, :created_by)";
            $stmt = $this->db->prepare($sql);

            $stmt->bindValue(':title', $data->getTitle());
            $stmt->bindValue(':description', $data->getDescription());
            $stmt->bindValue(':event_date', $data->getEventDate());
            $stmt->bindValue(':location', $data->getLocation());
            $stmt->bindValue(':created_by', $data->getCreatedBy());

            return $stmt->execute();

        } catch (\PDOException $pd) {
            echo 'Erro ao criar no banco de dados: '. $pd->getMessage();
        }
    }

   public function update_event(Event $data, $idEvent) {
        try {
            $sql = "UPDATE events SET 
                    title = :title, 
                    description = :description, 
                    event_date = :event_date, 
                    location = :location 
                WHERE id = :id AND created_by = :created_by";

            $stmt = $this->db->prepare($sql);

            $stmt->bindValue(':title', $data->getTitle());
            $stmt->bindValue(':description', $data->getDescription());
            $stmt->bindValue(':event_date', $data->getEventDate());
            $stmt->bindValue(':location', $data->getLocation());
            $stmt->bindValue(':created_by', $data->getCreatedBy());
            $stmt->bindValue(':id', $idEvent);
   
            return $stmt->execute();

        } catch (\PDOException $pd) {
            echo 'Erro ao atualizar no banco de dados: '. $pd->getMessage();
        }
   }

   public function delete_event($idEvent) {
        try {
            $sql = "DELETE FROM events WHERE id = :id";

            $stmt = $this->db->prepare($sql);

            $stmt->bindValue(':id', $idEvent);
   
            return $stmt->execute();

        } catch (\PDOException $pd) {
            echo 'Erro ao deletar no banco de dados: '. $pd->getMessage();
        }
   }

    public function my_events($userId) {
        try {
            $sql = "SELECT * FROM events WHERE created_by = :userId ORDER BY event_date ASC";
            $stmt = $this->db->prepare($sql);

            $stmt->bindValue(':userId', $userId);
            $stmt->execute();
            
            return $stmt->fetchAll(\PDO::FETCH_ASSOC) ?: null;

        } catch (\PDOException $pd) {
            echo 'Erro ao buscar no banco de dados: '. $pd->getMessage();
        }
    }

    public function all_events($userId) {
        try {
            $sql = "SELECT * FROM events WHERE created_by != :userId ORDER BY event_date ASC";
            $stmt = $this->db->prepare($sql);

            $stmt->bindValue(':userId', $userId);
            $stmt->execute();
            
            return $stmt->fetchAll(\PDO::FETCH_ASSOC) ?: null;

        } catch (\PDOException $pd) {
            echo 'Erro ao buscar no banco de dados: '. $pd->getMessage();
        }
    }

    public function find_by_id($id) {
        try {
            $sql = "SELECT * FROM events WHERE id = :id";
            $stmt = $this->db->prepare($sql);

            $stmt->bindValue(':id', $id);
            $stmt->execute();
            
            return $stmt->fetch(\PDO::FETCH_ASSOC) ?: null;

        } catch (\PDOException $pd) {
            echo 'Erro ao buscar no banco de dados: '. $pd->getMessage();
        }
    }

   public function inscribe_event($id, $userId) {
        try {
            $this->db->beginTransaction();

            $sqlReg = "INSERT INTO registrations (event_id, user_id, registration_date) VALUES (:event_id, :user_id, NOW())";
            $stmtReg = $this->db->prepare($sqlReg);
            $stmtReg->bindValue(':event_id', $id);
            $stmtReg->bindValue(':user_id', $userId);
            $stmtReg->execute();

            $sql = "UPDATE events SET number_registrations = number_registrations + 1 WHERE id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':id', $id);
            $stmt->execute();

            return $this->db->commit(); 

        } catch (\PDOException $pd) {
            if ($this->db->inTransaction()) {
                $this->db->rollBack();
            }

            echo 'Erro ao criar ou atualizar no banco de dados: '. $pd->getMessage();
            return false;
        }
    }
}
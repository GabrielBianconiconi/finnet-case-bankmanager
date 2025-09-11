<?php

namespace App\Models;

use App\Core\BaseModel;

class StudentModel extends BaseModel
{
    protected string $table = 'students';

    public function search(string $searchTerm): array
    {
        $sql = "SELECT * FROM {$this->table} 
                WHERE name LIKE :name_term OR email LIKE :email_term 
                ORDER BY name ASC";
        
        $stmt = $this->db->prepare($sql);
        
        $searchTermWithWildcards = '%' . $searchTerm . '%';

        $stmt->execute([
            ':name_term' => $searchTermWithWildcards,
            ':email_term' => $searchTermWithWildcards
        ]);
        
        return $stmt->fetchAll();
    }

    public function create(array $data): bool
    {
        $sql = "INSERT INTO students (name, email, birth_date, created_at, updated_at) 
                VALUES (:name, :email, :birth_date, NOW(), NOW())";
        
        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':name' => $data['name'],
            ':email' => $data['email'],
            ':birth_date' => !empty($data['birth_date']) ? $data['birth_date'] : null
        ]);
    }

    public function update(int $id, array $data): bool
    {
        $sql = "UPDATE students SET name = :name, email = :email, birth_date = :birth_date, updated_at = NOW() 
                WHERE id = :id";
        
        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':id' => $id,
            ':name' => $data['name'],
            ':email' => $data['email'],
            ':birth_date' => !empty($data['birth_date']) ? $data['birth_date'] : null
        ]);
    }

    public function delete(int $id): bool
    {
        $sql = "DELETE FROM students WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}


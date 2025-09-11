<?php

namespace App\Models;

use App\Core\BaseModel;

class CourseModel extends BaseModel
{
    protected string $table = 'courses';

    public function create(array $data): bool
    {
        $sql = "INSERT INTO courses (title, description, created_at, updated_at) VALUES (:title, :description, NOW(), NOW())";
        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':title' => $data['title'],
            ':description' => $data['description']
        ]);
    }
    public function update(int $id, array $data): bool
    {
        $sql = "UPDATE courses SET title = :title, description = :description, updated_at = NOW() WHERE id = :id";
        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':id' => $id,
            ':title' => $data['title'],
            ':description' => $data['description']
        ]);
    }
}

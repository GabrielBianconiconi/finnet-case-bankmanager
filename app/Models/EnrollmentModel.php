<?php

namespace App\Models;

use App\Core\BaseModel;

class EnrollmentModel extends BaseModel
{
    protected string $table = 'enrollments';
    public function findAllWithDetails(): array
    {
        $sql = "SELECT 
                    e.id, 
                    s.name as student_name, 
                    c.title as course_title, 
                    e.created_at as enrollment_date
                FROM enrollments e
                JOIN students s ON e.student_id = s.id
                JOIN courses c ON e.course_id = c.id
                ORDER BY e.created_at DESC";
        
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll();
    }

    public function create(array $data): bool
    {
        $sql = "INSERT INTO enrollments (student_id, course_id, created_at, updated_at) 
                VALUES (:student_id, :course_id, NOW(), NOW())";
        
        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':student_id' => $data['student_id'],
            ':course_id' => $data['course_id']
        ]);
    }

    public function update(int $id, array $data): bool
    {
        $sql = "UPDATE enrollments SET student_id = :student_id, course_id = :course_id, updated_at = NOW() 
                WHERE id = :id";
        
        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':id' => $id,
            ':student_id' => $data['student_id'],
            ':course_id' => $data['course_id']
        ]);
    }
}


<?php

namespace Tests;

use App\Models\CourseModel;
use App\Core\Database;
use PHPUnit\Framework\TestCase;
use PDO;

class CourseModelTest extends TestCase
{
    private PDO $pdo;
    private CourseModel $courseModel;

    protected function setUp(): void
    {
        $this->pdo = Database::getInstance();
        $this->courseModel = new CourseModel();

    }

    /**
     * @test
     */
    public function testCreateNewCourse()
    {
                $data = [
            'title' => 'Biologia Celular',
            'description' => 'Descrição do curso de biologia celular.'
        ];

        $result = $this->courseModel->create($data);

        $this->assertTrue($result);
        
        $stmt = $this->pdo->query("SELECT * FROM courses WHERE title = 'Biologia Celular'");
        $course = $stmt->fetch();
        $this->assertNotFalse($course);
        $this->assertEquals('Biologia Celular', $course['title']);
    }

    /**
     * @test
     */
    public function testUpdateExistingCourse()
    {
        $this->courseModel->create([
            'title' => 'Química Orgânica',
            'description' => 'Descrição original.'
        ]);
        $courseId = $this->pdo->lastInsertId();

        $updatedData = [
            'title' => 'Química Orgânica Avançada',
            'description' => 'Descrição atualizada.'
        ];

        $result = $this->courseModel->update($courseId, $updatedData);

        $this->assertTrue($result);

        $stmt = $this->pdo->query("SELECT * FROM courses WHERE id = $courseId");
        $updatedCourse = $stmt->fetch();
        $this->assertEquals('Química Orgânica Avançada', $updatedCourse['title']);
    }

    /**
     * @test
     */
    public function testDeleteCourse()
    {
        $this->courseModel->create([
            'title' => 'Física Quântica',
            'description' => 'Descrição do curso de física.'
        ]);
        $courseId = $this->pdo->lastInsertId();
        $result = $this->courseModel->delete($courseId);

        $this->assertTrue($result);

        $stmt = $this->pdo->query("SELECT COUNT(*) FROM courses WHERE id = $courseId");
        $count = $stmt->fetchColumn();
        $this->assertEquals(0, $count);
    }
}
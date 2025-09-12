<?php

namespace Tests;

use App\Models\EnrollmentModel;
use App\Models\StudentModel;
use App\Models\CourseModel;
use App\Core\Database;
use PHPUnit\Framework\TestCase;
use PDO;

class EnrollmentModelTest extends TestCase
{
    private PDO $pdo;
    private EnrollmentModel $enrollmentModel;
    private StudentModel $studentModel;
    private CourseModel $courseModel;
    private int $testStudentId;
    private int $testCourseId;

    protected function setUp(): void
    {
        $this->pdo = Database::getInstance();
        $this->enrollmentModel = new EnrollmentModel();
        $this->studentModel = new StudentModel();
        $this->courseModel = new CourseModel();

        $this->studentModel->create(['name' => 'Aluno Teste', 'email' => 'aluno@teste.com', 'birth_date' => '2000-01-01']);
        $this->testStudentId = $this->pdo->lastInsertId();

        $this->courseModel->create(['title' => 'Curso Teste', 'description' => 'Descrição do curso de teste.']);
        $this->testCourseId = $this->pdo->lastInsertId();
    }

    /**
     * @test
     */
    public function testCreateNewEnrollment()
    {
        $data = [
            'student_id' => $this->testStudentId,
            'course_id' => $this->testCourseId
        ];

        $result = $this->enrollmentModel->create($data);

        $this->assertTrue($result);
        
        $stmt = $this->pdo->query("SELECT * FROM enrollments WHERE student_id = {$this->testStudentId}");
        $enrollment = $stmt->fetch();
        $this->assertNotFalse($enrollment);
        $this->assertEquals($this->testStudentId, $enrollment['student_id']);
        $this->assertEquals($this->testCourseId, $enrollment['course_id']);
    }

    /**
     * @test
     */
    public function testUpdateExistingEnrollment()
    {
        
        $this->enrollmentModel->create([
            'student_id' => $this->testStudentId,
            'course_id' => $this->testCourseId
        ]);
        $enrollmentId = $this->pdo->lastInsertId();

        
        $this->courseModel->create(['title' => 'Outro Curso', 'description' => 'Descrição do segundo curso.']);
        $newCourseId = $this->pdo->lastInsertId();

        $updatedData = [
            'student_id' => $this->testStudentId,
            'course_id' => $newCourseId
        ];

        $result = $this->enrollmentModel->update($enrollmentId, $updatedData);

        $this->assertTrue($result);

        $stmt = $this->pdo->query("SELECT * FROM enrollments WHERE id = {$enrollmentId}");
        $updatedEnrollment = $stmt->fetch();
        $this->assertEquals($newCourseId, $updatedEnrollment['course_id']);
    }

    /**
     * @test
     */
    public function testDeleteEnrollment()
    {
        $this->enrollmentModel->create([
            'student_id' => $this->testStudentId,
            'course_id' => $this->testCourseId
        ]);
        $enrollmentId = $this->pdo->lastInsertId();

        $result = $this->enrollmentModel->delete($enrollmentId);

        $this->assertTrue($result);

        $stmt = $this->pdo->query("SELECT COUNT(*) FROM enrollments WHERE id = {$enrollmentId}");
        $count = $stmt->fetchColumn();
        $this->assertEquals(0, $count);
    }
}
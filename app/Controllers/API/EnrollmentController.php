<?php

namespace App\Controllers\API;

use App\Models\EnrollmentModel;
use App\Models\StudentModel;
use App\Models\CourseModel;
use App\Core\AuthMiddleware;

class EnrollmentController
{
    private EnrollmentModel $enrollmentModel;
    private StudentModel $studentModel;
    private CourseModel $courseModel;

    public function __construct()
    {
        $this->enrollmentModel = new EnrollmentModel();
        $this->studentModel = new StudentModel();
        $this->courseModel = new CourseModel();
    }
    
    public function index(): void
    {
        AuthMiddleware::checkToken();
        header('Content-Type: application/json');
        $enrollments = $this->enrollmentModel->findAllWithDetails();
        echo json_encode(['data' => $enrollments]);
    }

    public function show(int $id): void
    {
        AuthMiddleware::checkToken();
        header('Content-Type: application/json');
        $enrollment = $this->enrollmentModel->findById($id);

        if ($enrollment) {
            echo json_encode(['data' => $enrollment]);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Matrícula não encontrada.']);
        }
    }

    public function store(): void
    {
        AuthMiddleware::checkToken();
        header('Content-Type: application/json');
        $data = json_decode(file_get_contents('php://input'), true);

        if ($this->enrollmentModel->create($data)) {
            http_response_code(201);
            echo json_encode(['message' => 'Matrícula criada com sucesso.']);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Erro ao criar a matrícula.']);
        }
    }

    public function update(int $id): void
    {
        AuthMiddleware::checkToken();
        header('Content-Type: application/json');
        $data = json_decode(file_get_contents('php://input'), true);

        if ($this->enrollmentModel->update($id, $data)) {
            echo json_encode(['message' => 'Matrícula atualizada com sucesso.']);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Matrícula não encontrada ou erro na atualização.']);
        }
    }

    public function destroy(int $id): void
    {
        AuthMiddleware::checkToken();
        header('Content-Type: application/json');
        
        if ($this->enrollmentModel->delete($id)) {
            echo json_encode(['message' => 'Matrícula excluída com sucesso.']);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Matrícula não encontrada.']);
        }
    }
}
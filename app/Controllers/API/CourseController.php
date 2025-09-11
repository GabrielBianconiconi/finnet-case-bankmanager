<?php

namespace App\Controllers\API;

use App\Models\CourseModel;

class CourseController
{
    private CourseModel $courseModel;

    public function __construct()
    {
        $this->courseModel = new CourseModel();
    }
    
    public function index(): void
    {
        header('Content-Type: application/json');
        
        $courses = $this->courseModel->findAll();
        
        echo json_encode(['data' => $courses]);
    }

    public function show(int $id): void
    {
        header('Content-Type: application/json');
        
        $course = $this->courseModel->findById($id);

        if ($course) {
            echo json_encode(['data' => $course]);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Curso não encontrado']);
        }
    }

    public function store(): void
    {
        header('Content-Type: application/json');
        $data = json_decode(file_get_contents('php://input'), true);

        if ($this->courseModel->create($data)) {
            http_response_code(201); // 201 Created
            echo json_encode(['message' => 'Curso criado com sucesso']);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Erro ao criar o curso']);
        }
    }

    public function update(int $id): void
    {
        header('Content-Type: application/json');
        $data = json_decode(file_get_contents('php://input'), true);

        if ($this->courseModel->update($id, $data)) {
            echo json_encode(['message' => 'Curso atualizado com sucesso']);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Curso não encontrado ou erro na atualização']);
        }
    }

    public function destroy(int $id): void
    {
        header('Content-Type: application/json');
        
        if ($this->courseModel->delete($id)) {
            echo json_encode(['message' => 'Curso excluído com sucesso']);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Curso não encontrado']);
        }
    }
}
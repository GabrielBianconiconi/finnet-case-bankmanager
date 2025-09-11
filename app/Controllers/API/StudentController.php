<?php

namespace App\Controllers\API;

use App\Models\StudentModel;

class StudentController
{
    private StudentModel $studentModel;

    public function __construct()
    {
        $this->studentModel = new StudentModel();
    }

    public function index(): void
    {
        header('Content-Type: application/json');

        $searchTerm = $_GET['search'] ?? '';

        if (!empty($searchTerm)) {
            $students = $this->studentModel->search($searchTerm);
        } else {
            $students = $this->studentModel->findAll();
        }

        echo json_encode(['data' => $students]);
    }
    
    public function show(int $id): void
    {
        header('Content-Type: application/json');

        $student = $this->studentModel->findById($id);

        if ($student) {
            echo json_encode(['data' => $student]);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Aluno não encontrado.']);
        }
    }

    public function store(): void
    {
        header('Content-Type: application/json');
        
        $data = json_decode(file_get_contents('php://input'), true);

        if ($this->studentModel->create($data)) {
            http_response_code(201); 
            echo json_encode(['message' => 'Aluno criado com sucesso.']);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Erro ao criar o aluno.']);
        }
    }

    public function update(int $id): void
    {
        header('Content-Type: application/json');

        $data = json_decode(file_get_contents('php://input'), true);

        if ($this->studentModel->update($id, $data)) {
            echo json_encode(['message' => 'Aluno atualizado com sucesso.']);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Aluno não encontrado ou erro na atualização.']);
        }
    }

    public function destroy(int $id): void
    {
        header('Content-Type: application/json');
        
        if ($this->studentModel->delete($id)) {
            echo json_encode(['message' => 'Aluno excluído com sucesso.']);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Aluno não encontrado.']);
        }
    }
}
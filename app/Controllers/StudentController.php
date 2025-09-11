<?php

namespace App\Controllers;

use App\Core\BaseController;
use App\Models\StudentModel;

class StudentController extends BaseController
{
    private StudentModel $studentModel;

    public function __construct()
    {
        $this->studentModel = new StudentModel();
    }

    public function index(): void
    {
        $searchTerm = $_GET['search'] ?? '';

        if (!empty($searchTerm)) {
            $students = $this->studentModel->search($searchTerm);
        } else {
            $students = $this->studentModel->findAll();
        }
        
        $this->render('students/index', [
            'pageTitle' => 'Gerenciamento de Alunos',
            'students' => $students,
            'searchTerm' => $searchTerm
        ]);
    }
    public function create(): void
    {
        $this->render('students/create', ['pageTitle' => 'Adicionar Novo Aluno']);
    }

    public function store(): void
    {
        $data = [
            'name' => $_POST['name'] ?? '',
            'email' => $_POST['email'] ?? '',
            'birth_date' => $_POST['birth_date'] ?? null
        ];
        
        $this->studentModel->create($data);
        
        header('Location: /students');
        exit();
    }

    public function edit(int $id): void
    {
        $student = $this->studentModel->findById($id);
        
        $this->render('students/edit', [
            'pageTitle' => 'Editar Aluno',
            'student' => $student,
            'searchTerm' => $searchTerm
        ]);
    }

    public function update(int $id): void
    {
        $data = [
            'name' => $_POST['name'] ?? '',
            'email' => $_POST['email'] ?? '',
            'birth_date' => $_POST['birth_date'] ?? null
        ];
        
        $this->studentModel->update($id, $data);
        
        header('Location: /students');
        exit();
    }

    public function destroy(int $id): void
    {
        $this->studentModel->delete($id);

        header('Location: /students');
        exit();
    }
}

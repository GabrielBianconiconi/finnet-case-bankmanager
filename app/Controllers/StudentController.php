<?php

namespace App\Controllers;

use App\Core\BaseController;

class StudentController extends BaseController
{
    public function index(): void
    {
        $students = [
            ['id' => 1, 'name' => 'João da Silva', 'email' => 'joao.silva@example.com', 'birth_date' => '1998-05-10'],
            ['id' => 2, 'name' => 'Maria Oliveira', 'email' => 'maria.oliveira@example.com', 'birth_date' => '2001-11-22'],
        ];

        $this->render('students/index', [
            'pageTitle' => 'Gerenciamento de Alunos',
            'students' => $students
        ]);
    }
    public function create(): void
    {
        $this->render('students/create', ['pageTitle' => 'Adicionar Novo Aluno']);
    }

    public function store(): void
    {
        header('Location: /students');
        exit();
    }

    public function edit(int $id): void
    {
        $student = ['id' => $id, 'name' => 'Aluno Exemplo', 'email' => 'aluno@example.com', 'birth_date' => '2000-01-01'];

        $this->render('students/edit', [
            'pageTitle' => 'Editar Aluno',
            'student' => $student
        ]);
    }
    public function update(int $id): void
    {
        header('Location: /students');
        exit();
    }
}

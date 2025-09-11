<?php

namespace App\Controllers;

use App\Core\BaseController;

class CourseController extends BaseController
{
    public function index(): void
    {
        $courses = [
            ['id' => 1, 'title' => 'Biologia Celular', 'description' => 'Estudo das células.'],
            ['id' => 2, 'title' => 'Química Orgânica', 'description' => 'Estudo dos compostos de carbono.'],
            ['id' => 3, 'title' => 'Física Quântica', 'description' => 'Introdução à mecânica quântica.'],
        ];

        $pageTitle = 'Gerenciamento de Cursos';
        
        $this->render('courses/index', [
            'courses' => $courses,
            'pageTitle' => $pageTitle
        ]);
    }

    public function create(): void
    {
        $this->render('courses/create');
    }

    public function store(): void
    {
        header('Location: /courses');
        exit();
    }

    public function edit(int $id): void
    {
        $course = ['id' => $id, 'title' => 'Curso Exemplo a Editar', 'description' => 'Descrição do curso a ser editado.'];

        $this->render('courses/edit', ['course' => $course]);
    }

    public function update(int $id): void
    {
        header('Location: /courses');
        exit();
    }
}



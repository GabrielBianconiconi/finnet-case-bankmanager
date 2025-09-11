<?php

namespace App\Controllers;

use App\Core\BaseController;
use App\Models\CourseModel;

class CourseController extends BaseController
{
    
    private CourseModel $courseModel;

    public function __construct()
    {
        
        $this->courseModel = new CourseModel();
    }
    
    public function index(): void
    {
        $courses = $this->courseModel->findAll();
        
        $this->render('courses/index', [
            'pageTitle' => 'Gerenciamento de Cursos',
            'courses' => $courses
        ]);
    }

    public function create(): void
    {
        $this->render('courses/create', ['pageTitle' => 'Adicionar Novo Curso']);
    }

    public function store(): void
    {
        $data = [
            'title' => $_POST['title'] ?? '',
            'description' => $_POST['description'] ?? ''
        ];
        
        $this->courseModel->create($data);
        
        header('Location: /courses');
        exit();
    }

    public function edit(int $id): void
    {
        $course = $this->courseModel->findById($id);
        
        $this->render('courses/edit', [
            'pageTitle' => 'Editar Curso',
            'course' => $course
        ]);
    }

    public function update(int $id): void
    {
        $data = [
            'title' => $_POST['title'] ?? '',
            'description' => $_POST['description'] ?? ''
        ];
        
        $this->courseModel->update($id, $data);
        
        header('Location: /courses');
        exit();
    }
}


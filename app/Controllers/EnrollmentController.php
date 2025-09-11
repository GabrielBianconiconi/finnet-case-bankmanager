<?php

namespace App\Controllers;

use App\Core\BaseController;

class EnrollmentController extends BaseController
{
    public function index(): void
    {
        $enrollments = [
            ['student_name' => 'João da Silva', 'course_title' => 'Biologia Celular', 'enrollment_date' => '2023-10-27'],
            ['student_name' => 'Maria Oliveira', 'course_title' => 'Química Orgânica', 'enrollment_date' => '2023-10-26'],
            ['student_name' => 'João da Silva', 'course_title' => 'Física Quântica', 'enrollment_date' => '2023-10-27'],
        ];

        $this->render('enrollments/index', [
            'pageTitle' => 'Gerenciamento de Matrículas',
            'enrollments' => $enrollments
        ]);
    }

    public function create(): void
    {
        $students = [
            ['id' => 1, 'name' => 'João da Silva'],
            ['id' => 2, 'name' => 'Maria Oliveira']
        ];
        $courses = [
            ['id' => 1, 'title' => 'Biologia Celular'],
            ['id' => 2, 'title' => 'Química Orgânica']
        ];

        $this->render('enrollments/create', [
            'pageTitle' => 'Realizar Nova Matrícula',
            'students' => $students,
            'courses' => $courses
        ]);
    }


    public function store(): void
    {
        header('Location: /enrollments');
        exit();
    }
}

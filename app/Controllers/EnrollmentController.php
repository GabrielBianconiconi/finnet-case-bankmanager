<?php

namespace App\Controllers;

use App\Core\BaseController;
use App\Models\EnrollmentModel;
use App\Models\StudentModel;
use App\Models\CourseModel;

class EnrollmentController extends BaseController
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
        $enrollments = $this->enrollmentModel->findAllWithDetails();

        $this->render('enrollments/index', [
            'pageTitle' => 'Gerenciamento de Matrículas',
            'enrollments' => $enrollments
        ]);
    }

    public function create(): void
    {
        $students = $this->studentModel->findAll();
        $courses = $this->courseModel->findAll();

        $this->render('enrollments/create', [
            'pageTitle' => 'Realizar Nova Matrícula',
            'students' => $students,
            'courses' => $courses
        ]);
    }


    public function store(): void
    {
        $data = [
            'student_id' => $_POST['student_id'],
            'course_id' => $_POST['course_id']
        ];

        $this->enrollmentModel->create($data);
        header('Location: /enrollments');
        exit();
    }

    public function edit(int $id): void
    {
        $enrollment = $this->enrollmentModel->findById($id);
        $students = $this->studentModel->findAll();
        $courses = $this->courseModel->findAll();

        $this->render('enrollments/edit', [
            'pageTitle' => 'Editar Matrícula',
            'enrollment' => $enrollment,
            'students' => $students,
            'courses' => $courses
        ]);
    }

    public function update(int $id): void
    {
         $data = [
            'student_id' => $_POST['student_id'],
            'course_id' => $_POST['course_id']
        ];

        $this->enrollmentModel->update($id, $data);
        header('Location: /enrollments');
        exit();
    }

    public function destroy(int $id): void
    {
        $this->enrollmentModel->delete($id);

        header('Location: /enrollments');
        exit();
    }
}
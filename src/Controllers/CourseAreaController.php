<?php

namespace App\Controllers;

use App\Core\BaseController;

class CourseAreaController extends BaseController
{ 
    public function index()
    {
        $pageTitle = "Gerenciamento de Áreas de Cursos";

        $courseAreas = [
            ['id' => 1, 'name' => 'Biologia'],
            ['id' => 2, 'name' => 'Química'],
            ['id' => 3, 'name' => 'Física'],
        ];

        $this->render('course_areas/index', [
            'pageTitle' => $pageTitle,
            'courseAreas' => $courseAreas
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Subject;
use App\Models\Course;
use App\Models\User;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Verificar si hay cursos disponibles
        $course = Course::first();
        if (!$course) {
            $this->command->info('No hay cursos en la base de datos. Se deben crear cursos primero.');
            return;
        }

        // Verificar si hay profesores disponibles
        $teacher = User::whereHas('roles', function ($query) {
            $query->where('name', 'teacher'); // Filtrar usuarios con rol "teacher"
        })->first();

        // Crear asignaturas de ejemplo
        $subjects = [
            ['name' => 'Matemáticas', 'course_id' => $course->id, 'teacher_id' => $teacher ? $teacher->id : null],
            ['name' => 'Historia', 'course_id' => $course->id, 'teacher_id' => $teacher ? $teacher->id : null],
            ['name' => 'Física', 'course_id' => $course->id, 'teacher_id' => $teacher ? $teacher->id : null],
            ['name' => 'Química', 'course_id' => $course->id, 'teacher_id' => $teacher ? $teacher->id : null],
        ];

        foreach ($subjects as $subject) {
            Subject::create($subject);
        }

        $this->command->info('Se crearon asignaturas de prueba exitosamente.');
    }
}

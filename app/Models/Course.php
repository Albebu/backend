<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    /**
     * Los atributos que se pueden asignar de forma masiva.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description'
    ];

    /**
     * Relación con el modelo User.
     * Un curso puede tener múltiples usuarios (estudiantes y profesores).
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'course_user')->withPivot('role');
    }

    /**
     * Relación con asignaturas (subjects).
     * Un curso puede tener muchas asignaturas.
     */
    public function subjects()
    {
        return $this->hasMany(Subject::class);
    }
}

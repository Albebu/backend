<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    /**
     * Los atributos que se pueden asignar de forma masiva.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'course_id',
        'teacher_id'
    ];

    /**
     * Relación con el modelo Course (Un subject pertenece a un curso).
     */
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    /**
     * Relación con el modelo User (Un subject tiene un profesor).
     */
    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }
}

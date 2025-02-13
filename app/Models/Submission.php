<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    use HasFactory;

    /**
     * Los atributos que se pueden asignar de forma masiva.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'assignment_id',
        'submitted_at',
        'grade'
    ];

    /**
     * Relación con el modelo User (Una entrega pertenece a un estudiante).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relación con el modelo Assignment (Una entrega pertenece a una tarea).
     */
    public function assignment()
    {
        return $this->belongsTo(Assignment::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;

    /**
     * Los atributos que se pueden asignar de forma masiva.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'due_date',
        'subject_id'
    ];

    /**
     * Relación con el modelo Subject (Una tarea pertenece a una asignatura).
     */
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}

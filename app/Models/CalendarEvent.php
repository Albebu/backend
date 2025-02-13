<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalendarEvent extends Model
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
        'start',
        'end',
        'user_id'
    ];

    /**
     * Relación con el modelo User (Un evento pertenece a un usuario).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

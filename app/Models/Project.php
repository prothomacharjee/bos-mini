<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'client',
        'start_date',
        'end_date',
        'status'
    ];

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}

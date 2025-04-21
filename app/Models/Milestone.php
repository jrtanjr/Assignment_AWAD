<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Milestone extends Model
{
    protected $fillable = [
        'project_id',
        'title',
        'description',
        'amount',
        'due_date',
    ];
    
    protected $attributes = [
        'status' => 'in_progress',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}

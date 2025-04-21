<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    protected $fillable = [
        'project_id',
        'freelancer_id',
        'bid_amount',
        'msg',
    ];

    protected $attributes = [
        'status' => 'pending',
    ];
    
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function freelancer(){
        return $this->belongsTo(Author::class, 'freelancer_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'owner_id',
        'freelancer_id',
        'title',
        'description',
    ];



    protected $attributes = [
        'status'=> 'open',
    ];


    public function owner()
    {
        return $this->belongsTo(Author::class, 'owner_id');
    }

    public function freelancer()
    {
        return $this->belongsTo(Author::class, 'freelancer_id');
    }

    public function bids()
    {
        return $this->hasMany(Bid::class);
    }

    public function milestones()
    {
        return $this->hasMany(Milestone::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    //
    protected $fillable = [
        'milestone_id',
        'amount',
    ];
    public function milestone()
    {
        return $this->belongsTo(Milestone::class);
    }
}

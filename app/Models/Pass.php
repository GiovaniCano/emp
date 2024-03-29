<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pass extends Model
{
    use HasFactory;

    protected $guarded = [];
    
    protected $casts = [
        'benefits' => 'array'
    ];

    public function tickets() {
        return $this->hasMany(Ticket::class);
    }
}

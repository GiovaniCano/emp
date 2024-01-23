<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    const UPDATED_AT = null;

    protected $guarded = [];

    public function pass() {
        return $this->belongsTo(Pass::class);
    }
}

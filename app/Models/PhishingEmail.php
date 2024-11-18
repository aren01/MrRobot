<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhishingEmail extends Model
{
    use HasFactory;

    protected $fillable = [
        'simulation_id',
        'email',
    ];
    public function simulation()
    {
        return $this->belongsTo(Simulation::class);
    }
}

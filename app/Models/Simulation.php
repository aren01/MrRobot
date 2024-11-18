<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Simulation extends Model
{
    use HasFactory;

    protected $fillable = ['simulated_at', 'email_sent', 'status'];

    public function employees()
    {
        return $this->belongsToMany(Employees::class, 'employee_simulation', 'simulation_id', 'employee_id')
            ->withPivot('status', 'submitted_details');
    }
}

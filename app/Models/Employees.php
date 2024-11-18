<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employees extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email'];

    public function simulations()
    {
        return $this->belongsToMany(Simulation::class, 'employee_simulation', 'employee_id', 'simulation_id')
            ->withPivot('status', 'submitted_details');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSimulationsTable extends Migration
{
    public function up()
    {
        Schema::create('simulations', function (Blueprint $table) {
            $table->id();
            $table->timestamp('simulated_at')->useCurrent();
            $table->boolean('email_sent')->default(false);
            $table->string('status')->default('not_opened');
            $table->timestamps();
        });

        Schema::create('employee_simulation', function (Blueprint $table) {
            $table->id();
            $table->foreignId('simulation_id')->constrained()->onDelete('cascade');
            $table->foreignId('employee_id')->constrained()->onDelete('cascade'); // Correct column name 
            $table->string('status')->default('not_opened');
            $table->text('submitted_details')->nullable(); // Add the column for storing form data
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('employee_simulation');
        Schema::dropIfExists('simulations');
    }
}

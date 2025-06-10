<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('mentorship_applications', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('second_name');
            $table->string('email')->unique();
            $table->string('contact_number')->nullable();
            $table->string('occupation')->nullable();
            $table->string('designation')->nullable();
            $table->string('organization')->nullable();
            $table->string('programme_choice')->nullable();
            $table->string('linkedin')->nullable();
            $table->boolean('pledge_agree')->default(false);
            $table->timestamp('submitted_at')->nullable();
            $table->boolean('is_confirmed')->default(false);
            $table->string('confirmation_token')->nullable();
            $table->string('username')->nullable();
            $table->string('password')->nullable(); // Consider hashing
            $table->boolean('is_eligible')->nullable(); // null = pending, 0 = rejected, 1 = approved
            $table->date('session_date')->nullable();
            $table->text('remarks')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mentorship_applications');
    }
};

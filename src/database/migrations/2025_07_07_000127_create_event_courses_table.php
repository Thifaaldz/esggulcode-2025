<?php

use App\Models\Branch;
use App\Models\Employee;
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
        Schema::create('event_courses', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('file_path')->nullable();
            
            $table->foreignIdFor(Branch::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(Employee::class, 'instructor_id')->constrained()->onDelete('cascade');
            
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('price')->default(0);

            $table->string('category');
            $table->string('image')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_courses');
    }
};

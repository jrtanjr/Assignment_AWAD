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
        Schema::create('milestones', function(Blueprint $table)
        {
            $table->id();
            $table->foreignId('project_id')->constrained('projects')->onDelete('cascade');
            $table->string('title');
            $table->string('description');
            $table->decimal('amount', 10, 2);
            $table->timestamp('due_date');
            $table->enum('status',['in_progress','completed','paid','received'])->default('in_progress');
            $table->timestamps();
            $table->timestamp('completed_at')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->timestamp('received_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('milestones');
    }
};

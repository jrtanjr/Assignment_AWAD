<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up():void
    {
        Schema::create('projects', function (Blueprint $table)
        {
            $table->id();
            $table->foreignId('owner_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('freelancer_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->string('title');
            $table->string('description');
            $table->enum('status',['open','assigned','in_progress','completed'])->default('open');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};

// php artisan migrate --path='database/migrations/2025_04_18_073744_create_authors_table.php'
// php artisan migrate --path='database/migrations/2025_04_18_073726_create_admins_table.php'

// php artisan migrate --path='database/migrations/0001_01_01_000000_create_users_table.php'
// php artisan migrate --path='database/migrations/2025_04_01_120552_create_projects_table.php'
// php artisan migrate --path='database/migrations/2025_04_01_120552_create_bids_table.php'
// php artisan migrate --path='database/migrations/2025_04_01_120552_create_milestones_table.php'
// php artisan migrate --path='database/migrations/2025_04_01_120553_create_payments_table.php'

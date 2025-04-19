<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Payment;
use App\Models\Project;
use App\Models\Milestone;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class PaymentSeeder extends Seeder
{
    public function run()
    {
        Payment::unguard();
        // Clear existing payments
        DB::statement('SET FOREIGN_KEY_CHECKS=0;'); // Disable foreign key checks
        Payment::truncate(); // Truncate the bids table
        DB::statement('SET FOREIGN_KEY_CHECKS=1;'); // Enable foreign key checks

        // Create new payments
        Payment::create([
            'milestone_id' => 1,
            // 'transaction_id' => 'TXN12345',
            'amount' => 2000,
        ]);
        Payment::create([
            'milestone_id' => 2,
            // 'transaction_id' => 'TXN12346',
            'amount' => 5000,
        ]);
        Payment::create([
            'milestone_id' => 3,
            // 'transaction_id' => 'TXN12347',
            'amount' => 3000,
        ]);
        Payment::create([
            'milestone_id' => 5,
            // 'transaction_id' => 'TXN12348',
            'amount' => 2000,
        ]);
        Payment::reguard();
    }
}
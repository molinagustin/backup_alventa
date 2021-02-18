<?php

use App\CartStatus;
use Illuminate\Database\Seeder;

class CartStatusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CartStatus::create([
            'status' => 'Active'
        ]);

        CartStatus::create([
            'status' => 'Pending'
        ]);

        CartStatus::create([
            'status' => 'Approved'
        ]);

        CartStatus::create([
            'status' => 'Cancelled'
        ]);

        CartStatus::create([
            'status' => 'Finished'
        ]);
    }
}

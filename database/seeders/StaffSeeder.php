<?php

namespace Database\Seeders;

use App\Models\Staff;
use Illuminate\Database\Seeder;

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $user = Staff::create([
            'name'   => 'Administrator',
            'email'  => 'admin@admin.com',
            'phone_number' => '081234567890',
            'password' => bcrypt('password'),
        ]);
    }
}

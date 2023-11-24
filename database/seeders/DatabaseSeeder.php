<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(AdminSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(SizeSeeder::class);
        $this->call(UnitSeeder::class);
        $this->call(ThicknessSeeder::class);
        $this->call(DepartmentsSeeder::class);
        $this->call(TeamSeeder::class);
    }
}

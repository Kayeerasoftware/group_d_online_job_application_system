<?php

namespace Database\Seeders;

<<<<<<< HEAD
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
=======
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
>>>>>>> 5ac067b5ff45b7df29d47f50329f194f0bdc45ce
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
<<<<<<< HEAD
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
=======
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            DemoDataSeeder::class,
>>>>>>> 5ac067b5ff45b7df29d47f50329f194f0bdc45ce
        ]);
    }
}

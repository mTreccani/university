<?php

namespace Database\Seeders;

use App\Models\UserCourse;
use Illuminate\Database\Seeder;

class UserCourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UserCourse::factory()->count(30)->create();
    }
}

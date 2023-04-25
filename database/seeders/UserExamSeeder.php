<?php

namespace Database\Seeders;

use App\Models\UserExam;
use Illuminate\Database\Seeder;

class UserExamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UserExam::factory()->count(10)->create();
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Project;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Project::create([
            'info' => 'Weather forecast Android app',
            'status' => 'uncompleted',
            'creator' => '1',
            'balance' => 800.00
        ]);
    }
}

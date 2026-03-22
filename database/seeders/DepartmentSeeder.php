<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Department::create([
            'name' => 'IT Department',
            'location' => '3rd Floor',
            'status' => 1
        ]);

        Department::create([
            'name' => 'HR Department',
            'location' => '2nd Floor',
            'status' => 1
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Employee;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $departmentIds = Department::pluck('id')->toArray();
        // Employee::create([
        //     'name' => $faker->name,
        //     'email' => "adel@gmail.com",
        //     'password' => bcrypt('123456'),
        //     'phone' => substr(preg_replace('/\D/', '', $faker->phoneNumber), 0, 15),
        //     'salary' => $faker->numberBetween(3000, 10000),
        //     'position' => $faker->jobTitle,
        //     'status' => $faker->randomElement(['active', 'inactive']),
        //     'hired_at' => $faker->dateTimeBetween('-5 years', 'now')->format('Y-m-d'),
        //     'department_id' => $faker->randomElement($departmentIds),
        // ]);

        for ($i = 0; $i < 10000; $i++) {
            Employee::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => bcrypt('123456'),
                'phone' => substr(preg_replace('/\D/', '', $faker->phoneNumber), 0, 15),
                'salary' => $faker->numberBetween(3000, 10000),
                'position' => $faker->jobTitle,
                'status' => $faker->randomElement(['active', 'inactive']),
                'hired_at' => $faker->dateTimeBetween('-5 years', 'now')->format('Y-m-d'),
                'department_id' => $faker->randomElement($departmentIds),
            ]);
        }
    }
}

<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        try {
            DB::beginTransaction();
            // $this->call(DepartmentSeeder::class);
            $this->call(EmployeeSeeder::class);
            DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            echo ($th->getMessage() . PHP_EOL);
        }
    }
}

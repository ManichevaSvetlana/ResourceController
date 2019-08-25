<?php

use Illuminate\Database\Seeder;

class AdminModelsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\API\AdminModel::insert([
            ['name' => 'test-1'],
            ['name' => 'test-2'],
            ['name' => 'test-3'],
            ['name' => 'test-4'],
            ['name' => 'test-5'],
        ]);
    }
}

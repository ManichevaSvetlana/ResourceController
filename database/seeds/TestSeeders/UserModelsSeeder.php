<?php

use Illuminate\Database\Seeder;

class UserModelsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (\App\User::all() as $user) {
            for ($i = 0; $i < rand(1, 5); $i++) {
                $model = $user->userModels()->create(['name' => 'test-' . $user->id . '-' . $i]);
                for ($j = 0; $j < rand(2, 7); $j++) {
                    $model->userRelatedModels()->create(['name' => 'test-' . $model->id . '-' . $j]);
                }
            }

        }
    }
}

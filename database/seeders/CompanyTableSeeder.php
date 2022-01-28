<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Seeder;

class CompanyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (User::query()->limit(10)->get() as $user) {
            Company::factory(50)
                ->state(
                    ['user_id' => $user]
                )
                ->create();
        }
    }
}

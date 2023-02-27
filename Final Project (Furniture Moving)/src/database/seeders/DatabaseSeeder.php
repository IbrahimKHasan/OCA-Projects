<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(500)->create();
        // \App\Models\Contact::factory(100)->create();
        // \App\Models\Company::factory(500)->create();
        // \App\Models\CompanyUser::factory(500)->create();
        \App\Models\Review::factory(500)->create();
    }
}

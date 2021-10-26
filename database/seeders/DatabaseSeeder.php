<?php

namespace Database\Seeders;

use App\Models\User;
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
        $users = User::factory(100000)->make();
        $chunks = $users->chunk(5000);
        foreach($chunks as $chunk) {
            User::insert($chunk->makeVisible('password')->toArray());
        }
    }
}

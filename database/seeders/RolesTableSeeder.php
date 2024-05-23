<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            ['name' => 'Admin','created_at'=>Date("y-m-d H:i:s")],
            ['name' => 'Employee','created_at'=>Date("y-m-d H:i:s")],
            ['name' => 'User','created_at'=>Date("y-m-d H:i:s")],
        ];

        DB::table('roles')->insert($roles);
    }
}

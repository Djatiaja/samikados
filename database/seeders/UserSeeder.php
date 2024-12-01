<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $exception_roles= ["admin"];
        
        $roles = Role::all();

        foreach ($roles as $role) {
            if (in_array($role->name, $exception_roles)){
                continue;
            }
            User::factory()->count(10)->create(["role_id"=>$role->id]);
        }
    }
}

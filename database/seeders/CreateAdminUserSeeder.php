<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'HARRAK AMIRA',
            'email' => 'amira@gmail.com',
            'password' => bcrypt('azeazeaze'),
            'roles_name' =>['SuperAdmin'],
            'Status' => 'Enabled',
        ]);
        $role = Role::create(['name' => 'SuperAdmin']);
        $permissions = Permission::pluck('id', 'id')->all();
        $role->syncPermissions($permissions);
        $user->assignRole([$role->id]);
    }
}

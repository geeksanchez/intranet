<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\User;

class PopulateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Artisan::call('cache:clear');
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::create(['name' => 'users_manage']);

        $role = Role::create(['name' => 'administrator']);
        $role->givePermissionTo('users_manage');

        $user = User::create([
            'name' => 'Hernan Sanchez',
            'email' => 'nanchez@gmail.com',
            'password' => bcrypt('lorca2000')
        ]);
        $user->assignRole('administrator');
    }
}

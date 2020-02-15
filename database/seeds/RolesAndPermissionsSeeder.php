<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use App\Models\User;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::updateOrcreate(['name' => 'CREATE_MATCHES']);
        Permission::updateOrcreate(['name' => 'READ_MATCHES']);
        Permission::updateOrcreate(['name' => 'UPDATE_MATCHES']);
        Permission::updateOrcreate(['name' => 'DELETE_MATCHES']);

        Permission::updateOrcreate(['name' => 'CREATE_LEAGUES']);
        Permission::updateOrcreate(['name' => 'READ_LEAGUES']);
        Permission::updateOrcreate(['name' => 'UPDATE_LEAGUES']);

        Permission::updateOrcreate(['name' => 'CREATE_CHANNELS']);
        Permission::updateOrcreate(['name' => 'READ_CHANNELS']);
        Permission::updateOrcreate(['name' => 'UPDATE_CHANNELS']);
        Permission::updateOrcreate(['name' => 'DELETE_CHANNELS']);

        Permission::updateOrcreate(['name' => 'CREATE_SERVERS']);
        Permission::updateOrcreate(['name' => 'READ_SERVERS']);
        Permission::updateOrcreate(['name' => 'UPDATE_SERVERS']);
        Permission::updateOrcreate(['name' => 'DELETE_SERVERS']);

        Permission::updateOrcreate(['name' => 'CREATE_SERVER_TYPES']);
        Permission::updateOrcreate(['name' => 'READ_SERVER_TYPES']);
        Permission::updateOrcreate(['name' => 'UPDATE_SERVER_TYPES']);
        Permission::updateOrcreate(['name' => 'DELETE_SERVER_TYPES']);

        Permission::updateOrcreate(['name' => 'CREATE_ADMINS']);
        Permission::updateOrcreate(['name' => 'READ_ADMINS']);
        Permission::updateOrcreate(['name' => 'UPDATE_ADMINS']);
        Permission::updateOrcreate(['name' => 'DELETE_ADMINS']);

        Permission::updateOrcreate(['name' => 'UPDATE_ADSENSES']);

        $permissions = Permission::pluck('name')->toArray();

        $user = User::updateOrCreate([
            'email'    => 'admin@kooralive.info',
        ],
        [
            'name'     => 'Admin',
            'email'    => 'admin@kooralive.info',
            'password' => 123456,
        ]);

        $user->syncPermissions($permissions);
    }
}
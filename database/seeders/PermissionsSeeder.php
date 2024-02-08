<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class PermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Create default permissions
        Permission::create(['name' => 'list cahiercharges']);
        Permission::create(['name' => 'view cahiercharges']);
        Permission::create(['name' => 'create cahiercharges']);
        Permission::create(['name' => 'update cahiercharges']);
        Permission::create(['name' => 'delete cahiercharges']);

        Permission::create(['name' => 'list compteurelecs']);
        Permission::create(['name' => 'view compteurelecs']);
        Permission::create(['name' => 'create compteurelecs']);
        Permission::create(['name' => 'update compteurelecs']);
        Permission::create(['name' => 'delete compteurelecs']);

        Permission::create(['name' => 'list compteurgazs']);
        Permission::create(['name' => 'view compteurgazs']);
        Permission::create(['name' => 'create compteurgazs']);
        Permission::create(['name' => 'update compteurgazs']);
        Permission::create(['name' => 'delete compteurgazs']);

        Permission::create(['name' => 'list contacts']);
        Permission::create(['name' => 'view contacts']);
        Permission::create(['name' => 'create contacts']);
        Permission::create(['name' => 'update contacts']);
        Permission::create(['name' => 'delete contacts']);

        Permission::create(['name' => 'list cpps']);
        Permission::create(['name' => 'view cpps']);
        Permission::create(['name' => 'create cpps']);
        Permission::create(['name' => 'update cpps']);
        Permission::create(['name' => 'delete cpps']);

        Permission::create(['name' => 'list entreprises']);
        Permission::create(['name' => 'view entreprises']);
        Permission::create(['name' => 'create entreprises']);
        Permission::create(['name' => 'update entreprises']);
        Permission::create(['name' => 'delete entreprises']);

        Permission::create(['name' => 'list historiques']);
        Permission::create(['name' => 'view historiques']);
        Permission::create(['name' => 'create historiques']);
        Permission::create(['name' => 'update historiques']);
        Permission::create(['name' => 'delete historiques']);

        Permission::create(['name' => 'list scores']);
        Permission::create(['name' => 'view scores']);
        Permission::create(['name' => 'create scores']);
        Permission::create(['name' => 'update scores']);
        Permission::create(['name' => 'delete scores']);

        Permission::create(['name' => 'list signatures']);
        Permission::create(['name' => 'view signatures']);
        Permission::create(['name' => 'create signatures']);
        Permission::create(['name' => 'update signatures']);
        Permission::create(['name' => 'delete signatures']);

        Permission::create(['name' => 'list sites']);
        Permission::create(['name' => 'view sites']);
        Permission::create(['name' => 'create sites']);
        Permission::create(['name' => 'update sites']);
        Permission::create(['name' => 'delete sites']);

        // Create user role and assign existing permissions
        $currentPermissions = Permission::all();
        $userRole = Role::create(['name' => 'user']);
        $userRole->givePermissionTo($currentPermissions);

        // Create admin exclusive permissions
        Permission::create(['name' => 'list roles']);
        Permission::create(['name' => 'view roles']);
        Permission::create(['name' => 'create roles']);
        Permission::create(['name' => 'update roles']);
        Permission::create(['name' => 'delete roles']);

        Permission::create(['name' => 'list permissions']);
        Permission::create(['name' => 'view permissions']);
        Permission::create(['name' => 'create permissions']);
        Permission::create(['name' => 'update permissions']);
        Permission::create(['name' => 'delete permissions']);

        Permission::create(['name' => 'list users']);
        Permission::create(['name' => 'view users']);
        Permission::create(['name' => 'create users']);
        Permission::create(['name' => 'update users']);
        Permission::create(['name' => 'delete users']);

        // Create admin role and assign all permissions
        $allPermissions = Permission::all();
        $adminRole = Role::create(['name' => 'super-admin']);
        $adminRole->givePermissionTo($allPermissions);

        $user = \App\Models\User::whereEmail('admin@admin.com')->first();

        if ($user) {
            $user->assignRole($adminRole);
        }
    }
}

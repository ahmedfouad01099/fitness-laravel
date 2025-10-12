<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create roles
        $adminRole = Role::create(['name' => 'admin', 'guard_name' => 'web']);
        $userRole = Role::create(['name' => 'user', 'guard_name' => 'web']);
        
        // Create permissions
        $permissions = [
            // User management permissions
            'view users',
            'create users',
            'edit users',
            'delete users',
            
            // Role management permissions
            'view roles',
            'create roles',
            'edit roles',
            'delete roles',
            
            // Permission management
            'view permissions',
            'create permissions',
            'edit permissions',
            'delete permissions',
            
            // Workout management permissions
            'view workouts',
            'create workouts',
            'edit workouts',
            'delete workouts',
            
            // Diet management permissions
            'view diets',
            'create diets',
            'edit diets',
            'delete diets',
            
            // Exercise management permissions
            'view exercises',
            'create exercises',
            'edit exercises',
            'delete exercises',
            
            // Dashboard permissions
            'view dashboard',
            'view analytics',
            
            // Settings permissions
            'view settings',
            'edit settings',
        ];
        
        // Create permissions
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission, 'guard_name' => 'web']);
        }
        
        // Assign all permissions to admin role
        $adminRole->givePermissionTo(Permission::all());
        
        // Assign basic permissions to user role
        $userRole->givePermissionTo([
            'view dashboard',
            'view workouts',
            'view diets',
            'view exercises',
        ]);
        
        $this->command->info('Roles and permissions created successfully!');
    }
}
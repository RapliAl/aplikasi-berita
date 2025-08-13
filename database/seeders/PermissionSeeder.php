<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        $permissions = [
            // Article permissions
            'view-articles',
            'create-articles', 
            'edit-articles',
            'delete-articles',
            'edit-own-articles',
            'delete-own-articles',
            
            // User permissions
            'view-users',
            'create-users',
            'edit-users',
            'delete-users',
            
            // Comment permissions
            'view-comments',
            'create-comments',
            'edit-comments',
            'delete-comments',
            'delete-any-comments',
            
            // Like permissions
            'create-likes',
            'view-likes',
            
            // Admin panel access
            'access-admin-panel',
            
            // Dashboard access
            'view-dashboard',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Create roles and assign permissions
        
        // Admin Role - Full access
        $adminRole = Role::firstOrCreate(['name' => 'Admin']);
        $adminRole->givePermissionTo(Permission::all());

        // Author Role - Article management + viewing
        $authorRole = Role::firstOrCreate(['name' => 'Author']);
        $authorRole->givePermissionTo([
            'view-articles',
            'create-articles',
            'edit-own-articles',
            'delete-own-articles',
            'view-comments',
            'view-likes',
            'access-admin-panel',
            'view-dashboard',
        ]);

        // Reader Role - Basic reading and interaction
        $readerRole = Role::firstOrCreate(['name' => 'Reader']);
        $readerRole->givePermissionTo([
            'view-articles',
            'create-comments',
            'create-likes',
            'view-comments',
            'view-likes',
        ]);
    }
}

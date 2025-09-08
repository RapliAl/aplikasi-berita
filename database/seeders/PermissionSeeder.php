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
            
            // Category permissions
            'view-categories',
            'create-categories',
            'edit-categories',
            'delete-categories',
            
            // Tag permissions
            'view-tags',
            'create-tags',
            'edit-tags',
            'delete-tags',
            
            // Comment permissions
            'view-comments',
            'create-comments',
            'edit-comments',
            'delete-comments',
            'delete-any-comments',
            
            // Banner permissions
            'view-banners',
            'create-banners',
            'edit-banners',
            'delete-banners',
            
            // Like permissions
            'create-likes',
            'view-likes',
            'delete-likes',
            
            // Role and Permission management
            'view-roles',
            'create-roles',
            'edit-roles',
            'delete-roles',
            'assign-roles',
            
            // Admin panel access
            'access-admin-panel',
            
            // Dashboard access
            'view-dashboard',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Create roles and assign permissions
        
        // Admin Role - Full access to everything
        $adminRole = Role::firstOrCreate(['name' => 'Admin']);
        $adminRole->syncPermissions(Permission::all());

        // Author Role - Article and Comment management only
        $authorRole = Role::firstOrCreate(['name' => 'Author']);
        $authorRole->syncPermissions([
            // Article permissions
            'view-articles',
            'create-articles',
            'edit-articles',
            'delete-articles',
            'edit-own-articles',
            'delete-own-articles',
            
            // Comment permissions
            'view-comments',
            'create-comments',
            'edit-comments',
            'delete-comments',
            'delete-any-comments',
            
            // Basic access
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

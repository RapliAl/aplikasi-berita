<?php

namespace App\Helpers;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserCreator
{
    /**
     * Create user with role
     */
    public static function create(string $name, string $email, string $password, string $roleName = 'Reader'): User
    {
        // Validate role exists
        $role = Role::where('name', $roleName)->first();
        if (!$role) {
            throw new \Exception("Role '{$roleName}' does not exist!");
        }

        // Create user
        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'email_verified_at' => now(),
        ]);

        // Assign role
        $user->assignRole($role);

        return $user;
    }

    /**
     * Create admin user
     */
    public static function createAdmin(string $name, string $email, string $password): User
    {
        return self::create($name, $email, $password, 'Admin');
    }

    /**
     * Create author user
     */
    public static function createAuthor(string $name, string $email, string $password): User
    {
        return self::create($name, $email, $password, 'Author');
    }

    /**
     * Create reader user
     */
    public static function createReader(string $name, string $email, string $password): User
    {
        return self::create($name, $email, $password, 'Reader');
    }

    /**
     * List all available roles
     */
    public static function listRoles(): array
    {
        return Role::pluck('name')->toArray();
    }

    /**
     * Quick create with default password
     */
    public static function quick(string $name, string $email, string $roleName = 'Reader'): User
    {
        return self::create($name, $email, 'password123', $roleName);
    }
}

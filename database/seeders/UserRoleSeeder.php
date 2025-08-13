<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Admin User
        $adminUser = User::firstOrCreate(
            ['email' => 'admin@aplikasi-berita.com'],
            [
                'name' => 'Admin User',
                'email' => 'admin@aplikasi-berita.com',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
            ]
        );
        $adminRole = Role::where('name', 'Admin')->first();
        if ($adminRole) {
            $adminUser->assignRole($adminRole);
        }

        // Create Author User
        $authorUser = User::firstOrCreate(
            ['email' => 'author@aplikasi-berita.com'],
            [
                'name' => 'Author User',
                'email' => 'author@aplikasi-berita.com',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
            ]
        );
        $authorRole = Role::where('name', 'Author')->first();
        if ($authorRole) {
            $authorUser->assignRole($authorRole);
        }

        // Create Reader User
        $readerUser = User::firstOrCreate(
            ['email' => 'reader@aplikasi-berita.com'],
            [
                'name' => 'Reader User',
                'email' => 'reader@aplikasi-berita.com',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
            ]
        );
        $readerRole = Role::where('name', 'Reader')->first();
        if ($readerRole) {
            $readerUser->assignRole($readerRole);
        }
    }
}

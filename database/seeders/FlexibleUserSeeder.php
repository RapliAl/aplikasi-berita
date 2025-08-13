<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class FlexibleUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Creating users with roles...');

        // Get available roles
        $roles = Role::pluck('name')->toArray();
        
        if (empty($roles)) {
            $this->command->error('No roles found! Please run PermissionSeeder first.');
            return;
        }

        $this->command->info('Available roles: ' . implode(', ', $roles));

        // Ask how many users of each role to create
        foreach ($roles as $roleName) {
            $count = $this->command->ask("How many {$roleName} users do you want to create?", 0);
            
            if ($count > 0) {
                $this->createUsersWithRole($roleName, (int)$count);
            }
        }

        $this->command->info('User creation completed!');
    }

    private function createUsersWithRole(string $roleName, int $count): void
    {
        $role = Role::where('name', $roleName)->first();
        
        for ($i = 1; $i <= $count; $i++) {
            $name = $this->command->ask("Enter name for {$roleName} #{$i}", fake()->name());
            $email = $this->command->ask("Enter email for {$name}", fake()->unique()->safeEmail());
            $password = $this->command->secret("Enter password for {$name}") ?: 'password123';

            try {
                $user = User::create([
                    'name' => $name,
                    'email' => $email,
                    'password' => Hash::make($password),
                    'email_verified_at' => now(),
                ]);

                $user->assignRole($role);

                $this->command->info("✓ Created {$roleName}: {$name} ({$email})");
            } catch (\Exception $e) {
                $this->command->error("✗ Failed to create {$name}: " . $e->getMessage());
            }
        }
    }
}

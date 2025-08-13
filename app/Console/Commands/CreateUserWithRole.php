<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CreateUserWithRole extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:create {--name=} {--email=} {--password=} {--role=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new user with a specific role';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->option('name') ?: $this->ask('What is the user name?');
        $email = $this->option('email') ?: $this->ask('What is the user email?');
        $password = $this->option('password') ?: $this->secret('What is the password?');
        $roleName = $this->option('role') ?: $this->choice('What role should this user have?', ['Admin', 'Author', 'Reader'], 'Reader');

        // Validate input
        $validator = Validator::make([
            'name' => $name,
            'email' => $email,
            'password' => $password,
        ], [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
        ]);

        if ($validator->fails()) {
            $this->error('Validation failed:');
            foreach ($validator->errors()->all() as $error) {
                $this->error($error);
            }
            return 1;
        }

        // Check if role exists
        $role = Role::where('name', $roleName)->first();
        if (!$role) {
            $this->error("Role '{$roleName}' does not exist!");
            return 1;
        }

        try {
            // Create user
            $user = User::create([
                'name' => $name,
                'email' => $email,
                'password' => Hash::make($password),
                'email_verified_at' => now(),
            ]);

            // Assign role
            $user->assignRole($role);

            $this->info("User '{$name}' created successfully with role '{$roleName}'!");
            $this->info("Email: {$email}");
            $this->info("Login credentials ready to use.");

            return 0;
        } catch (\Exception $e) {
            $this->error("Error creating user: " . $e->getMessage());
            return 1;
        }
    }
}

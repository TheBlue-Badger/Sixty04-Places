<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $email = 'michaeltererayi@gmail.com';

        if (User::where('email', $email)->exists()) {
            $this->command->warn("Admin user already exists ({$email}), skipping.");

            return;
        }

        $password = Str::password(20);

        $user = User::create([
            'name' => 'SIXTY04 Admin',
            'email' => $email,
            'password' => $password,
        ]);

        $user->is_admin = true;
        $user->save();

        $this->command->warn("Admin user created: {$email}");
        $this->command->warn("Generated password: {$password}");
        $this->command->warn('Save this now — it will not be shown again. Change it after first login.');
    }
}

<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CreateDevUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $email = env('DEV_USER_EMAIL');
        $password = env('DEV_USER_PASSWORD');

        $user = User::where('email', $email)->first();

        if (!$user) {
            User::create([
                'community_id' => 1,
                'name' => 'Usuário Dev',
                'code' => '17122004',
                'email' => $email,
                'password' => Hash::make($password),
                'access_type' => 'general_admin',
                'status' => 1,
            ]);

            $this->command->info('✅ Usuário de desenvolvedor criado com sucesso.');
        } else {
            $this->command->info('ℹ️ Usuário de desenvolvedor já existe, nenhuma ação necessária.');
        }
    }
}

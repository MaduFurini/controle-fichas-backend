<?php

namespace Database\Seeders;

use App\Models\Community;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CreateDevCommunitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $nameParish = 'Paróquia Dev';
        $nameCommunity = 'Comunidade Dev';

        $parish = Community::where('name', $nameParish)->first();
        $community = Community::where('name', $nameCommunity)->first();

        if (!$community && !$parish) {
            Community::create([
                'name' => $nameParish,
                'type' => 'parish',
                'street' => 'Rua teste',
                'city' => 'Itapira',
                'state' => 'SP',
                'zip_code' => '000000',
                'email_responsible' => env('DEV_USER_EMAIL'),
                'phone' => '19997633071',
                'status' => 1
            ]);

            $this->command->info('✅ Comunidades de desenvolvimento criada com sucesso.');
        } else {
            $this->command->info('ℹ️ Comunidades de desenvolvimento já existe, nenhuma ação necessária.');
        }
    }
}

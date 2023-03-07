<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ChatRoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\ChatRoom::create([
            'name' => 'General',
        ]);
        \App\Models\ChatRoom::create([
            'name' => 'Tech Talk',
        ]);
    }
}

<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Buat data user
        $users = [
            [
                'username' => 'admin',
                'password' => Hash::make('password'),
                'slug' => Str::slug('admin'),
                'email' => 'admin@example.com',
                'name' => 'Admin',
                'level' => 'admin',
            ],
            [
                'username' => 'user',
                'password' => Hash::make('password'),
                'slug' => Str::slug('user'),
                'email' => 'user@example.com',
                'name' => 'User',
                'level' => 'user',
            ],
        ];

        // Masukkan data user ke database
        DB::table('users')->insert($users);
        for ($i = 1; $i <= 21; $i++) {
            if ($i < 10) {
                $i = "0" . $i;
            }
            $gallery = [
                'name' => 'img' . $i . '.png',
                'path' => 'gallery/img' . $i . '.png',
                'user_id' => 1,
                'description' => 'Deskripsi galeri' . $i,
                // 'time_upload' => now(),
                'created_at' => Carbon::now(),
            ];

            // Masukkan data galeri ke database
            DB::table('galleries')->insert($gallery);
        }
    }
}

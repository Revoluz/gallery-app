<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Gallery;
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
                'username' => 'user1',
                'password' => Hash::make('password'),
                'slug' => Str::slug('user1'),
                'email' => 'user1@example.com',
                'name' => 'User1',
                'level' => 'user',
            ],
            [
                'username' => 'user2',
                'password' => Hash::make('password'),
                'slug' => Str::slug('user2'),
                'email' => 'user2@example.com',
                'name' => 'User2',
                'level' => 'user',
            ],
            [
                'username' => 'user3',
                'password' => Hash::make('password'),
                'slug' => Str::slug('user3'),
                'email' => 'user3@example.com',
                'name' => 'User3',
                'level' => 'user',
            ],
        ];

        // Masukkan data user ke database
        DB::table('users')->insert($users);
        // for ($i = 1; $i <= 21; $i++) {
        //     if ($i < 20) {
        //         $i = "0" . $i;
        //         $gallery['created_at']  = Carbon::now();
        //         $gallery['user_id']  = 1;
        //     }
        //     $gallery = [
        //         'name' => 'img' . $i . '.png',
        //         'path' => 'gallery/img' . $i . '.png',
        //         'user_id' => 1,
        //         'description' => 'Deskripsi galeri' . $i,
        //         // 'time_upload' => now(),
        //     ];

        //     // Masukkan data galeri ke database
        //     DB::table('galleries')->insert($gallery);
        // }

        for ($i = 1; $i <= 60; $i++) {

            $gallery = [
                'name' => 'img' . $i . '.jpg',
                'path' => 'gallery/img' . $i . '.jpg',
                'description' => 'Deskripsi galeri ' . $i,
            ];

            // Tentukan user_id dan created_at berdasarkan kondisinya
            if ($i < 36) {
                $gallery['user_id'] = 1;
                $gallery['created_at'] = Carbon::now();
            } elseif ($i <= 55) {
                $gallery['user_id'] = 2;
                $gallery['created_at'] = Carbon::now()->subMonth();
            } else {
                $gallery['user_id'] = 3;
                $gallery['created_at'] = Carbon::now()->subMonths(2);
            }

            // Masukkan data galeri ke database
            // Gallery::create($gallery);
            DB::table('galleries')->insert($gallery);
        }
    }
}

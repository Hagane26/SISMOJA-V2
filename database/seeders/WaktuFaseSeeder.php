<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use illuminate\Support\Str;
use illuminate\Support\Number;

class WaktuFaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('waktu_fases')->insert([
            'fase' => "1",
            'kali' => 2,
            'waktu' => 10,
            'ket' => 'Singkat'
        ]);

        DB::table('waktu_fases')->insert([
            'fase' => "1",
            'kali' => 2,
            'waktu' => 20,
            'ket' => 'Menengah'
        ]);

        DB::table('waktu_fases')->insert([
            'fase' => "1",
            'kali' => 2,
            'waktu' => 30,
            'ket' => 'Panjang'
        ]);

        DB::table('waktu_fases')->insert([
            'fase' => "A",
            'kali' => 2,
            'waktu' => 15,
            'ket' => 'Singkat'
        ]);

        DB::table('waktu_fases')->insert([
            'fase' => "A",
            'kali' => 2,
            'waktu' => 20,
            'ket' => 'Menengah'
        ]);

        DB::table('waktu_fases')->insert([
            'fase' => "A",
            'kali' => 2,
            'waktu' => 30,
            'ket' => 'Panjang'
        ]);

        DB::table('waktu_fases')->insert([
            'fase' => "B",
            'kali' => 2,
            'waktu' => 20,
            'ket' => 'Singkat'
        ]);

        DB::table('waktu_fases')->insert([
            'fase' => "B",
            'kali' => 2,
            'waktu' => 30,
            'ket' => 'Menengah'
        ]);

        DB::table('waktu_fases')->insert([
            'fase' => "B",
            'kali' => 2,
            'waktu' => 40,
            'ket' => 'Panjang'
        ]);

        DB::table('waktu_fases')->insert([
            'fase' => "C",
            'kali' => 2,
            'waktu' => 25,
            'ket' => 'Singkat'
        ]);

        DB::table('waktu_fases')->insert([
            'fase' => "C",
            'kali' => 2,
            'waktu' => 35,
            'ket' => 'Menengah'
        ]);

        DB::table('waktu_fases')->insert([
            'fase' => "C",
            'kali' => 2,
            'waktu' => 45,
            'ket' => 'Panjang'
        ]);

        DB::table('waktu_fases')->insert([
            'fase' => "D",
            'kali' => 2,
            'waktu' => 30,
            'ket' => 'Singkat'
        ]);

        DB::table('waktu_fases')->insert([
            'fase' => "D",
            'kali' => 2,
            'waktu' => 45,
            'ket' => 'Menengah'
        ]);

        DB::table('waktu_fases')->insert([
            'fase' => "D",
            'kali' => 2,
            'waktu' => 60,
            'ket' => 'Panjang'
        ]);

        DB::table('waktu_fases')->insert([
            'fase' => "E",
            'kali' => 2,
            'waktu' => 35,
            'ket' => 'Singkat'
        ]);

        DB::table('waktu_fases')->insert([
            'fase' => "E",
            'kali' => 2,
            'waktu' => 50,
            'ket' => 'Menengah'
        ]);

        DB::table('waktu_fases')->insert([
            'fase' => "E",
            'kali' => 2,
            'waktu' => 75,
            'ket' => 'Panjang'
        ]);

        DB::table('waktu_fases')->insert([
            'fase' => "F",
            'kali' => 2,
            'waktu' => 40,
            'ket' => 'Singkat'
        ]);

        DB::table('waktu_fases')->insert([
            'fase' => "F",
            'kali' => 2,
            'waktu' => 60,
            'ket' => 'Menengah'
        ]);

        DB::table('waktu_fases')->insert([
            'fase' => "F",
            'kali' => 2,
            'waktu' => 90,
            'ket' => 'Panjang'
        ]);
    }
}

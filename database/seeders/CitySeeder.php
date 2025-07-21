<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $timestamp = now();

        DB::table('cities')->insert([
            [
                'state_id' => 1,
                'name' => 'Semarang',
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ],
            [
                'state_id' => 2,
                'name' => 'Bandung',
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ],
            [
                'state_id' => 3,
                'name' => 'Jakarta',
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ],
            [
                'state_id' => 4,
                'name' => 'Shah Alam',
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ],
            [
                'state_id' => 5,
                'name' => 'Kuala Lumpur',
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ],
            [
                'state_id' => 6,
                'name' => 'Singapore City',
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ],
        ]);
    }
}

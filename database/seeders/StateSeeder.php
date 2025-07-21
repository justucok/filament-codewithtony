<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $timestamp = now();

        DB::table('states')->insert([
            [
                'country_id' => 1,
                'name' => 'Jawa Tengah',
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ],
            [
                'country_id' => 1,
                'name' => 'Jawa Barat',
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ],
            [
                'country_id' => 1,
                'name' => 'DKI Jakarta',
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ],
            [
                'country_id' => 2,
                'name' => 'Selangor',
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ],
            [
                'country_id' => 2,
                'name' => 'Kuala Lumpur',
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ],
            [
                'country_id' => 3,
                'name' => 'Singapore',
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ],
        ]);
    }
}

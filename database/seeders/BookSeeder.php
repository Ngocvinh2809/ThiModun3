<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('books')->insert([
            [
            'name' => "vinh",
            'book_id' => "1",
            'category' => "Vinh",
            'author' => "Văn",
            'number_page' => "1",
            'year' => "2022-10-06",
            ],
            [
            'name' => "Thuần",
            'book_id' => "1",
            'category' => "Thuần",
            'author' => "Văn",
            'number_page' => "1",
            'year' => "2022-11-06",
            ]
        ]);
    }
}

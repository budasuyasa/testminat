<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeedQuestion extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $question = [
            [
                'question' => 'Apakah kamu pemalu',
                'option' => [
                    'Ya',
                    'Tidak'
                ]
            ],
            [
                'question' => 'Apa yang mencerminkan kamu',
                'option' => [
                    'Periang',
                    'Penyendiri',
                    'Pembohon'
                ]
            ],
        ];

        foreach($question as $q){
            $questionId = DB::table('questions')->insertGetId([
                'question' => $q['question'],
            ]);

            foreach($q['option'] as $option){
                DB::table('question_options')->insert([
                    'question_id' => $questionId,
                    'option' => $option,
                ]);
            }
        }
    }
}

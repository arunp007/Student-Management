<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Section;
use App\Models\Student;
use App\Models\Classes;
use Illuminate\Database\Eloquent\Factories\Sequence;

class ClassesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        classes::factory()
        ->count(10)
        ->sequence((fn($sequence) => ['name' => 'Class'.$sequence->index + 1]))
        ->has(
            Section::factory()
            ->count(2)
            ->state(
                new Sequence(
                    ['name' => 'Section A'],
                    ['name' => 'Section B'],
                ),
            )

            ->has(
                Student::factory()
                ->count(5)
                ->state(
                    function (array $attributes, Section $section){
                        return ['class_id' => $section->class_id];
                    }
                )
            )
        )
        ->create();
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Profession;

class ProfessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach($this->data as $profession){
            $newProfession = Profession::create([
                'title' => $profession['title'],
                'color' => $profession['color'],
                'description' => $profession['description'],
                'group_type' => Profession::class,
            ]);
            if(!isset($profession['abilities'])){
                continue;
            }
            foreach($profession['abilities'] as $ability){
                $newProfession->abilities()->create($ability + [
                    'feature_type' => Profession::class,
                ]);
            }
        }
    }
    
    protected $data = [
        [
            'title' => 'Инженер',
            'description' => 'Умеет делать интересные и полезные вещи.',
            'color' => '#AF4D23',
            'abilities' => [
                [
                    'title' => 'Лыжи',
                    'description' => 'Изготавливает лыжи для быстрого передвижения по снегу.',
                    'color' => '#AF4D77',
                ],
                [
                    'title' => 'Парашют',
                    'description' => 'Изготавливает парашют.',
                    'color' => '#48A8AF',
                ],
            ]
        ],
        [
            'title' => 'Портной',
            'description' => 'Шьет одежду из ткани.',
            'color' => '#48A8F9',
            'abilities' => [
                [
                    'title' => 'Плащ',
                    'description' => 'Изготавливает плащ любого цвета.',
                    'color' => '#224F74',
                ],
            ]
        ],
        [
            'title' => 'Травник',
            'description' => 'Разбирается в травах. Умеет изготавливать лечебные снадобья.',
            'color' => '#2FB479',
            'abilities' => [
                [
                    'title' => 'Противоядие',
                    'description' => 'Легкое противоядие. Не спасает от змей.',
                    'color' => '#144D33',
                ],
            ]
        ],
        [
            'title' => 'Повар',
            'description' => 'Умеет готовить вкусную и полезную пищу.',
            'color' => '#FF5100',
            'abilities' => [
                [
                    'title' => 'Хлеб',
                    'description' => 'Вкусные сладкие булочки.',
                    'color' => '#686885',
                ],
                [
                    'title' => 'Уха',
                    'description' => 'Питательный суп из рыбы.',
                    'color' => '#B34EE9',
                ],
            ]
        ],
    ];
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Race;

class RaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach($this->data as $race){
            $newRace = Race::create([
                'title' => $race['title'],
                'color' => $race['color'],
                'description' => $race['description'],
                'group_type' => Race::class,
            ]);
            if(!isset($race['abilities'])){
                continue;
            }
            foreach($race['abilities'] as $ability){
                $newRace->abilities()->create($ability + [
                    'feature_type' => Race::class,
                ]);
            }
        }
    }
    
    protected $data = [
        [
            'title' => 'Таурен',
            'description' => 'Степная корова.',
            'color' => '#2FBB35',
            'abilities' => [
                [
                    'title' => 'Дрожь земли',
                    'description' => 'Топчет ногами землю, вызывая легкое землятрясение.',
                    'color' => '#000000',
                ],
                [
                    'title' => 'Дикий крик',
                    'description' => 'Производит громкий победный клич.',
                    'color' => '#CCFF18',
                ],
            ]
        ],
        [
            'title' => 'Человек',
            'description' => 'Живет в горах. Гулп, но смел.',
            'color' => '#853E10',
            'abilities' => [
                [
                    'title' => 'Лидерство',
                    'description' => 'Вдохновляет союзников.',
                    'color' => '#3318CA',
                ],
            ]
        ],
        [
            'title' => 'Эльф',
            'description' => 'Создание леса. Живет до 1000 лет.',
            'color' => '#FF5CE7',
            'abilities' => [
                [
                    'title' => 'Вуаль ночи',
                    'description' => 'Ночью может становится невидимым.',
                    'color' => '#888789',
                ],
            ]
        ],
        [
            'title' => 'Орк',
            'description' => 'Степное существо. Большое и злое.',
            'color' => '#148053',
            'abilities' => [
                [
                    'title' => 'Берсерк',
                    'description' => 'Не чувствует боль.',
                    'color' => '#AF0000',
                ],
                [
                    'title' => 'Лучший воин',
                    'description' => 'Владеет любым оружием.',
                    'color' => '#1F6044',
                ],
            ]
        ],
        [
            'title' => 'Гном',
            'description' => 'Карлик, живущий в горах.',
            'color' => '#F019FF',
            'abilities' => [
                [
                    'title' => 'Писклявый голос',
                    'description' => 'Поражает врагов низким звуком.',
                    'color' => '#FFC48C',
                ],
                [
                    'title' => 'Торговец',
                    'description' => 'Его не так легко провести.',
                    'color' => '#FFC123',
                ],
            ]
        ],
    ];
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\WarClass;

class WarClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach($this->data as $warclass){
            $newRace = WarClass::create([
                'title' => $warclass['title'],
                'color' => $warclass['color'],
                'description' => $warclass['description'],
                'group_type' => WarClass::class,
            ]);
            if(!isset($warclass['abilities'])){
                continue;
            }
            foreach($warclass['abilities'] as $ability){
                $newRace->abilities()->create($ability + [
                    'feature_type' => WarClass::class,
                ]);
            }
        }
    }
    
    protected $data = [
        [
            'title' => 'Разбойник',
            'description' => 'Нападает из тени. Владеет ядом.',
            'color' => '#000000',
            'abilities' => [
                [
                    'title' => 'Воришка',
                    'description' => 'Обворовывает карманы на приличную сумму.',
                    'color' => '#9ECC21',
                ],
                [
                    'title' => 'Плащ теней',
                    'description' => 'Прыгает в тень и растворяется там.',
                    'color' => '#656565',
                ],
            ]
        ],
        [
            'title' => 'Жрец',
            'description' => 'Священник. Лечит союзников.',
            'color' => '#9D9D9D',
            'abilities' => [
                [
                    'title' => 'Воскрешение',
                    'description' => 'Воскрешает любого персонажа с половиной здоровья.',
                    'color' => '#FF0068',
                ],
            ]
        ],
        [
            'title' => 'Воин',
            'description' => 'Владеет мечом и щитом или двуручным мечом.',
            'color' => '#9D1219',
            'abilities' => [
                [
                    'title' => 'Вихрь',
                    'description' => 'Умеет поражать сразу всех врагов поблизости.',
                    'color' => '#763C7A',
                ],
            ]
        ],
        [
            'title' => 'Шаман',
            'description' => 'Управляет природой и стихиями.',
            'color' => '#19199A',
            'abilities' => [
                [
                    'title' => 'Удар молнии',
                    'description' => 'Ударяет врага молнией с ошеломляющим эффектом.',
                    'color' => '#B8CEF0',
                ],
                [
                    'title' => 'Гроза',
                    'description' => 'Напускает непогоду на область.',
                    'color' => '#768C14',
                ],
            ]
        ],
    ];
}

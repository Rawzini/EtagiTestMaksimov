<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tasks')->insert([
            'title' => 'Похвалить себя',
            'description' => 'Каждый шаг по направлению к достижению своих целей, даже самый мелкий, заслуживает похвалы, так ты достигнешь необходимой мотивации.',
            'expirationDate' => '2020-12-04 13:00:00',
            'dateOfCreation' => '2020-11-01 13:00:00',
            'updateDate' => '2020-11-01 13:00:00',
            'priority' => 'high',
            'status' => 'completed',
            'creator_id' => '1',
            'responsible_id' => '1',
        ]);

        DB::table('tasks')->insert([
            'title' => 'Написать тестовое задание',
            'description' => 'Написать тестовое задание, используя фреймворк laravel и библиотеку ReactJS',
            'expirationDate' => '2020-12-07 13:00:00',
            'dateOfCreation' => '2020-11-28 13:00:00',
            'updateDate' => '2020-12-06 19:43:00',
            'priority' => 'high',
            'status' => 'completed',
            'creator_id' => '1',
            'responsible_id' => '2',
        ]);

        DB::table('tasks')->insert([
            'title' => 'Купить ксерокс',
            'description' => 'Вещь нужная!',
            'expirationDate' => '2020-12-07 01:00:00',
            'dateOfCreation' => '2020-11-11 00:00:00',
            'updateDate' => '2020-12-06 19:43:00',
            'priority' => 'high',
            'status' => 'completed',
            'creator_id' => '1',
            'responsible_id' => '2',
        ]);


        DB::table('tasks')->insert([
            'title' => 'Прочитать "Властелин колец" в оригинале',
            'description' => 'Нет лучшего способа заставить мозг работать настолько усердно, что аж кончается кислород в крови, чем изучение иностранного языка!',
            'expirationDate' => '2021-01-07 01:00:00',
            'dateOfCreation' => '2020-11-11 00:00:00',
            'updateDate' => '2020-12-06 19:43:00',
            'priority' => 'high',
            'status' => 'completed',
            'creator_id' => '1',
            'responsible_id' => '5',
        ]);

        DB::table('tasks')->insert([
            'title' => 'Прибраться на рабочем месте',
            'description' => 'Выкинуть чахлый кактус и перебрать бумаги',
            'expirationDate' => '2020-11-02 13:00:00',
            'dateOfCreation' => '2020-11-01 13:00:00',
            'updateDate' => '2020-11-01 13:00:00',
            'priority' => 'low',
            'status' => 'not completed',
            'creator_id' => '1',
            'responsible_id' => '5',
        ]);

        DB::table('tasks')->insert([
            'title' => 'Купить новогоднюю елку',
            'description' => 'Без ёлки Новый Год - просто отстой! Обязательно нужно купить ёлку!',
            'expirationDate' => '2020-12-31 18:00:00',
            'dateOfCreation' => '2020-12-31 13:00:00',
            'updateDate' => '2020-11-01 13:00:00',
            'priority' => 'high',
            'status' => 'not completed',
            'creator_id' => '1',
            'responsible_id' => '2',
        ]);

        DB::table('tasks')->insert([
            'title' => 'Сдать куртку в химчистку',
            'description' => 'Найти самую выгодную химчистку и сдать туда куртку',
            'expirationDate' => '2020-12-20 13:00:00',
            'dateOfCreation' => '2020-11-01 13:00:00',
            'updateDate' => '2020-11-01 13:00:00',
            'priority' => 'medium',
            'status' => 'not completed',
            'creator_id' => '2',
            'responsible_id' => '3',
        ]);

        DB::table('tasks')->insert([
            'title' => 'Заняться йогой для укрепления тела и духа',
            'description' => 'В здоровом теле - здоровый дух!',
            'expirationDate' => '2020-12-07 13:00:00',
            'dateOfCreation' => '2020-12-06 13:00:00',
            'updateDate' => '2020-11-01 13:00:00',
            'priority' => 'high',
            'status' => 'completed',
            'creator_id' => '2',
            'responsible_id' => '2',
        ]);

        DB::table('tasks')->insert([
            'title' => 'Придумать какими данными заполнить тестовую таблицу',
            'description' => 'Нужно сесть и написать набор данных для заполнения тестовой базы данных, чтобы иметь возможность тестировать функции',
            'expirationDate' => '2020-12-12 13:00:00',
            'dateOfCreation' => '2020-11-01 13:00:00',
            'updateDate' => '2020-11-01 13:00:00',
            'priority' => 'high',
            'status' => 'not completed',
            'creator_id' => '2',
            'responsible_id' => '3',
        ]);

        DB::table('tasks')->insert([
            'title' => 'Сделать домашку по матеше',
            'description' => 'математику уже затем учить надо, что она ум в порядок приводит, сиди, делай!',
            'expirationDate' => '2020-12-13 13:00:00',
            'dateOfCreation' => '2020-11-01 13:00:00',
            'updateDate' => '2020-11-01 13:00:00',
            'priority' => 'high',
            'status' => 'completed',
            'creator_id' => '5',
            'responsible_id' => '6',
        ]);

        DB::table('tasks')->insert([
            'title' => 'Сформировать таблицу по химчисткам',
            'description' => 'Найти самую выгодную химчистку',
            'expirationDate' => '2020-12-13 13:00:00',
            'dateOfCreation' => '2020-11-01 13:00:00',
            'updateDate' => '2020-11-01 13:00:00',
            'priority' => 'high',
            'status' => 'completed',
            'creator_id' => '3',
            'responsible_id' => '4',
        ]);

        DB::table('tasks')->insert([
            'title' => 'Придумать какими данными заполнить тестовую таблицу',
            'description' => 'Все понятно!',
            'expirationDate' => '2020-12-13 13:00:00',
            'dateOfCreation' => '2020-11-01 13:00:00',
            'updateDate' => '2020-11-01 13:00:00',
            'priority' => 'high',
            'status' => 'completed',
            'creator_id' => '3',
            'responsible_id' => '4',
        ]);
    }
}

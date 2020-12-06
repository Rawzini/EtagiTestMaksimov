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
            'title' => 'Похвалить себя за то, какой я молодец',
            'description' => 'Каждый шаг по направлению к достижению своих целей, даже самый мелкий, заслуживает похвалы. Хвали себя чаще, так ты достигнешь необходимой мотивации.',
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
            'expirationDate' => '2020-12-04 13:00:00',
            'dateOfCreation' => '2020-11-01 13:00:00',
            'updateDate' => '2020-11-01 13:00:00',
            'priority' => 'high',
            'status' => 'not completed',
            'creator_id' => '1',
            'responsible_id' => '2',
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
            'responsible_id' => '2',
        ]);

        DB::table('tasks')->insert([
            'title' => 'Сходить за хлебом',
            'description' => 'Купить булку Бородинского',
            'expirationDate' => '2020-12-20 13:00:00',
            'dateOfCreation' => '2020-11-01 13:00:00',
            'updateDate' => '2020-11-01 13:00:00',
            'priority' => 'high',
            'status' => 'completed',
            'creator_id' => '2',
            'responsible_id' => '3',
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
            'title' => 'Сформировать таблицу по химчисткам',
            'description' => 'Найти самую выгодную химчистку',
            'expirationDate' => '2020-12-10 13:00:00',
            'dateOfCreation' => '2020-11-01 13:00:00',
            'updateDate' => '2020-11-01 13:00:00',
            'priority' => 'high',
            'status' => 'not completed',
            'creator_id' => '3',
            'responsible_id' => '4',
        ]);

        DB::table('tasks')->insert([
            'title' => 'Придумать какими данными заполнить тестовую таблицу',
            'description' => 'Нужно сесть и написать набор для заполнения тестовой базы данных, чтобы имметь возможность тестировать функции',
            'expirationDate' => '2020-12-12 13:00:00',
            'dateOfCreation' => '2020-11-01 13:00:00',
            'updateDate' => '2020-11-01 13:00:00',
            'priority' => 'high',
            'status' => 'not completed',
            'creator_id' => '1',
            'responsible_id' => '5',
        ]);

        DB::table('tasks')->insert([
            'title' => 'Сделать домашку по матеше',
            'description' => 'математику уже затем учить надо, что она ум в порядок приводит',
            'expirationDate' => '2020-12-13 13:00:00',
            'dateOfCreation' => '2020-11-01 13:00:00',
            'updateDate' => '2020-11-01 13:00:00',
            'priority' => 'high',
            'status' => 'completed',
            'creator_id' => '5',
            'responsible_id' => '6',
        ]);
    }
}

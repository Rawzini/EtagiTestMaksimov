<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Иван',
            'surname' => 'Иванов',
            'patronymic' => 'Иванович',
            'login' => 'ivan',
            'password' => Hash::make('11111111'),
            'leader_id' => '1',
        ]);

        DB::table('users')->insert([
            'name' => 'Петр',
            'surname' => 'Петров',
            'patronymic' => 'Петрович',
            'login' => 'petr',
            'password' => Hash::make('11111111'),
            'leader_id' => '1',
        ]);

        DB::table('users')->insert([
            'name' => 'Василий',
            'surname' => 'Васильев',
            'patronymic' => 'Васильевич',
            'login' => 'vasya',
            'password' => Hash::make('11111111'),
            'leader_id' => '2',
        ]);

        DB::table('users')->insert([
            'name' => 'Евгений',
            'surname' => 'Евгеньев',
            'patronymic' => 'Евгеньевич',
            'login' => 'zhenya',
            'password' => Hash::make('11111111'),
            'leader_id' => '3',
        ]);

        DB::table('users')->insert([
            'name' => 'Александр',
            'surname' => 'Александров',
            'patronymic' => 'Александрович',
            'login' => 'sasha',
            'password' => Hash::make('11111111'),
            'leader_id' => '1',
        ]);

        DB::table('users')->insert([
            'name' => 'Ибрагим',
            'surname' => 'Ибрагимов',
            'patronymic' => 'Ибрагимович',
            'login' => 'ibra',
            'password' => Hash::make('11111111'),
            'leader_id' => '5',
        ]);
    }
}

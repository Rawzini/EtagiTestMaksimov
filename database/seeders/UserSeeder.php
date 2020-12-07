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
            'name' => 'Эльдар',
            'surname' => 'Джарахов',
            'patronymic' => 'Иванович',
            'login' => 'superELDAR',
            'password' => Hash::make('11111111'),
            'leader_id' => null,
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
            'name' => 'Кин',
            'surname' => 'По',
            'patronymic' => 'Ан',
            'login' => 'kin',
            'password' => Hash::make('11111111'),
            'leader_id' => '2',
        ]);

        DB::table('users')->insert([
            'name' => 'Евгений',
            'surname' => 'Петросян',
            'patronymic' => 'Ваганович',
            'login' => 'zhenya',
            'password' => Hash::make('11111111'),
            'leader_id' => '3',
        ]);

        DB::table('users')->insert([
            'name' => 'Ибрагим',
            'surname' => 'Ибрагимов',
            'patronymic' => 'Ибрагимович',
            'login' => 'ibra',
            'password' => Hash::make('11111111'),
            'leader_id' => '1',
        ]);

        DB::table('users')->insert([
            'name' => 'Александр',
            'surname' => 'Александров',
            'patronymic' => 'Александрович',
            'login' => 'sasha',
            'password' => Hash::make('11111111'),
            'leader_id' => '5',
        ]);
    }
}

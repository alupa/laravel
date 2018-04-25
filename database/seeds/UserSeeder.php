<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //$professions = DB::select('SELECT id FROM professions WHERE title = ? LIMIT 0,1', ["Desarrollador back-end"]);
        //dd($professions[0]->id);

        //$professions = DB::table('professions')->select('id')->take(1)->get();
        //dd($professions->first()->id);

        //$profession = DB::table('professions')->select('id')->first();
        //dd($profession->id);

        $professionId = DB::table('professions')
            //->select('id')
            ->whereTitle('Desarrollador back-end')
            // OR ->where('title', 'Desarrollador back-end')
            // OR ->where(['title' => 'Desarrollador back-end'])
            ->value('id');
        //dd($professionId);

        DB::table('users')->insert([
            'name' => 'Alvaro',
            'email' => 'alvaro.lupa@gmail.com',
            'password' => bcrypt('secret'),
            'profession_id' => $professionId
        ]);
    }
}

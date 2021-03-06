<?php

use App\Profession;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //DB::insert('insert into professions (title) values (?)', ['Desarrollador back-end']);
        /*DB::insert('insert into professions (title) values (:title)', [
            'title' => 'Desarrollador back-end',
        ]);*/

        /*DB::table('professions')->insert([
            'title' => 'Desarrollador back-end',
        ]);*/

        Profession::create([
            'title' => 'Desarrollador back-end',
        ]);

        Profession::create([
            'title' => 'Desarrollador front-end',
        ]);

        Profession::create([
            'title' => 'Diseñador web',
        ]);

        factory(Profession::class)->times(17)->create(); 
    }
}

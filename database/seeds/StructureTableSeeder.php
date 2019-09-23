<?php

use Illuminate\Database\Seeder;

//追加
use Illuminate\Support\Facades\DB;
class StructureTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param=[
            'structure'=>'title'
        ];
        DB::table('structures')->insert($param);


        $param=[
            'structure'=>'paragraph'
        ];
        DB::table('structures')->insert($param);

        $param=[
            'structure'=>'letter'
        ];
        DB::table('structures')->insert($param);

        $param=[
            'structure'=>'c_letter'
        ];
        DB::table('structures')->insert($param);

        $param=[
            'structure'=>'s_letter'
        ];
        DB::table('structures')->insert($param);
        
        $param=[
            'structure'=>'img'
        ];
        DB::table('structures')->insert($param);
/*
        $param=[
            'structure'=>'a_href'
        ];
        DB::table('structures')->insert($param);
        
        $param=[
            'structure'=>'a_letter'
        ];
        DB::table('structures')->insert($param);
*/
    }
}

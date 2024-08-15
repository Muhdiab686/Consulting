<?php

namespace Database\Seeders;

use App\Models\Typeconsulting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeConsultingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('typeconsultings')->delete();
        $cons = ['medical_consulting','family_consulting','professional_consulting','psychological_consulting','mangement_consulting'];
        foreach($cons as $con){
        $aa = new Typeconsulting();
        $aa->name = $con ;
        $aa->save();
        }
    }
}

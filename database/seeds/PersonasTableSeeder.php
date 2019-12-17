<?php

use Illuminate\Database\Seeder;

use Faker\Factory as Faker;
//Para usar faker y poder genedad datos falsos
class PersonasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $faker = Faker::create();
      for ($i=0; $i < 100 ; $i++) {
        \DB::table('personas')->insert(array(

          'ci'=> (18534878+$i),
          'nombre' => $faker-> firstNameFemale,
          'ap_paterno' => $faker -> lastName,
          'ap_materno' => $faker -> lastName,
          'fecha_nacimiento' => $faker -> date($format = 'Y-m-d', $max = 'now'),
          'email' => $faker -> email,
          'created_at' => date('Y-m-d H:m:s'),
          'updated_at' => date('Y-m-d H:m:s')

        ));
      }
    }
}

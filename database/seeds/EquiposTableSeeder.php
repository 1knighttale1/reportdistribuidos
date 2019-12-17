<?php

use Illuminate\Database\Seeder;

class EquiposTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      for($i=0;$i<16;$i++){
        $p=new App\Persona;
        $p->nombre='persona'.$i;
        $p->ap_paterno='p'.$i;
        $p->ap_materno='m'.$i;
        $p->ci=(1234567+$i);
        $p->fecha_nacimiento='1995-05-'.($i+1);
        $p->email='persona'.$i.'@gmail.com';
        $p->save();

        $d=new App\Delegado;
        $d->user='delegado'.$i;
        $d->password='delegado'.$i;
        $d->persona_id=$p->id;
        $d->save();

        $e=new App\Equipo;
        $e->nombre_equipo='equipo'.($i+1);
        $e->color='color'.($i+1);
        $e->delegado_id=$d->id;
        $e->save();
      }
    }
}

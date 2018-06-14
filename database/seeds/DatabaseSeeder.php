<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Materia;
use App\Prueba;
use App\Tag;
use App\Sede;
use App\Laboratorio;
use App\Item;
use App\Retiro;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

    	User::create([
    		'name' => 'Franco',
            'email' => 'vare.franco@gmail.com',
            'password' => bcrypt('password'),
            'esAdmin' => true
    	]);

        User::create([
            'name' => 'Carlitox',
            'email' => 'carli@to.x',
            'password' => bcrypt('password'),
        ]);


        Materia::create([
            'nombre' => 'Teoria de Control'
        ]);
        Materia::create([
            'nombre' => 'Robotica'
        ]);
        Materia::create([
            'nombre' => 'Paradigmas de la programacion'
        ]);


        Prueba::create([
            'nombre' => 'Desbloquear/Loguearse'
        ]);
        Prueba::create([
            'nombre' => 'Dar descripcion especifica'
        ]);
        Prueba::create([
            'nombre' => 'Enumerar contenidos'
        ]);


        Tag::create([
            'nombre' => 'Smartphone'
        ]);
        Tag::create([
            'nombre' => 'Notebook'
        ]);
        Tag::create([
            'nombre' => 'Campera'
        ]);
        Tag::create([
            'nombre' => 'Paraguas'
        ]);
        Tag::create([
            'nombre' => 'Pendrive'
        ]);

        DB::table('prueba_tag')->insert([
            'tag_id' => 1,
            'prueba_id' => 1
        ]);
        DB::table('prueba_tag')->insert([
            'tag_id' => 1,
            'prueba_id' => 2
        ]);
        DB::table('prueba_tag')->insert([
            'tag_id' => 2,
            'prueba_id' => 1
        ]);
        DB::table('prueba_tag')->insert([
            'tag_id' => 2,
            'prueba_id' => 2
        ]);
        DB::table('prueba_tag')->insert([
            'tag_id' => 2,
            'prueba_id' => 3
        ]);
        DB::table('prueba_tag')->insert([
            'tag_id' => 3,
            'prueba_id' => 2
        ]);
        DB::table('prueba_tag')->insert([
            'tag_id' => 4,
            'prueba_id' => 2
        ]);
        DB::table('prueba_tag')->insert([
            'tag_id' => 5,
            'prueba_id' => 2
        ]);
        DB::table('prueba_tag')->insert([
            'tag_id' => 3,
            'prueba_id' => 3
        ]);


        Sede::create([
            'nombre' => 'Medrano',
            'direccion' => 'Av. Medrano 951'
        ]);
        Sede::create([
            'nombre' => 'Campus',
            'direccion' => 'Mozart 2300'
        ]);


        Laboratorio::create([
            'nombre' => 'Rojo',
            'sede_id' => 1
        ]);
        Laboratorio::create([
            'nombre' => 'Azul',
            'sede_id' => 1
        ]);
        Laboratorio::create([
            'nombre' => 'Verde',
            'sede_id' => 1
        ]);
        Laboratorio::create([
            'nombre' => 'WorkGroup Lab 1',
            'sede_id' => 1
        ]);
        Laboratorio::create([
            'nombre' => 'Interactivo',
            'sede_id' => 1
        ]);
        Laboratorio::create([
            'nombre' => 'WorkGroup Lab 2',
            'sede_id' => 2
        ]);
        Laboratorio::create([
            'nombre' => 'Campus',
            'sede_id' => 2
        ]);

        factory(Item::class,120)->create();
        $retiros = factory(Retiro::class,12)->make();

        foreach ($retiros as $retiro) {
            repeat:
            try {
                $retiro->save();
            } catch (\Illuminate\Database\QueryException $e) {
                $retiro = factory(App\Retiro::class)->make();
                goto repeat;
            }
        }
    }
}

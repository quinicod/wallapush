<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Image;
use Faker\Generator as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        DB::table('categorias')->insert([
            'nombre' => 'Moda y Accesorios',
        ]);
        DB::table('categorias')->insert([
            'nombre' => 'Moviles y Telefonia',
        ]);
        DB::table('categorias')->insert([
            'nombre' => 'Electrodomésticos',
        ]);
        DB::table('users')->insert([
            'name'      => 'Quino',
            'email'     => 'joaquinguzmangarciaplata@gmail.com',
            'localidad' => 'Sanlucar de barrameda',
            'email_verified_at' => '2019-02-13 00:00:00.000000',
            'password'  => bcrypt('123456'),
            'actived'   => 1
        ]);
        DB::table('users')->insert([
            'name'      => 'Cristian',
            'email'     => 'crisguerredina@gmail.com',
            'localidad' => 'Cadiz',
            'email_verified_at' => '2019-02-13 00:00:00.000000',
            'password'  => bcrypt('123456'),
            'actived'   => 1
        ]);
        DB::table('users')->insert([
            'name'      => 'Robe',
            'email'     => 'roberto.leon.armario@gmail.com',
            'localidad' => 'San fernando',
            'email_verified_at' => '2019-02-13 00:00:00.000000',
            'password'  => bcrypt('123456'),
            'actived'   => 1
        ]);
        DB::table('users')->insert([
            'name'      => 'Admin',
            'email'     => 'admin@admin.com',
            'localidad' => 'Cadiz',
            'email_verified_at' => '2019-02-13 00:00:00.000000',
            'password'  => bcrypt('123456'),
            'role'      => 'admin',
            'actived'   => 1
        ]);

        DB::table('users')->insert([
            'name'      => 'Prueba',
            'email'     => 'prueba@prueba.com',
            'localidad' => 'Cadiz',
            'email_verified_at' => '2019-02-13 00:00:00.000000',
            'password'  => bcrypt('123456'),
            'actived'   => 1
        ]);

        $anuncios = factory(\App\Anuncio::class, 25)->create();
        foreach($anuncios as $s){
            for ($i = 0; $i < 4; $i++){
                Image::create([
                    'id_anuncio' => $s->id,
                    'img' => $faker->image('storage/app/anuncios',400,300,null,false)
                ]);
            }
        }
    }
}

























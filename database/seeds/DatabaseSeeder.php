<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
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
            'name' => 'Quino',
            'email' => 'joaquinguzmangarciaplata@gmail.com',
            'localidad' => 'Sanlucar de barrameda',
            'password' => bcrypt('123456'),
        ]);
        DB::table('users')->insert([
            'name' => 'Cristian',
            'email' => 'crisguerredina@gmail.com',
            'localidad' => 'Cadiz',
            'password' => bcrypt('123456'),
        ]);
        DB::table('users')->insert([
            'name' => 'Robe',
            'email' => 'roberto.leon.armario@gmail.com',
            'localidad' => 'San fernando',
            'password' => bcrypt('123456'),
        ]);
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'localidad' => 'Cadiz',
            'password' => bcrypt('123456'),
            'role' => 'admin',
        ]);

        factory(\App\Anuncio::class, 50)->create();
    }
}

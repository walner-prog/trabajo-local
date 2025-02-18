<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;
class CategorySeeder extends Seeder
{
    /**
     * Ejecuta los seeders de la base de datos.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            'Electricistas',
            'Fontaneros',
            'Carpinteros',
            'Pintores',
            'Limpiadores',
            'Mecánicos',
            'Albañiles',
            'Techos',
            'Jardineros',
            'Arquitectos',
            'Contratistas',
            'Técnicos',
            'Soldadores',
            'Mudanzas',
            'Diseñadores de interiores',
            'Trabajadores de construcción',
            'Manitas',
            'Diseñadores gráficos',
            'Profesionales IT',
            'Consultores',
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category,
                'description' => 'Categoría para ' . strtolower($category),
                'slug' => Str::slug($category),
            ]);
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use App\Models\User;

class ProveedorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear roles
        $adminRole = Role::create(['name' => 'admin']);
        $proveedorRole = Role::create(['name' => 'proveedor']);
        $clientRole = Role::create(['name' => 'client']);

        $especialidades = [
            'Abogado', 'Arquitecto', 'Ingeniero', 'Médico', 'Plomero',
            'Electricista', 'Chef', 'Profesor', 'Diseñador Gráfico', 'Fotógrafo'
        ];

        $ciudades = ['Managua', 'León', 'Granada', 'Masaya', 'Chinandega', 'Matagalpa', 'Estelí', 'Jinotepe', 'Bluefields', 'Rivas'];

        // Recorremos los arrays con los datos
        foreach ($especialidades as $index => $especialidad) {
            // Crear usuario con rol proveedor
            $user = User::create([
                'name' => "Proveedor " . ($index + 1),
                'email' => "proveedor" . ($index + 1) . "@example.com",
                'password' => Hash::make('password'),
                'role' => 'proveedor',
              
                'avatar' => null,
                'registered' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Asignar el rol 'proveedor' al usuario
            $user->assignRole('proveedor');

            // Crear proveedor relacionado al usuario
            DB::table('proveedores')->insert([
                'user_id' => $user->id,  // Usamos el ID del usuario creado
                'specialty' => $especialidad,
                'city' => $ciudades[$index],
                'experience_years' => rand(1, 20),
                'phone' => '505' . rand(60000000, 89999999),
                'bio' => 'Soy un profesional con experiencia en ' . strtolower($especialidad),
                'location' => null,
                'certifications' => Str::random(10),
                'education' => 'Universidad Nacional',
                'languages' => 'Español, Inglés',
                'average_rating' => rand(3, 5),
                'reviews_count' => rand(1, 50),
                'verified' => (bool)rand(0, 1),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}

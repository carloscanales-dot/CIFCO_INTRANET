<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Area;
use App\Models\Cargo;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;

class FirstUserSeeder extends Seeder
{
    public function run(): void
    {
        // Crear o obtener area
        $area = Area::firstOrCreate(['nombre' => 'Unidad de Informatica']);

        // Crear o obtener cargo
        $cargo = Cargo::firstOrCreate(['nombre' => 'Tecnico Programador Analista']);

        // Crear usuario Carlos (si no existe) o actualizar campos si existe
        $user = User::firstOrCreate(
            ['email' => 'carlos.canales@cifco.gob.sv'],
            [
                'name' => 'Carlos Enrique Canales Lopez',
                'password' => bcrypt('12345678'),
                'sexo' => 'M',
                'fecha_nacimiento' => '2003-02-09',
                'telefono' => '7851-0218',
                'area_id' => $area->id,
                'cargo_id' => $cargo->id,
            ]
        );

        // Asegurar actualización de campos en caso de que el usuario ya existiera
        $user->update([
            'name' => 'Carlos Enrique Canales Lopez',
            'sexo' => 'M',
            'fecha_nacimiento' => '2003-02-09',
            'telefono' => '7851-0218',
            'area_id' => $area->id,
            'cargo_id' => $cargo->id,
        ]);

        // Asignar rol Administrador (debe existir por RolesAndPermissionsSeeder)
        $role = Role::where('name', 'Administrador')->first();
        if ($role) {
            $user->assignRole($role);
        }
    }
}

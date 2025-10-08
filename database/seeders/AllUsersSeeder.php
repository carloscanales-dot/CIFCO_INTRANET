<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Area;
use App\Models\Cargo;
use Carbon\Carbon;
use Illuminate\Support\Str;

class AllUsersSeeder extends Seeder
{
    public function run(): void
    {
        $path = storage_path('app/usuarios.csv'); // ruta del CSV
        if (!file_exists($path)) {
            $this->command->error("Archivo usuarios.csv no encontrado en storage/app/");
            return;
        }

        if (($handle = fopen($path, 'r')) !== false) {
            // Leer primera fila como encabezados
            $header = fgetcsv($handle, 1000, ';');
            $header = array_map(function ($h) {
                return strtolower(trim(str_replace([' ', '-'], '_', $h)));
            }, $header);

            while (($data = fgetcsv($handle, 1000, ';')) !== false) {
                $row = array_combine($header, $data);

                // Buscar Área existente por nombre
                $area = Area::where('nombre', $row['area'])->first();
                if (!$area) {
                    $this->command->warn("Área '{$row['area']}' no encontrada. Usuario '{$row['nombre']}' será ignorado.");
                    continue; // saltar si no existe
                }

                // Buscar Cargo existente por nombre
                $cargo = Cargo::where('nombre', $row['cargo_nominal_en_sir_h'])->first();
                if (!$cargo) {
                    $this->command->warn("Cargo '{$row['cargo_nominal_en_sir_h']}' no encontrado. Usuario '{$row['nombre']}' será ignorado.");
                    continue; // saltar si no existe
                }

                // Fecha de nacimiento (puede ser null)
                $fecha_nacimiento = null;
                if (!empty($row['fecha_de_nacimiento'])) {
                    try {
                        $fecha_nacimiento = Carbon::createFromFormat('d/m/Y', $row['fecha_de_nacimiento'])->format('Y-m-d');
                    } catch (\Exception $e) {
                        $fecha_nacimiento = null;
                    }
                }

                $email = !empty($row['correo'])
                    ? $row['correo']
                    : Str::slug($row['nombre']) . '@noemail.local';

                $telefono = !empty(trim($row['telefono'] ?? ''))
                    ? trim($row['telefono'])
                    : null;
                // Crear o actualizar usuario con rol_id = 2
                User::updateOrCreate(
                    ['email' => $email],
                    [
                        'name' => $row['nombre'],
                        'email' => $email,
                        'password' => bcrypt('12345678'),
                        'sexo' => $row['sexo'] ?? null,
                        'fecha_nacimiento' => $fecha_nacimiento ?? null,
                        'telefono' => $telefono,
                        'area_id' => $area->id,
                        'cargo_id' => $cargo->id,
                        // 'role_id' => 2, // asigna el rol 2 a todos
                        'remember_token' => Str::random(10),
                        'email_verified_at' => now(),
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]
                );
            }

            fclose($handle);
        }
    }
}

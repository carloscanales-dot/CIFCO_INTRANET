<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cargo;

class CargosSeeder extends Seeder
{
    public function run()
    {
         $path = storage_path('app/usuarios.csv'); // ruta del CSV
        if (!file_exists($path)) {
            $this->command->error("Archivo usuarios.csv no encontrado en storage/app/");
            return;
        }

        if (($handle = fopen($path, 'r')) !== false) {
            $header = fgetcsv($handle, 1000, ';'); // usa ;
            $header = array_map(function ($h) {
                return strtolower(trim(str_replace([' ', '-'], '_', $h)));
            }, $header);


            $cargos = [];

            while (($data = fgetcsv($handle, 1000, ';')) !== false) {
                $row = array_combine($header, $data);

                if (!empty($row['cargo_nominal_en_sir_h'])) {
                    $cargos[] = trim($row['cargo_nominal_en_sir_h']);
                }
            }
            fclose($handle);

            // Quitar duplicados
            $cargos = collect($cargos)->unique();

            $insertados = 0;

            foreach ($cargos as $nombreCargo) {
                $cargo = Cargo::firstOrCreate(['nombre' => $nombreCargo]);
                if ($cargo->wasRecentlyCreated) {
                    $insertados++;
                }
            }

            $this->command->info("Se insertaron $insertados cargos únicos.");
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Area;

class AreaSeeder extends Seeder
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


            $areas = [];

            while (($data = fgetcsv($handle, 1000, ';')) !== false) {
                $row = array_combine($header, $data);

                if (!empty($row['area'])) {
                    $areas[] = trim($row['area']);
                }
            }
            fclose($handle);

            // Quitar duplicados
            $areas = collect($areas)->unique();

            $insertados = 0;

            foreach ($areas as $nombreArea) {
                $area = Area::firstOrCreate(['nombre' => $nombreArea]);
                if ($area->wasRecentlyCreated) {
                    $insertados++;
                }
            }

            $this->command->info("Se insertaron $insertados áreas únicas.");
        }
    }
}

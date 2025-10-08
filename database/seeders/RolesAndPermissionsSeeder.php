<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Permisos iniciales (puedes ajustarlos luego)
        $permissions = [
            'manage users',
            'view reports',
            'edit profile',
        ];

        foreach ($permissions as $perm) {
            Permission::firstOrCreate(['name' => $perm, 'guard_name' => 'web']);
        }

        // Roles
        $admin = Role::firstOrCreate(['name' => 'Administrador', 'guard_name' => 'web']);
        $empleado = Role::firstOrCreate(['name' => 'Empleado', 'guard_name' => 'web']);

        // Asignar los mismos permisos a ambos roles por ahora
        $allPerms = Permission::whereIn('name', $permissions)->get();
        $admin->syncPermissions($allPerms);
        $empleado->syncPermissions($allPerms);

        // Asignar rol Administrador al primer usuario creado (si existe)
        $user = User::where('email', 'carlos.canales@cifco.gob.sv')->first();
        if ($user) {
            $user->assignRole($admin);
        }
    }
}

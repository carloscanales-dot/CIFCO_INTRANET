<?php

namespace App\Http\Controllers;
use Inertia\Inertia;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $usuarios = User::select('id', 'name', 'fecha_nacimiento', 'sexo', 'url_foto', 'area_id', 'cargo_id')->get();

        return Inertia::render('Dashboard', [
            'usuarios' => \App\Models\User::with(['area:id,nombre', 'cargo:id,nombre'])->get()
        ]);

    }
}

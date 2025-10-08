<?php

namespace App\Http\Controllers;
use Inertia\Inertia;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $usuarios = User::select('id', 'name', 'fecha_nacimiento', 'sexo')->get();

        return Inertia::render('Dashboard', [
            'usuarios' => $usuarios
        ]);
    }
}

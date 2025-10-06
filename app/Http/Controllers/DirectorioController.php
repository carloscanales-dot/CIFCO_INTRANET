<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DirectorioController extends Controller
{
    public function index(Request $request)
    {
        // Eager load area and cargo to avoid N+1 and select needed fields
        $users = User::with(['area:id,nombre','cargo:id,nombre'])
            ->select('id','name','email','telefono','area_id','cargo_id')
            ->get()
            ->map(function($u){
                return [
                    'id' => $u->id,
                    'name' => $u->name,
                    'email' => $u->email,
                    'telefono' => $u->telefono,
                    'area' => $u->area ? $u->area->nombre : null,
                    'cargo' => $u->cargo ? $u->cargo->nombre : null,
                ];
            });

        return Inertia::render('Directorio', [
            'users' => $users,
        ]);
    }
}

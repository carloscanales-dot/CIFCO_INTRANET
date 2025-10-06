<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;

class DocumentoController extends Controller
{
    public function index(Request $request)
    {
        $grupos = DB::table('grupos_normativa')->orderBy('id')->get();
        $categorias = DB::table('categorias_normativa')->orderBy('grupo_id')->orderBy('id')->get();
        $documentos = DB::table('documentos_normativa')->orderBy('categoria_id')->orderBy('id')->get();

        return Inertia::render('Documento', [
            'grupos' => $grupos,
            'categorias' => $categorias,
            'documentos' => $documentos,
        ]);
    }
}

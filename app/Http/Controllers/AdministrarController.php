<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class AdministrarController extends Controller
{
    public function index()
    {
        return Inertia::render('Administrar');
    }
}
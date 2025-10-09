<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;

class UserManagementController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->get();

        return Inertia::render('Admin/UserManagement', [
            'users' => $users,
        ]);
    }
}
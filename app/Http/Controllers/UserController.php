<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function usuarios() {
        $users = User::all();
        $is_admin = Auth::id();

        return view('admin.gestao', compact('users', 'is_admin'));
    }
}

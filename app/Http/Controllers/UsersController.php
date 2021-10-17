<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::query()
            ->orderBy('first_name')
            ->orderBy('last_name')
            ->paginate();

        return view('users', compact('users'));
    }
}

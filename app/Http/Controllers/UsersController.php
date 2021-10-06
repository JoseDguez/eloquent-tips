<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::query()
            ->with('company')
            ->search(request(['name','company']))
            ->paginate();

        return view('users', compact('users'));
    }
}

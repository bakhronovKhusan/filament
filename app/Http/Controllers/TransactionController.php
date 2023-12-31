<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index(User $user)
    {
        return response()->json($user->transactions);
    }
}

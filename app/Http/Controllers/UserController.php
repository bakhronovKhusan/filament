<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function credit(Request $request, User $user)
    {
        $amount = $request->input('amount');
        $user->credit($amount);

        return response()->json(['message' => 'Amount credited successfully']);
    }

    public function debit(Request $request, User $user)
    {
        $amount = $request->input('amount');
        $user->debit($amount);

        return response()->json(['message' => 'Amount debited successfully']);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use App\Models\User;

class RegisterStepTwoController extends Controller
{
    public function create(){
        return view('auth.register2');
    }

    public function store(Request $request){

        // Access the newly created user via Fortify (implementation details might vary)
        $user = auth()->user(); // Assuming Fortify logs in the user after step 1

        $user->update([
            'role'=>$request->input('role'),
            'degree' => $request->input('degree'),
            'year' => $request->input('year'),
            'category' => $request->input('year'),
        ]); // Update with additional fields

        return redirect()->route('home');
    }
}

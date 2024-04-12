<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Actions\Fortify\PasswordValidationRules;
use Laravel\Jetstream\Jetstream;

use Laravel\Fortify\Contracts\CreatesNewUsers;



class RegisterStepOneController extends Controller
{
//    use PasswordValidationRules;

    public function toResponse(Request $request): RegisterResponse
    {
        $user = $this->toResponse($request);

        dd('correct');

        // Your logic for handling successful or failed registration
        return redirect()->route('register2.create'); // Redirect example
    }
    
//
//    public function store(Request $request)
//    {
//
//    // Forget the 'registrationData' session key
//    session()->forget('registrationData',$validatedData);
//    
//    // Validate user data from the first form
//    $validatedData = $request->validate([
//            'name' => ['required', 'string', 'max:255'],
//            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
//            'password' => $this->passwordRules(),
//            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
//    ]);
//
//    // Store validated data in session
//    session()->put('registrationData', $validatedData);
//
//    return redirect()->route('register2.create');  // Redirect to second step
//    }

}

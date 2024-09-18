<?php

namespace App\Http\Requests\Auth;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'confirmed', 'min:8'],
        ];
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @return \App\Models\User
     */
    
    public function register()
    {
        $user = User::create([
            'username' => $this->input('username'),
            'email' => $this->input('email'),
            'password' => Hash::make($this->input('password')),
        ]);

        event(new Registered($user));

        return $user;
    }
}

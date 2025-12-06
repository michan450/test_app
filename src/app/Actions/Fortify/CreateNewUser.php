<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use App\Http\Requests\UserRegisterRequest;

class CreateNewUser implements CreatesNewUsers
{
    public function create(array $input)
    {
        // FormRequestでバリデーション
        $request = new UserRegisterRequest();
        $request->merge($input);       // 入力をセット
        $validated = $request->validate($request->rules());

        return User::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);
    }
}

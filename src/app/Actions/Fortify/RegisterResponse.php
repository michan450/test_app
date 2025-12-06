<?php

namespace App\Actions\Fortify;

use Laravel\Fortify\Contracts\RegisterResponse;
use Illuminate\Http\JsonResponse;

class CustomRegisterResponse implements RegisterResponse
{
    public function toResponse($request)
    {
        
        return redirect()->route('login');
    }
}

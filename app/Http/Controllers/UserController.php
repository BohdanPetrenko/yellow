<?php

namespace App\Http\Controllers;

use App\DataObjects\UserRegisterData;
use App\Http\Resources\UserRegisterResource;
use App\Services\User\RegisterService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    /**
     * @throws ValidationException
     */
    public function register(Request $request, RegisterService $registerService)
    {
        $this->validate($request, [
            'first_name' => 'required',
            'last_name'  => 'required|string',
            'email'      => 'required|email',
            'password'   => 'required|string',
            'phone'      => 'required|regex:/\+?\d+/m',
        ]);

        $data = UserRegisterData::fromRequest($request->all());
        $user = $registerService->register($data);

        return UserRegisterResource::make($user)->response()->setStatusCode(201);
    }
}
<?php

namespace App\Http\Controllers;

use App\DataObjects\UserRegisterData;
use App\Http\Resources\UserResource;
use App\Services\User\RegisterService;
use App\Services\User\UserService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    /**
     * @throws ValidationException
     */
    public function register(Request $request, UserService $registerService)
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

        return UserResource::make($user)->response()->setStatusCode(Response::HTTP_CREATED);
    }
}
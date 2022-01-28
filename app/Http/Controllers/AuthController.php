<?php

namespace App\Http\Controllers;

use App\Http\Resources\SignInResource;
use App\Services\User\UserService;
use App\ValueObject\PasswordObject;
use Illuminate\Auth\Passwords\PasswordBrokerManager;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function generateResetToken(Request $request): JsonResponse
    {
        $this->validate($request, ['email' => 'required|email']);

        $passwordBrokerManager = new PasswordBrokerManager(app());
        $response              = $passwordBrokerManager->sendResetLink(
            $request->only('email')
        );

        return $response == Password::RESET_LINK_SENT
            ? response()->json(true)
            : response()->json(false);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function resetPassword(Request $request): JsonResponse
    {
        $rules = [
            'token'    => 'required',
            'password' => 'required|confirmed|min:6',
        ];
        $this->validate($request, $rules);

        $passwordBrokerManager = new PasswordBrokerManager(app());
        $response              = $passwordBrokerManager->reset(
            $request->only('password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->password = (new PasswordObject($password))->getHashed();
                $user->save();
            }
        );

        return $response == Password::PASSWORD_RESET
            ? response()->json(true)
            : response()->json(false);
    }

    /**
     * @param Request     $request
     * @param UserService $userService
     * @return SignInResource|JsonResponse
     * @throws ValidationException
     */
    public function signIn(Request $request, UserService $userService)
    {
        $this->validate($request, [
            'email'    => 'required|exists:users,email',
            'password' => 'required',
        ]);

        $credentials = request(['email', 'password']);
        $userService->isUserPassword($request->input('email'), $request->input('password'));
        $token = auth()->attempt($credentials);

        if (!$token) {
            return response()->json(['error' => 'Unauthorized'], Response::HTTP_UNAUTHORIZED);
        }

        return SignInResource::make($token);
    }
}
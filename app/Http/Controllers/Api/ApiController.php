<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CreateTokenUserRequest;
use App\Models\User;
use Illuminate\Validation\ValidationException;

/**
 * Class ApiController
 *
 * @package App\Http\Controllers\Api
 */
class ApiController extends Controller
{
    /**
     * @param CreateTokenUserRequest $request
     * @param User $user
     *
     * @return string
     * @throws ValidationException
     */
    public function createToken(CreateTokenUserRequest $request, User $user): string
    {
        $user = $user->findUserByEmail($request->get('email'));

        if ($user) {
            $checkedPassword = $user->checkPassword($request->get('password'));
        }

        if (!$user || !$checkedPassword) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        return $user->createToken($user->name)->plainTextToken;
    }
}

<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\API\BaseApiController;
use App\Services\API\User\UserService;

class UserController extends BaseApiController
{
    protected UserService $userService;

    public function __construct()
    {
        $this->userService = new UserService();
    }

    public function show($id)
    {
        if (!($data = $this->userService->find($id))) {
            return $this->sendError('User not found', [], 404);
        }

        return $this->sendSuccess($data);
    }
}

<?php


namespace App\Http\Controllers\API\User;


use App\Http\Controllers\Controller;
use App\Services\API\User\UserService;

class UserController extends Controller
{
    protected UserService $userService;
    protected $statusCode;

    public function __construct()
    {
        $this->userService = new UserService();
        $this->statusCode = 200;
    }

    public function show($id)
    {
        $data = $this->userService->find($id);

        return response()->json($data, $this->statusCode);
    }
}

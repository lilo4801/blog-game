<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\API\BaseApiController;
use App\Services\API\User\PostService;

class PostController extends BaseApiController
{
    protected PostService $postService;

    public function __construct()
    {
        $this->postService = new PostService();
    }

    public function getRecentPost($page = 1)
    {
        $data = $this->postService->getRecentPost();
        return $this->sendSuccess($data);
    }
}

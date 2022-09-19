<?php


namespace App\Services\API\User;


use App\Models\User;

class UserService
{
    public function find(int $id)
    {
        $user = User::with('follows', 'favoriteGames')->find($id);
        $data = [];

        if (!$user) {
            $data = ['message' => 'User not found'];
        } else {
            $data = [
                'data' => [
                    'name' => $user->fullname,
                    'email' => $user->email,
                    'avatar' => $user->avatar,
                    'numberOfFollowers' => count($user->follows),
                    'favoriteGames' => $user->favoriteGames->map(function ($favoriteGame) {
                        return $favoriteGame->game->title;
                    })->toArray(),
                ],
            ];
        }

        return $data;
    }
}

<?php

namespace App\Services\API\User;

use App\Models\User;

class UserService
{
    /**
     * @param int $id
     * @return array
     */
    public function find(int $id): array
    {
        $user = User::with('follows', 'favoriteGames')->find($id);
        $data = [];

        if ($user) {
            $data = [
                'name' => $user->fullname,
                'email' => $user->email,
                'avatar' => $user->avatar,
                'numberOfFollowers' => count($user->follows),
                'favoriteGames' => $user->favoriteGames->map(function ($favoriteGame) {
                    return $favoriteGame->game->title;
                })->toArray(),

            ];
        }

        return $data;
    }
}

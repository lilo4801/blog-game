<?php

namespace App\Services;

use App\Models\FavoriteGame;
use App\Models\Game;
use Illuminate\Support\Facades\Auth;

class FavoriteGameService
{
    public function favoritegames()
    {
        return FavoriteGame::all();
    }

    public function findFGamesbyUserId(int $user_id)
    {
        return FavoriteGame::where('user_id', $user_id)->get();
    }

    public function create($arr): array
    {
        if (empty($arr)) {
            return ['success' => false, 'message' => __('Failed to create Game')];
        }

        $data = [];

        foreach ($arr as $value) {
            $data[] = ['user_id' => Auth::user()->id, 'game_id' => $value];
        }

        try {
            FavoriteGame::insert($data);

            return ['success' => true, 'message' => __('Game has been created')];
        } catch (Exception $e) {
            return ['success' => false, 'message' => __('Failed to create Game')];
        }
    }

    public function remove(int $id): array
    {
        try {
            $favoriteGame = FavoriteGame::where('id', $id)->delete();

            if (!$favoriteGame) {
                return ['success' => false, 'message' => __('game not found in favorite game')];
            }

            return ['success' => true, 'message' => __('game has been remove from favorite game')];
        } catch (Exception $e) {
            return ['success' => false, 'message' => __('Failed to remove game from favorite game')];
        }
    }
}

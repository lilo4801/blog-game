<?php


namespace App\Services;


use App\Models\Game;

class GameService
{
    public function create(string $title, string  $avatar,int $adminId) :array {
        try {

            Game::create([
                'title' =>  $title,
                'image'  => $avatar,
                'admin_id' => $adminId
            ]);
            return ['success' => true, 'message' => __('Game has been created')];
        } catch (Exception $e) {
            return ['success' => false, 'message' => __('Failed to create Game')];
        }
    }
    public function games() {
        return Game::all();
    }
}

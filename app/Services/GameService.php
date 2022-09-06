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

    public function find (int $id) {
        return Game::find($id);
    }

    public function update(string $title,string $image,int $adminId,int $gameId) {
        try {
            if ($image == '') {
                $game = Game::where('id', $gameId)->update([
                    'title' => $title,
                    'admin_id' => $adminId,
                ]);
            }else{
                $game = Game::where('id', $gameId)->update([
                    'title' => $title,
                    'image' => $image,
                    'admin_id' => $adminId,
                ]);
            }


            if (!$game) {
                return ['success' => false, 'message' => __('Game not found')];
            }
            return ['success' => true, 'message' => __('Game has been updated')];
        } catch (Exception $e) {
            return ['success' => false, 'message' => __('Something went wrong')];
        }
    }

    public function delete(int $gameId) : array {
        try {
            $game = Game::where('id', $gameId)->delete();
            if (!$game) {
                return ['success' => false, 'message' => __('Game not found')];
            }
            return ['success' => true, 'message' => __('Game has been deleted')];
        } catch (Exception $e) {
            return ['success' => false, 'message' => __('Something went wrong')];
        }
    }

}

<?php

namespace App\Services;

use App\Models\Game;

class GameService
{
    public function hanldeFileAndGetFileName($fileImg): string
    {
        $filename = '';

        if ($fileImg) {
            $file = $fileImg;
            $filename = $file->getClientOriginalName();

            if (!file_exists(storage_path('public/image/game/' . $filename))) {
                $file->move(public_path('image/game'), $filename);
            }
        }

        return $filename;
    }

    public function create(array $data, int $adminId): array
    {
        try {
            Game::create([
                'title' => $data['title'],
                'image' => $this->hanldeFileAndGetFileName($data['image']),
                'admin_id' => $adminId,
            ]);
            return ['success' => true, 'message' => __('Game has been created')];
        } catch (Exception $e) {
            return ['success' => false, 'message' => __('Failed to create Game')];
        }
    }

    public function games()
    {
        return Game::all();
    }

    public function find(int $id)
    {
        return Game::find($id);
    }

    public function update(array $data, int $adminId, int $gameId)
    {
        $image = $this->hanldeFileAndGetFileName($data['image']);

        try {
            if ($image === '') {
                $game = Game::where('id', $gameId)->update([
                    'title' => $data['title'],
                    'admin_id' => $adminId,
                ]);
            } else {
                $game = Game::where('id', $gameId)->update([
                    'title' => $data['title'],
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

    public function delete(int $gameId): array
    {
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

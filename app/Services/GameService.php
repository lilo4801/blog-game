<?php

namespace App\Services;

use App\Models\Game;
use Illuminate\Support\Facades\Auth;

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

    public function create(array $data): array
    {
        try {
            Game::create([
                'title' => $data['title'],
                'image' => $this->hanldeFileAndGetFileName($data['image']),
                'admin_id' => Auth::guard('admin')->user()->id,
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

    public function update(array $data, int $gameId)
    {
        try {
            if (!isset($data['image'])) {
                $game = Game::where('id', $gameId)->update([
                    'title' => $data['title'],
                    'admin_id' => Auth::guard('admin')->user()->id,
                ]);
            } else {
                $image = $this->hanldeFileAndGetFileName($data['image']);
                $game = Game::where('id', $gameId)->update([
                    'title' => $data['title'],
                    'image' => $image,
                    'admin_id' => Auth::guard('admin')->user()->id,
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

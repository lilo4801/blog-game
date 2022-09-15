<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserService extends GeneralService
{

    public function find(int $id)
    {
        return User::find($id);
    }

    public function updateImg(array $data): array
    {
        try {
            data_get($data, 'avatar') &&
            data_set($data, 'avatar', $this->hanldeFileAndGetFileName(data_get($data, 'avatar'), USER_DIR));

            $result = User::where('id', Auth::user()->id)->update($data);

            if (!$result) {
                return ['success' => false, 'message' => __('User not found')];
            }

            return ['success' => true, 'message' => __('User has been updated')];
        } catch (\Exception $e) {
            return ['success' => false, 'message' => __('Something went wrong')];
        }
    }

    public function updateInfo(array $data): array
    {
        try {
            $result = User::where('id', Auth::user()->id)->update($data);

            if (!$result) {
                return ['success' => false, 'message' => __('User not found')];
            }

            return ['success' => true, 'message' => __('User has been updated')];
        } catch (\Exception $e) {
            return ['success' => false, 'message' => __('Something went wrong')];
        }
    }
}

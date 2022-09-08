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
            if (isset($data['avatar'])) {
                $user = User::where('id', Auth::user()->id)->update([
                    'avatar' => $this->hanldeFileAndGetFileName($data['avatar'], USER_DIR),
                ]);

                if (!$user) {
                    return ['success' => false, 'message' => __('User not found')];
                }
            }

            return ['success' => true, 'message' => __('User has been updated')];
        } catch (\Exception $e) {
            return ['success' => false, 'message' => __('Something went wrong')];
        }
    }

    public function updateInfo(array $data): array
    {
        try {
            $user = User::where('id', Auth::user()->id)->update([
                'fullname' => $data['fullname'],
                'address' => $data['address'],
                'dob' => $data['dob'],
            ]);

            if (!$user) {
                return ['success' => false, 'message' => __('User not found')];
            }

            return ['success' => true, 'message' => __('User has been updated')];
        } catch (\Exception $e) {
            return ['success' => false, 'message' => __('Something went wrong')];
        }
    }
}

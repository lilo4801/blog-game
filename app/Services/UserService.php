<?php


namespace App\Services;


use App\Models\User;

class UserService
{
    public function find(int $id)
    {
        return User::find($id);
    }

    public function updateImg(int $id, string $avatar): array
    {
        try {
            $user = User::where('id', $id)->update([
                'avatar' => $avatar
            ]);

            if (!$user) {
                return ['success' => false, 'message' => __('User not found')];
            }
            return ['success' => true, 'message' => __('User has been updated')];
        } catch (\Exception $e) {
            return ['success' => false, 'message' => __('Something went wrong')];
        }
    }

    public function updateInfo(int $id, string $fullname, string $address, string $dob)
    {
        try {
            $user = User::where('id', $id)->update([
                'fullname' => $fullname,
                'address' => $address,
                'dob' => $dob,
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

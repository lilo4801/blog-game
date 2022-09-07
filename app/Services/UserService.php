<?php


namespace App\Services;


use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserService
{
    public function hanldeFileAndGetFileName($fileImg): string
    {
        $filename = '';

        if ($fileImg) {
            $file = $fileImg;
            $filename = $file->getClientOriginalName();

            if (!file_exists(storage_path('public/image/avatar/' . $filename))) {
                $file->move(public_path('image/avatar'), $filename);
            }
        }

        return $filename;
    }

    public function find(int $id)
    {
        return User::find($id);
    }

    public function updateImg(array $data): array
    {
        try {
            if (isset($data['avatar'])) {
                $user = User::where('id', Auth::user()->id)->update([
                    'avatar' => $this->hanldeFileAndGetFileName($data['avatar']),
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

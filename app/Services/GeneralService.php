<?php


namespace App\Services;


class GeneralService
{
    public function hanldeFileAndGetFileName($fileImg,$path): string
    {
        $filename = '';

        if ($fileImg) {
            $file = $fileImg;
            $filename = $file->getClientOriginalName();

            if (!file_exists(public_path($path) . $filename)) {
                $file->move(public_path($path), $filename);
            }
        }

        return $filename;
    }
}

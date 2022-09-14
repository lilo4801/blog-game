<?php


namespace App\Services;


use App\Models\Post;
use App\Models\Report;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReportService
{
    public function reports()
    {
        return Report::with('user')->get();
    }

    public function create(array $arr): array
    {
        $arr['user_id'] = Auth::user()->id;
        try {
            Report::create($arr);
            return ['success' => true, 'message' => 'Report has been report'];
        } catch (\Exception $e) {
            return ['success' => false, 'message' => 'Failed to create report'];
        }
    }
}

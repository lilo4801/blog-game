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

    public function update(array $arr): array
    {
        DB::beginTransaction();
        try {

            $result = Report::find($arr['report_id']);
            $result->update([
                'status' => $arr['status'],
            ]);
            if (data_get($arr, 'status', -99) == 1) {
                $resultPost = Post::find($result->post_id)->delete();
                if (!$resultPost) {
                    return ['success' => false, 'message' => __('Post is not found')];
                }
            }

            if (!$result) {
                return ['success' => false, 'message' => __('Report is not found')];
            }
            DB::commit();
            return ['success' => true, 'message' => __('Report has been created')];
        } catch (Exception $e) {
            DB::rollBack();
            return ['success' => false, 'message' => __('Failed to create Report')];
        }
    }
}

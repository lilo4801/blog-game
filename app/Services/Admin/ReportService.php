<?php


namespace App\Services\Admin;


use App\Enums\StatusReportType;
use App\Models\Post;
use App\Models\Report;
use Illuminate\Support\Facades\DB;

class ReportService
{
    public function update(array $arr): array
    {
        DB::beginTransaction();

        try {
            $result = Report::find($arr['report_id']);
            $result->update([
                'status' => $arr['status'],
            ]);

            if (data_get($arr, 'status', -99) == StatusReportType::ACCEPT) {
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

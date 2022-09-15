<?php


namespace App\Services\Admin;


use App\Enums\StatusReportType;
use App\Models\Post;
use App\Models\Report;
use App\Services\PostService;
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

            if ((int)data_get($arr, 'status', -99) === StatusReportType::ACCEPT) {
                $resultPost = (new PostService())->remove($result->post_id);

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

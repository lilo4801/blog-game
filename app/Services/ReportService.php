<?php


namespace App\Services;


use App\Models\Report;
use Illuminate\Support\Facades\Auth;

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
        try {
            $result = Report::find($arr['report_id'])->update([
                'status' => $arr['status'],
            ]);

            if (!$result) {
                return ['success' => false, 'message' => __('Report is not found')];
            }

            return ['success' => true, 'message' => __('Report has been created')];
        } catch (Exception $e) {
            return ['success' => false, 'message' => __('Failed to create Report')];
        }
    }
}

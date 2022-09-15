<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateReportRequest;
use App\Services\Admin\ReportService;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    protected ReportService $reportService;

    public function __construct()
    {
        $this->reportService = new ReportService();
    }

    public function update(UpdateReportRequest $request)
    {
        $res = $this->reportService->update($request->validated());
        return redirect()->route('admin.home')->with('msg', $res['message']);
    }
}

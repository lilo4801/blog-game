<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReportRequest;
use App\Http\Requests\UpdateReportRequest;
use App\Services\ReportService;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    protected ReportService $reportService;

    public function __construct()
    {
        $this->reportService = new ReportService();
    }

    public function create($post_id)
    {
        return view('report.create')->with('post_id', $post_id);
    }

    public function store(StoreReportRequest $request)
    {

        $res = $this->reportService->create($request->validated());
        return redirect()->route('home')->with('msg', $res['message']);
    }

    public function update(UpdateReportRequest $request)
    {
        $res = $this->reportService->update($request->validated());
        return redirect()->route('admin.home')->with('msg', $res['message']);
    }

}

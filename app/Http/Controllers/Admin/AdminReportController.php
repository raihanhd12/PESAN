<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Report;
use App\Models\Tracker;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Models\Activity;
use Yajra\DataTables\Facades\DataTables;

class AdminReportController extends Controller
{
    public function index()
    {

        $report = Report::latest()->get();
        return view('Admin.Report.index', [
            'report' => $report
        ]);
    }

    public function show($id_report)
    {
        $report = Report::where('id', $id_report)->first();

        $tracker = Tracker::where('report_id', $id_report)->first();

        $category = Category::latest()->get();

        return view('Admin.Report.show', [
            'report' => $report,
            'tracker' => $tracker,
            'category' => $category,
        ]);
    }



    public function update(Request $request, $id_report)
    {
        
        $report = Report::where('id', $id_report)->first();

        $report->update([
            'category_id' => $request->category_id,
            'status' => $request->status,

        ]);

         Tracker::create([
            'user_id' => Auth::guard()->user()->id,
            'report_id' => $request->report_id,
            'status' => $request->status,
            'note' => $request->note
        ]);

        return redirect()->back()->with(['status' => 'Berhasil dikirim!']);

    }
    public function edit($id_report)
    {

        $tracker = Tracker::where('report_id', $id_report)->first();

        return view('Admin.Report.edit', [
            'tracker' => $tracker,
            'logs' => Activity::where('subject_type', Report::class)->where('subject_id', $id_report)->latest()->get()
        ]);
    }


    public function destroy($id_report)
    {
    }
}

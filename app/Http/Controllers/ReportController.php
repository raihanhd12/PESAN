<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\Report;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\UpdateReportRequest;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $reports = Report::query();
            return DataTables::of($reports)
                ->addIndexColumn()
                ->addColumn('action', function ($item) {
                    $button =   '<div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Action
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Edit</a></li>
                                    <li><a class="dropdown-item" href="#">Delete</a></li>
                                </ul>
                            </div> ';
                    return $button;
                })
                ->addColumn('reporter_name', function ($report) {
                    return $report->reporter->name;
                })
                ->addColumn('category_name', function ($report) {
                    return
                        optional($report->category)->name;
                })
                ->editColumn('title', function ($item) {
                    return Str::limit($item->title, 25, '...');
                })
                ->editColumn('reporter_name', function ($report) {
                    return Str::limit($report->reporter->name, 30, '...');
                })
                ->make();
        }
        return view('user.dashboard_laporan');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.laporan',[
            "report" => Report::latest()->get()
        ]);
        // $report = Report::find(1)->getFirstMedia('images')->getUrl();
        // dd($report);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();

        Validator::make($data, [
            'description' => ['required'],
        ]);

        date_default_timezone_set('Asia/Bangkok');

        $date = new DateTime('now');
        $number = 0;
        $ticket_id = $date->format('Ymd') . str_pad($number + 1, 6, "0", STR_PAD_LEFT);

        $report = Report::create([
            'reporter_id' => $data['reporter_id'],
            'ticket_id' => $ticket_id,
            'title' => $data['title'],
            'description' => $data['description'],
            'status' => 'Pending',
        ]);
        $report->addMediaFromRequest('image')->toMediaCollection('images');

        if ($report) {
            return redirect()->route('reporter.index')->with(['pengaduan' => 'Pengaduan Berhasil terkirim!', 'type' => 'success']);
        } else {
            return redirect()->back()->with(['pengaduan' => 'Pengaduan Gagal terkirim!', 'type' => 'danger']);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(Report $report)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Report $report)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReportRequest $request, Report $report)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Report $report)
    {
        //
    }

}

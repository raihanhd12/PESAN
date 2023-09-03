<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Reporter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreReporterRequest;
use App\Http\Requests\UpdateReporterRequest;

class ReporterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.landing',[
            "report" => Report::latest()->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();

         $validate = Validator::make($data, [
            'name' => ['required'],
            'email' => ['required', 'email:dns', 'unique:users'],
            'phone_number' => ['required'],
            'identity_type' => ['required'],
            'identity_number' => ['required'],
            'pob' => ['required'],
            'dob' => ['required'],
            'address' => ['required']
        ]);

        if ($validate->fails()) {
            return redirect()->back()->with(['pesan' => $validate->errors()]);
        }

        $reporter = Reporter::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone_number' => $data['phone_number'],
            'identity_type' => $data['identity_type'],
            'identity_number' => $data['identity_number'],
            'pob' => $data['pob'],
            'dob' => $data['dob'],
            'address' => $data['address'],

        ]);

        session(['new_reporter_id' => $reporter->id]);


        if ($reporter) {
            return redirect()->route('laporan.index')->with(['pengaduan' => 'Data diri sudah masuk!', 'type' => 'success']);
        } else {
            return redirect()->back()->with(['pengaduan' => 'Data diri gagal dimasukkan', 'type' => 'danger']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Reporter $reporter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reporter $reporter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReporterRequest $request, Reporter $reporter)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reporter $reporter)
    {
        //
    }

    public function register(Request $request)
    {
        $data = $request->all();

        $validate = Validator::make($data, [
            'name' => ['required'],
            'email' => ['required'],
            'phone_number' => ['required'],
            'identity_type' => ['required'],
            'identity_number' => ['required'],
            'pob' => ['required'],
            'dob' => ['required'],
            'address' => ['required']
        ]);

        if ($validate->fails()) {
            return redirect()->back()->with(['pesan' => $validate->errors()]);
        }

        $username = Reporter::where('username', $request->username)->first();

        if ($username) {
            return redirect()->back()->with(['pesan' => 'Username sudah terdaftar']);
        }

        Reporter::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone_number' => $data['phone_number'],
            'identity_type' => $data['identity_type'],
            'identity_number' => $data['identity_number'],
            'pob' => $data['pob'],
            'dob' => $data['dob'],
            'address' => $data['address'],
        ]);

        return redirect()->route('pekat.index');
    }
}

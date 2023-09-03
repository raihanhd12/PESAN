<?php

namespace App\Http\Controllers\User;

use DateTime;
use App\Models\User;
use App\Models\Report;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $username = User::where('username', $request->username)->first();

        if (!$username) {
            return redirect()->back()->with(['pesan' => 'Username tidak terdaftar']);
        }

        $password = Hash::check($request->password, $username->password);

        if (!$password) {
            return redirect()->back()->with(['pesan' => 'Password tidak sesuai']);
        }

        if (Auth::guard()->attempt(['username' => $request->username, 'password' => $request->password])) {
            activity()
                ->causedBy(Auth::user())
                ->log(auth()->user()->username . ' Melakukan Login');
            return redirect()->route('admin.dashboard')->with(['pesan' => 'Berhasil Login']);
        } else {
            return redirect()->back()->with(['pesan' => 'Akun tidak terdaftar!']);
        }
    }

    public function formRegister()
    {
        return view('admin.register');
    }

    public function register(Request $request)
    {
        $data = $request->all();

        $validate = Validator::make($data, [
            'email' => ['required'],
            'name' => ['required'],
            'username' => ['required'],
            'phone_number' => ['required'],
            'password' => ['required'],
        ]);

        if ($validate->fails()) {
            return redirect()->back()->with(['pesan' => $validate->errors()]);
        }

        $username = User::where('username', $request->username)->first();

        if ($username) {
            return redirect()->back()->with(['pesan' => 'Username sudah terdaftar']);
        }

        User::create([
            'email' => $data['email'],
            'name' => $data['name'],
            'username' => $data['username'],
            'phone_number' => $data['phone_number'],
            'password' => Hash::make($data['password']),
        ]);

        return redirect()->route('admin.login');
    }

    public function logout()
    {
        Auth::guard()->logout();

        return redirect()->back();
    }

    public function dashboard()
    {
        $pending = Report::where('status', 'Pending')->get()->count();
        $administratif = Report::where('status', 'Proses Administratif')->get()->count();
        $penanganan = Report::where('status', 'Proses Penanganan')->get()->count();
        $selesai = Report::where('status', 'Selesai Ditangani')->get()->count();
        $ditolak = Report::where('status', 'Laporan Ditolak')->get()->count();

        return view('admin.dashboard.index', [
            'pending' => $pending,
            'administratif' => $administratif,
            'penanganan' => $penanganan,
            'selesai' => $selesai,
            'ditolak' => $ditolak
        ]);
    }
}

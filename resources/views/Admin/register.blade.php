@extends('layouts.user')

@section('css')
    <style>
        body {
            background: #08796e;
        }

        .btn-purple {
            background: #08796e;
            width: 100%;
            color: #fff;
        }
    </style>
@endsection

@section('title', 'PESAN | Register Admin')

@section('content')
    <div class="container">
        
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <h2 class="text-center text-white mb-0 mt-5">PESAN</h2>
                <P class="text-center text-white mb-5">Pengaduan Sederhana</P>
                <div class="card mt-5">
                    <div class="card-body">
                        <h2 class="text-center mb-5">FORM DAFTAR</h2>
                        <form action="{{ route('admin.register') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <input type="text" name="name" placeholder="Nama Lengkap" class="form-control">
                            </div>
                            <div class="form-group">
                                <input type="email" name="email" placeholder="Email" class="form-control">
                            </div>
                            <div class="form-group">
                                <input type="text" name="username" placeholder="Username" class="form-control">
                            </div>
                            <div class="form-group">
                                <input type="text" name="phone_number" placeholder="No. Telp" class="form-control">
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" placeholder="Password" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-purple">REGISTER</button>
                        </form>
                    </div>
                </div>
                @if (Session::has('pesan'))
                    <div class="alert alert-danger mt-2">
                        {{ Session::get('pesan') }}
                    </div>
                @endif
                <a href="{{ route('admin.login') }}" class="btn btn-dark text-white mt-3" style="width: 100%">Sudah Punya Akun? Login</a>
            </div>
        </div>
    </div>
@endsection

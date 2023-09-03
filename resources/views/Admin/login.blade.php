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

@section('title', 'PESAN | Login Admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <h2 class="text-center text-white mb-0 mt-5">PESAN</h2>
                <P class="text-center text-white mb-5">Pengaduan Sederhana</P>
                <div class="card mt-5">
                    <div class="card-body">
                        <h2 class="text-center mb-5">FORM LOGIN ADMIN</h2>
                        <form action="{{ route('admin.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" name="username" id="username" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-purple text-white mt-3" style="width: 100%">MASUK</button>
                        </form>
                    </div>
                </div>
                @if (Session::has('pesan'))
                    <div class="alert alert-danger mt-2">
                        {{ Session::get('pesan') }}
                    </div>
                @endif
                <a href="{{ route('admin.formRegister') }}" class="btn btn-dark text-white mt-3" style="width: 100%">Belum punya akun?
                    Register</a>
            </div>
        </div>
    </div>
@endsection

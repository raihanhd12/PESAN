@extends('layouts.user')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
@endsection

@section('title', 'PESAN - Pengaduan Sederhana')

@section('content')
    {{-- Section Header --}}
    <section class="header">
        <nav class="navbar navbar-expand-lg navbar-dark bg-transparent">
            <div class="container">
                <div class="container-fluid">
                    <a class="navbar-brand" href="{{ route('reporter.index') }}">
                        <h4 class="semi-bold mb-0 text-white">PESAN</h4>
                        <p class="italic mt-0 text-white">Pengaduan Sederhana</p>
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">

                        <ul class="navbar-nav text-center ml-auto">
                            <li class="nav-item">
                                <a class="nav-link ml-3 text-white" href="{{ route('laporan.dashboard') }}">Laporan</a>
                            </li>
                        </ul>

                    </div>
                </div>
            </div>
        </nav>

        <div class="text-center">
            <h2 class="medium text-white mt-3">Sistem Pengaduan Masyarakat</h2>
            <p class="italic text-white mb-5">Sampaikan laporan Anda langsung kepada yang berwenang</p>
        </div>

        <div class="wave wave1"></div>
        <div class="wave wave2"></div>
        <div class="wave wave3"></div>
        <div class="wave wave4"></div>
    </section>
    {{-- Section Card Pengaduan --}}
    <div class="row justify-content-center">
        <div class="col-lg-6 col-10 col">
            <div class="content shadow">

                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger">{{ $error }}</div>
                    @endforeach
                @endif

                @if (Session::has('pengaduan'))
                    <div class="alert alert-{{ Session::get('type') }}">{{ Session::get('pengaduan') }}</div>
                @endif

                <div class="card mb-3">Tulis Laporan Disini</div>
                <form action="{{ route('laporan.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <input type="hidden" name="reporter_id" value="{{ session('new_reporter_id') }}">
                    </div>
                    <div class="form-group">
                        <input name="title" placeholder="Masukkan Judul" class="form-control" {{ old('title') }}>
                    </div>
                    <div class="form-group">
                        <textarea name="description" placeholder="Masukkan Isi Laporan" class="form-control" rows="4">{{ old('description') }}</textarea>
                    </div>
                    <div class="form-group">
                        <input type="file" id="image" name="image" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-custom mt-2">Selanjutnya</button>
                </form>
            </div>
        </div>
    </div>
    {{-- Section Hitung Pengaduan --}}
    <div class="pengaduan mt-5">
        <div class="bg-purple">
            <div class="text-center">
                <h5 class="medium text-white mt-3">JUMLAH LAPORAN SEKARANG</h5>
                <h2 class="medium text-white">{{ $report->count() }}</h2>
            </div>
        </div>
    </div>
    {{-- Footer --}}
    <div class="mt-5">
        <hr>
        <div class="text-center">
            <p class="italic text-secondary">© 2023 Raihan HD • All rights reserved</p>
        </div>
    </div>

@endsection

@section('js')
    @if (Session::has('pesan'))
        <script>
            $('#loginModal').modal('show');
        </script>
    @endif
@endsection

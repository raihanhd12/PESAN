@extends('layouts.admin')

@section('title', 'Halaman Dashboard')

@section('header', 'Dashboard')

@section('content')
    <div class="row text-center">
        <div class="col">
            <div class="card">
                <div class="card-header bg-secondary text-light">
                    Pending
                </div>
                <div class="card-body">
                    {{ $pending }}
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-header bg-info text-light">
                    Proses Administratif
                </div>
                <div class="card-body">
                    <div class="text-center">
                        {{ $administratif }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-header bg-warning text-light">
                    Proses Penanganan
                </div>
                <div class="card-body">
                    <div class="text-center">
                        {{ $penanganan }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-header bg-success text-light">
                    Selesai Ditangani
                </div>
                <div class="card-body">
                    <div class="text-center">
                        {{ $selesai }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-header bg-danger text-light">
                    Laporan Ditolak
                </div>
                <div class="card-body">
                    <div class="text-center">
                        {{ $ditolak }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

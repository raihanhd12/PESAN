@extends('layouts.admin')

@section('title', 'Halaman Detail Tracker')

@section('css')
    <style>
        .text-primary:hover {
            text-decoration: underline;
        }

        .text-grey {
            color: #6c757d;
        }

        #gambarZoom {
            width: 200px;
            /* Ukuran awal gambar */
            cursor: pointer;
            /* Ubah kursor saat mengarahkan ke gambar */
        }

        #gambarZoom.zoomed {
            width: 400px;
            /* Ukuran gambar saat di-zoom */
            transition: width 0.3s;
            /* Animasi perubahan ukuran */
        }

        .btn-purple {
            background: #0cb8a7;
            border: 1px solid;
            color: #fff;
            width: 100%;
        }
    </style>
@endsection

@section('header')
    <a href="/admin/tracker" class="text-success">Kembali </a>
    <a href="#" class="text-grey"></a>
    <a href="#" class="text-grey">Report Tracker</a>
@endsection

@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <div class="text-center">
                        Pengaduan Sederhana
                    </div>
                </div>
                <div class="card-body">
                    <table class="table">
                        <tbody>
                            <tr>
                                <th>Tanggal Pengaduan di Update</th>
                                <td>:</td>
                                <td>{{ $tracker->updated_at }}</td>
                            </tr>
                            <tr>
                                <th>Nama Admin</th>
                                <td>:</td>
                                <td>{{ $tracker->user->name }}</td>
                            </tr>
                            <tr>
                                <th>Judul</th>
                                <td>:</td>
                                <td>{{ $tracker->report->title }}</td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>:</td>
                                <td>
                                    @if ($tracker->status == 'Pending')
                                        <a href="#" class="badge badge-secondary">Pending</a>
                                    @elseif ($tracker->status == 'Proses Administratif')
                                        <a href="#" class="badge badge-info">Proses Administratif</a>
                                    @elseif ($tracker->status == 'Proses Penanganan')
                                        <a href="#" class="badge badge-warning">Proses Penanganan</a>
                                    @elseif ($tracker->status == 'Selesai Ditangani')
                                        <a href="#" class="badge badge-success">Selesai Ditangani</a>
                                    @else
                                        <a href="#" class="badge badge-danger">Laporan Ditolak</a>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Note</th>
                                <td>:</td>
                                <td>{{ $tracker->note }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

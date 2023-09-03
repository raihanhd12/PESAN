@extends('layouts.admin')

@section('title', 'Halaman Detail Report')

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
    <a href="/admin/report" class="text-success">Kembali </a>
    <a href="#" class="text-grey"></a>
    <a href="#" class="text-grey">Report</a>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-6 col-12">
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
                                <th>Tanggal Pengaduan</th>
                                <td>:</td>
                                <td>{{ $report->created_at }}</td>
                            </tr>
                            <tr>
                                <th>Nama Reporter</th>
                                <td>:</td>
                                <td>{{ $report->reporter->name }}</td>
                            </tr>
                            <tr>
                                <th>Category</th>
                                <td>:</td>
                                <td>{{ $report->category?->name }}</td>
                            </tr>
                            <tr>
                                <th>No Ticket</th>
                                <td>:</td>
                                <td>{{ $report->ticket_id }}</td>
                            </tr>
                            <tr>
                                <th>Judul</th>
                                <td>:</td>
                                <td>{{ $report->title }}</td>
                            </tr>
                            <tr>
                                <th>Description</th>
                                <td>:</td>
                                <td>{{ $report->description }}</td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>:</td>
                                <td>
                                    @if ($report->status == 'Pending')
                                        <a href="#" class="badge badge-secondary">Pending</a>
                                    @elseif ($report->status == 'Proses Administratif')
                                        <a href="#" class="badge badge-info">Proses Administratif</a>
                                    @elseif ($report->status == 'Proses Penanganan')
                                        <a href="#" class="badge badge-warning">Proses Penanganan</a>
                                    @elseif ($report->status == 'Selesai Ditangani')
                                        <a href="#" class="badge badge-success">Selesai Ditangani</a>
                                    @else
                                        <a href="#" class="badge badge-danger">Laporan Ditolak</a>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Media</th>
                                <td>:</td>
                                <td>



                                    <img id="gambarZoom" src="{{ $report->getFirstMediaUrl('images') }}" alt="PESAN"
                                        class="img-fluid img-thumbnail" width="200px">


                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-12">
            <div class="card">
                <div class="card-header">
                    <div class="text-center">
                        Tanggapan
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ $report->id }}" method="POST">
                        @method('PUT')
                        @csrf
                        <input type="hidden" name="report_id" value={{ $report->id }}>
                        <div class="form-group">
                            <label for="category">Category</label>
                            <div class="input-group mb-3">
                                <select name="category_id" id="category" class="custom-select">
                                    @foreach ($category as $category)
                                        @if ($report->category_id == $category->id)
                                            <option value="{{ $report->category_id }}" selected>{{ $category->name }}</option>
                                        @else
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <div class="input-group mb-3">
                                <select name="status" id="status" class="custom-select">
                                    @if ($report->status == 'Pending')
                                        <option selected value="Pending">Pending</option>
                                        <option value="Proses Administratif">Proses Administratif</option>
                                        <option value="Proses Penanganan">Proses Penanganan</option>
                                        <option value="Selesai Ditangani">Selesai Ditangani</option>
                                        <option value="Laporan Ditolak">Laporan Ditolak</option>
                                    @elseif ($report->status == 'Proses Administratif')
                                        <option value="Pending">Pending</option>
                                        <option selected value="Proses Administratif">Proses Administratif</option>
                                        <option value="Proses Penanganan">Proses Penanganan</option>
                                        <option value="Selesai Ditangani">Selesai Ditangani</option>
                                        <option value="Laporan Ditolak">Laporan Ditolak</option>
                                    @elseif ($report->status == 'Proses Penanganan')
                                        <option value="Pending">Pending</option>
                                        <option value="Proses Administratif">Proses Administratif</option>
                                        <option selected value="Proses Penanganan">Proses Penanganan</option>
                                        <option value="Selesai Ditangani">Selesai Ditangani</option>
                                        <option value="Laporan Ditolak">Laporan Ditolak</option>
                                    @elseif ($report->status == 'Selesai Ditangani')
                                        <option value="Pending">Pending</option>
                                        <option value="Proses Administratif">Proses Administratif</option>
                                        <option value="Proses Penanganan">Proses Penanganan</option>
                                        <option selected value="Selesai Ditangani">Selesai Ditangani</option>
                                        <option value="Laporan Ditolak">Laporan Ditolak</option>
                                    @else
                                        <option value="Pending">Pending</option>
                                        <option value="Proses Administratif">Proses Administratif</option>
                                        <option value="Proses Penanganan">Proses Penanganan</option>
                                        <option value="Selesai Ditangani">Selesai Ditangani</option>
                                        <option selected value="Laporan Ditolak">Laporan Ditolak</option>
                                    @endif

                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="note">Note</label>
                            <textarea name="note" id="note" rows="4" class="form-control" placeholder="Masukkan note"></textarea>
                        </div>
                        <button type="submit" class="btn btn-purple">Submit</button>
                    </form>
                    @if (Session::has('status'))
                        <div class="alert alert-success mt-2">
                            {{ Session::get('status') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        document.getElementById('gambarZoom').addEventListener('click', function() {
            this.classList.toggle('zoomed'); // Menambah atau menghapus kelas CSS 'zoomed'
        });
    </script>


@endsection
